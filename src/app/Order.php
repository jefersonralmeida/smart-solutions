<?php

namespace App;

use App\ExternalApi\Shipping\ShippingManagerContract;
use App\Mail\OrderStatusChanged;
use App\Scopes\CurrentClinicScope;
use App\Scopes\DomainScope;
use Carbon\Carbon;
use DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Order
 * @package App
 * @mixin \Eloquent
 * @property int id
 * @property int product
 * @property string product_name
 * @property string product_view
 * @property int patient_id
 * @property int dentist_id
 * @property int address_id
 * @property array data
 * @property integer status
 * @property string status_desc
 * @property array status_history
 * @property string status_next_label
 * @property string status_next_route
 * @property string billing_name
 * @property string billing_document
 * @property string billing_address
 * @property string billing_district
 * @property string billing_city
 * @property string billing_state
 * @property string billing_zip_code
 * @property string billing_phone
 * @property string billing_email
 * @property string shipping
 * @property string payment
 * @property float value
 * @property float shipping_value
 * @property float total_value
 * @property int integration_id
 * @property bool integration_failed
 * @property array payment_methods
 * @property array spc_result
 * @property string payment_method
 * @property Carbon payment_confirmed_at
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property Dentist dentist
 * @property Patient patient
 * @property Address address
 * @method static Builder waitingPaymentConfirmation()
 */
class Order extends Model
{

    protected static function boot()
    {
        parent::boot();

        // apply domain scope
        static::addGlobalScope(new DomainScope());

        // apply the current clinic scope
        static::addGlobalScope(new CurrentClinicScope('dentist'));

    }

    /**
     * @var array
     */
    protected $fillable = ['patient_id', 'dentist_id', 'address_id', 'data'];

    /**
     * @var array
     */
    protected $dates = ['payment_confirmed_at'];

    /**
     * @var array
     */
    protected $casts = [
        'data' => 'array',
        'files' => 'array',
        'status_history' => 'array',
        'payment_methods' => 'array',
        'spc_result' => 'array',
    ];

    protected $shippingValueSingleton = null;

    /**
     * List of products ids and their names
     */
    const PRODUCTS = [
        1 => [
            'name' => 'Smart Aligner',
            'view' => 'orderAligner',
        ],
        4 => [
            'name' => 'Surgery',
            'view' => 'orderSurgery',
        ],
        3 => [
            'name' => 'Implant Guiada',
            'view' => 'orderImplantGuiada',
        ],
        6 => [
            'name' => 'Implant ROG',
            'view' => 'orderImplantRog',
        ],
        7 => [
            'name' => 'Esthetic',
            'view' => 'orderEsthetic',
        ],
        8 => [
            'name' => 'Smart Aligner Pre Protese',
            'view' => 'orderAlignerPP',
        ],
    ];

    /**
     * List of the products ids that requires pre planning
     */
    const REQUIRES_PRE_PLANNING = [1, 4, 3, 6, 8];

    /**
     * Acessor to return the status description
     * @return mixed
     */
    public function getStatusDescAttribute()
    {
        return config('status')[$this->status]['name'];
    }

    public function getStatusNextLabelAttribute()
    {
        return config('status')[$this->status]['next']['label'] ?? '';
    }

    public function getStatusNextRouteAttribute()
    {
        if (!isset(config('status')[$this->status]['next'])) {
            return '';
        }
        [$route, $fields] = config('status')[$this->status]['next']['route'];
        $fields = array_map(function ($item) {
            return $this->$item;
        }, $fields);
        return route($route, $fields);
    }

    /**
     * Returns the product name, based on the id
     *
     * @return mixed
     */
    public function getProductNameAttribute()
    {
        return self::PRODUCTS[$this->product]['name'];
    }

    public function getProductViewAttribute()
    {
        return self::PRODUCTS[$this->product]['view'];
    }

    /**
     * Returns the billing document (CPF) if set, or the dentist document.
     * @return string
     */
    public function getBillingDocumentAttribute()
    {
        return $this->billing_document ?? $this->dentist->cpf;
    }

    public function getBillingZipCodeAttribute()
    {
        return $this->billing_zip_code ?? $this->address->zip_code;
    }

    /**
     * If set, return the billing name, or return the dentist name
     * @return string
     */
    public function getBillingNameAttribute()
    {
        return $this->billing_name ?? $this->dentist->name;
    }

    /**
     * If set, return the billing street address, or return the shipping address
     * @return string
     */
    public function getBillingAddressAttribute()
    {
        return $this->billing_address ?? $this->address->street_address;
    }

    /**
     * If set, return the billing district, or return the shipping district
     * @return string
     */
    public function getBillingDistrictAttribute()
    {
        return $this->billing_district ?? $this->address->district;
    }

    /**
     * If set, return the billing city, or return the shipping city
     * @return string
     */
    public function getBillingCityAttribute()
    {
        return $this->billing_city ?? $this->address->city;
    }

    /**
     * If set, return the billing state/province, or return the shipping state/province
     * @return string
     */
    public function getBillingStateAttribute()
    {
        return $this->billing_state ?? $this->address->state;
    }

    public function getShippingValueAttribute()
    {
        if ($this->shippingValueSingleton === null) {
            /** @var ShippingManagerContract $shippingManager */
            $shippingManager = resolve(ShippingManagerContract::class);
            $provider = $shippingManager->getProviderObject($this->shipping, $this->address->zip_code);
            $this->shippingValueSingleton = $provider->getPrice();
        }
        return $this->shippingValueSingleton;
    }

    public function getTotalValueAttribute()
    {
        return $this->value + $this->shipping_value;
    }

    /**
     * Changes the order status, including the status history
     *
     * @param $status
     */
    protected function setStatus($status): void
    {

        $oldStatus = $this->status;

        $this->status = $status;

        // include the history
        $statusHistory = $this->status_history;
        $statusHistory[] = [
            'status' => $this->status_desc,
            'date' => now()->format('d/m/Y H:i')
        ];
        $this->status_history = $statusHistory;

        // send a notification about the status change to the dentist, by email
        if ($oldStatus != $status) {
            \Mail::to($this->dentist->email)->send(new OrderStatusChanged($this, $oldStatus, $status));
        }
    }

    /**
     *
     */
    public function setWaitingFiles(): void
    {
        $this->setStatus(0);
    }

    /**
     * Set the status of the order to 1 - Order created
     */
    public function setOrderCreated(): void
    {
        $this->setStatus(1);
    }

    /**
     * Set the status of the order to 2 - Order being processed
     */
    public function setOrderProcessing(): void
    {
        $this->setStatus(2);
    }

    /**
     * Set the status of the order to 9 - "Documentação em análise técnica", when the product requires pre-planning, otherwise set's it
     * to 6 - "Aguardando pagamento"
     */
    public function setOrderPlaced(): void
    {
        if (!in_array($this->product, self::REQUIRES_PRE_PLANNING)) {
            $this->setWaitingPayment();
            return;
        }
        $this->setStatus(9);
    }

    /**
     * Documentação incompleta / com problema
     */
    public function setFailedDoc(): void
    {
        $this->setStatus(10);
    }

    /**
     * Pedido em planejamento
     */
    public function setPlanning(): void
    {
        $this->setStatus(3);
    }

    /**
     * Set the status of the order to 4 - Waiting Approvement
     */
    public function setWaitingApprovement(): void
    {
        $this->setStatus(4);
    }

    /**
     * Alteração solicitada
     */
    public function setChangeRequired(): void
    {
        $this->setStatus(11);
    }

    /**
     * Set the status of the order to 6 - Waiting for Payment
     */
    public function setWaitingPayment(): void
    {
        $this->setStatus(6);
    }

    /**
     * Set the status of the order to 7 - Waiting for Payment Confirmation
     */
    public function setWaitingPaymentConfirmation(): void
    {
        $this->setStatus(7);
    }

    /**
     * Set the status of the order to 8 - Payment Confirmed
     */
    public function setPaymentConfirmed(): void
    {
        $this->setStatus(8);
    }

    /**
     * Em produção
     */
    public function setUnderProduction(): void
    {
        $this->setStatus(12);
    }

    /**
     * Preparando envio
     */
    public function setPreparingShipping(): void
    {
        $this->setStatus(13);
    }

    /**
     * Pedido enviado
     */
    public function setShipped(): void
    {
        $this->setStatus(14);
    }

    /**
     * Pedido em cancelamento
     */
    public function setCancelProcess(): void
    {
        $this->setStatus(15);
    }

    /**
     * Pedido cancelado - Aguardando pagamento
     */
    public function setCanceled(): void
    {
        $this->setStatus(16);
    }

    /**
     * Pedido cancelado
     */
    public function setConfirmCancel(): void
    {
        $this->setStatus(17);
    }

    public static function findLastMonthsCount(int $months)
    {
        $limit = now()->subMonth($months - 1)->firstOfMonth();
        $query = self::whereDate('created_at', '>=', $limit);
        $query->select(DB::raw("CONCAT(MONTH(created_at), '/', YEAR(created_at)) as month, count(*) as count"));
        $query->groupBy(DB::raw('month'));
        $data = $query->get()->toArray();
        $data = array_combine(array_column($data, 'month'), array_column($data, 'count'));
        $output = [];
        foreach (range(0, $months -1) as $i) {
            $key = $limit->format('n/Y');
            $output[$key] = $data[$key] ?? 0;
            $limit->addMonth(1);
        }
        return $output;
    }

    public function scopeWaitingPaymentConfirmation(Builder $query)
    {
        $query->where('status', 7);
        return $query;
    }

    public function dentist()
    {
        return $this->belongsTo(Dentist::class);
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }
}
