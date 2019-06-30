<?php

namespace App\Http\Controllers;

use App\Address;
use App\Events\OrderConfirmed;
use App\Events\OrderReproved;
use App\ExternalApi\Itau\Itau;
use App\ExternalApi\Shipping\ShippingManagerContract;
use App\Http\Requests\ConfirmOrder;
use App\Jobs\CreateOrderJob;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
    public function index()
    {
        $orders = Order::with('dentist', 'patient')->get();
        return view('orders.index', [
            'breadcrumbs' => [
                ['label' => 'Pedidos']
            ],
            'orders' => $orders
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
}
