<?php

namespace App\Http\Controllers;

use App\Address;
use App\Dentist;
use App\Events\FileUploaded;
use App\Events\OrderConfirmed;
use App\Events\OrderReproved;
use App\ExternalApi\Itau\Itau;
use App\ExternalApi\Rede\Rede;
use App\ExternalApi\Shipping\ShippingManagerContract;
use App\Http\Requests\ConfirmOrder;
use App\Http\Requests\PayWithRede;
use App\Jobs\CreateOrderJob;
use App\Order;
use App\Patient;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\MessageBag;
use Illuminate\Support\ViewErrorBag;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class OrdersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $query = Order::with('dentist', 'patient');

        if ($fromDate = $request->query('from_date')) {
            $query->whereDate('created_at', '>=', Carbon::createFromFormat('Y-m-d', $fromDate));
        }

        if ($toDate = $request->query('to_date')) {
            $query->whereDate('created_at', '<=', Carbon::createFromFormat('Y-m-d', $toDate));
        }

        if ($status = $request->query('status')) {
            $query->where('status', $status);
        }

        if ($dentist = $request->query('dentist')) {
            $query->where('dentist_id', $dentist);
        }

        if ($patient = $request->query('patient')) {
            $query->where('patient_id', $patient);
        }

        $dentists = Dentist::get();
        $patients = Patient::get();

        $orders = $query->get();
        return view('orders.index', [
            'breadcrumbs' => [
                ['label' => 'Pedidos']
            ],
            'orders' => $orders,
            'filters' => [
                'from_date' => $fromDate,
                'to_date' => $toDate,
                'status' => $status,
                'dentist' => $dentist,
                'patient' => $patient,
            ],
            'patients' => $patients,
            'dentists' => $dentists,
        ]);
    }

    /**
     * @param Order $order
     * @param ShippingManagerContract $shippingManager
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function confirmOrder(Order $order, ShippingManagerContract $shippingManager)
    {

        return view('orders.confirmOrder', [
            'breadcrumbs' => [
                ['label' => 'Pedidos', 'route' => 'orders'],
                ['label' => 'Solicitar Aligner'],
                ['label' => 'Finalização'],
            ],
            'order' => $order,
            'dentist' => $order->dentist,
            'patient' => $order->patient,
            'addresses' => Address::all(),
            'shippingProviders' => $shippingManager->getProviders()
        ]);
    }

    public function confirmOrderStore(Order $order, ConfirmOrder $request)
    {

        $order->address_id = $request->address_id;
        $order->load(['address', 'dentist']);
        if ($request->billing_data == 'auto') {
            $request->billing_name = $order->dentist->name;
            $request->billing_document = $order->dentist->cpf;
            $request->billing_address = "{$order->address->street}, {$order->address->street_number} - {$order->address->city} - {$order->address->state}";
            $request->billing_zip_code = $order->address->zip_code;
            $request->billing_email = $order->dentist->email;
            $request->billing_phone = $order->dentist->phone;
        }

        $order->shipping = $request->shipping;
        $order->payment = $request->payment;
        $order->setOrderProcessing();

        $order->save();

        event(new OrderConfirmed($order));

        return redirect(route('orders'));
    }

    public function forceIntegration(Order $order)
    {
        CreateOrderJob::dispatch($order);
        return redirect(route('orders'));
    }

    /**
     * Convenience method that get the project files
     *
     * @param int $orderId
     * @return array
     */
    protected function getAvailableProjectFiles(int $orderId): array
    {

        // TODO - move this method to another place, a controller should not have a protected convenience method

        // get the configured path for the project
        $projectPath = implode('/', [
            config('paths.orders'),
            $orderId,
            config('paths.project'),
        ]);

        // get the available files
        return Storage::files($projectPath);
    }

    /**
     * Convenience method that translate the file size in bytes to human readable format
     *
     * @param string $path
     * @return string
     */
    protected function fileSize(string $path): string
    {

        // TODO - move this method to another place, a controller should not have a protected convenience method

        // available units
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];

        $fallbackUnit = array_pop($units);

        $size = Storage::size($path);

        foreach ($units as $unit) {
            if ($size < 1024) {
                return number_format($size, 1) . ' ' . $unit;
            }
            $size = $size / 1024;
        }

        return number_format($size, 1) . ' ' . $fallbackUnit;

    }

    public function verifyProject(Order $order)
    {

        $order->load(['patient', 'dentist']);

        $paths = $this->getAvailableProjectFiles($order->id);

        // generate the links for each file
        $files = [];
        foreach ($paths as $fileId => $path) {
            $pieces = explode('/', $path);
            $fileName = array_pop($pieces);
            $files[] = [
                'fileName' => $fileName,
                'size' => $this->fileSize($path),
                'uri' => route('orders.downloadProjectFile', [
                    'order' => $order->id,
                    'fileId' => $fileId
                ])
            ];
        }

        return view('orders.approveProject', [
            'breadcrumbs' => [
                ['label' => 'Pedidos', 'route' => 'orders'],
                ['label' => $order->id],
                ['label' => 'Aprovação'],
            ],
            'order' => $order,
            'files' => $files
        ]);
    }

    public function downloadProjectFile(Order $order, int $fileId)
    {
        $paths = $this->getAvailableProjectFiles($order->id);
        return Storage::download($paths[$fileId]);
    }

    public function approveProject(Order $order)
    {
        $order->setWaitingPayment();
        $order->save();
        return redirect(route('orders.payments', ['order' => $order->id]));
    }

    public function reproveProject(Order $order)
    {
        event(new OrderReproved($order));
        return redirect(route('orders'));
    }

    /**
     * Show the payments string
     *
     * @param Order $order
     * @param Itau $itau
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function payments(Order $order, Itau $itau)
    {

        // verifica se houve erro no processamento da rede, e exibe
        $errors = session()->get('errors', app(ViewErrorBag::class));;
        if (request()->query('payment_error')) {
            $errors->add('payment_error', 'O pagamento falhou. Tente novamente mais tarde, e caso o problema
        permaneça, contacte a Smart Solutions diretamente.');
        }

        // gera a criptografia para o Itaú
        try {
            $encryptedData = $itau->getEncryptedData($order);
        } catch (\Throwable $e) {
            return abort(500, 'Falha ao realizar o pagamento. Contate o nosso suporte.');
        }

        return view('orders.payment', [
            'breadcrumbs' => [
                ['label' => 'Pedidos', 'route' => 'orders'],
                ['label' => $order->id],
                ['label' => 'Pagamento'],
            ],
            'order' => $order,
            'data' => $encryptedData,
            'errors' => $errors
        ]);
    }

    /**
     * Return uri for the payment system
     *
     * @param Request $request
     * @param Itau $itau
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function paymentReturn(Request $request, Itau $itau)
    {
        $encryptedData = $request->query('DC');

        if ($encryptedData === null) {
            return abort(403, 'Falha ao receber o retorno de pagamento');
        }

        try {
            [$orderId, $paymentMethod] = $itau->decryptReturn($encryptedData);
        } catch (\Throwable $e) {
            return abort(403, 'Falha ao receber o retorno de pagamento.');
        }

        $order = Order::find($orderId);
        $order->payment_method = $paymentMethod;
        $order->setWaitingPaymentConfirmation();
        $order->save();
        return redirect(route('orders.thankYou', [
            'order' => $orderId
        ]));
    }

    public function payWithRede(PayWithRede $request, Order $order, Rede $rede)
    {

        \Log::debug('Realizando pagamento pela Rede...');

        $errorMessage = $rede->authorize(
            $order->id,
            $request->amount,
            $request->card_holder,
            str_replace(' ', '', $request->card_number),
            $request->expiration,
            $request->security_code
        );
        if (empty($errorMessage)) {
            $order->payment_method = 'Cartão de Crédito';
            $order->setWaitingPaymentConfirmation();
            $order->save();
            return redirect(route('orders.thankYou', [
                'order' => $order->id
            ]));
        }

        \Log::error("ERRO NO PAGAMENTO: $errorMessage");

        return redirect(route('orders.payments', [
            'order' => $order->id
        ]) . '?payment_error=1');

    }

    /**
     * Thank you page
     * @param Order $order
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function thankYou(Order $order)
    {
        return view('orders.thankYou', [
            'breadcrumbs' => [
                ['label' => 'Pedidos', 'route' => 'orders'],
                ['label' => $order->id],
                ['label' => 'Pagamento'],
            ],
            'order' => $order,
        ]);
    }

    /**
     * @param Order $order
     * @return string[]
     */
    protected function getPresentFilesForOrder(Order $order): array
    {
        $directory = config('paths.orders') . '/' . $order->id;
        $orderFiles = \Storage::allFiles($directory);
        $presentFiles = [];
        foreach ($orderFiles as $filePath) {
            $regex = "#^{$directory}/([^.]+)(?:_[0-9]+)?\.[^.]+$#";
            if (preg_match($regex, $filePath, $matches)) {
                $fileId = $matches[1];
                $fileIdWithoutSuffix = preg_replace('#_[0-9]+$#', '', $fileId);
                if (in_array($fileIdWithoutSuffix, config('uploads')[$order->product]['files'])) {
                    $presentFiles[] = $fileId;
                }
            }
        }
        return $presentFiles;
    }

    public function filesForm(Order $order)
    {
        $presentFiles = $this->getPresentFilesForOrder($order);
        return view("products.files.{$order->product_view}", [
            'breadcrumbs' => [
                ['label' => 'Pedidos', 'route' => 'orders'],
                ['label' => $order->product_name],
            ],
            'order' => $order,
            'presentFiles' => $presentFiles,
        ]);
    }

    public function uploadFile(Order $order, Request $request)
    {
        event(new FileUploaded($order, $request->allFiles()));

        return response()->json(['success'=> array_keys($request->allFiles())]);
    }

    public function downloadFile(Order $order, string $file)
    {
        $directory = config('paths.orders') . '/' . $order->id;
        $regex = "#^{$directory}/{$file}\.[^.]+$#";
        $orderFiles = \Storage::files($directory);
        $found = array_filter($orderFiles, function ($item) use ($regex) {
            return preg_match($regex, $item);
        });

        if (!empty($found)) {
            $file = array_pop($found);
            return Storage::download($file);
        }

        throw new NotFoundHttpException();
    }

    protected function getRequiredFiles(Order $order)
    {
        $required = config('uploads')[$order->product]['required'];
        if (is_callable($required)) {
            $required = $required($order);
        }
        return array_values($required);
    }

    public function finishOrder(Order $order)
    {
        $presentFiles = array_values($this->getPresentFilesForOrder($order));
        $presentFiles = array_map(function ($item) {
            return preg_replace('/_[0-9]+$/', '', $item);
        }, $presentFiles);
        $presentFiles = array_unique($presentFiles);
        $requiredFiles = $this->getRequiredFiles($order);
        $required = count($requiredFiles);
        $missing = $required - count(array_intersect($requiredFiles, $presentFiles));
        if ($missing > 0) {
            $message = "$missing de $required arquivos obrigatórios não encontrados. Faça upload de todos os arquivos obrigatórios. 
            Caso já tenha realizado, tente novamente mais tarde. Seu arquivo pode estar sendo processado.";
            return redirect(route('orders.filesForm', [$order->id]))->with('error', $message);
        }
        $order->setOrderCreated();
        $order->save();
        return redirect(route('orders.confirm', ['order' => $order->id]));
    }
}
