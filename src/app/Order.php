<?php

namespace App;

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
 * @property int patient_id
 * @property int dentist_id
 * @property int address_id
 * @property array data
 * @property integer status
 * @property string status_desc
 * @property string status_color
 * @property array status_history
 * @property string status_next_label
 * @property string status_next_route
 * @property string billing_name
 * @property string billing_document
 * @property string billing_address
 * @property string billing_zip_code
 * @property string billing_phone
 * @property string billing_email
 * @property string shipping
 * @property string payment
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

    /**
     * List of products ids and their names
     */
    const PRODUCTS = [
        1 => 'Smart Aligner',
        4 => 'Surgery',
        3 => 'Implant Guiada',
        6 => 'Implant ROG',
        7 => 'Esthetic',
        8 => 'Smart Aligner Pre Protese',
    ];

    /**
     * List of the products ids that requires pre planning
     */
    const REQUIRES_PRE_PLANNING = [1];

    /**
     * Acessor to return the status description
     * @return mixed
     */
    public function getStatusDescAttribute()
    {
        return config('status')[$this->status]['name'];
    }

    public function getStatusColorAttribute()
    {
        return config('status')[$this->status]['color'];
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

    /**
     * Changes the order status, including the status history
     *
     * @param $status
     */
    protected function setStatus($status): void
    {
        $this->status = $status;

        // include the history
        $statusHistory = $this->status_history;
        $statusHistory[] = [
            'status' => $this->status_desc,
            'date' => now()->format('d/m/Y H:i')
        ];
        $this->status_history = $statusHistory;
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
     * Set the status of the order to 3 - Order Placed, when the product requires pre-planning, otherwise set's it
     * to 6 - Waiting Payment
     */
    public function setOrderPlaced(): void
    {
        if (!in_array($this->product, self::REQUIRES_PRE_PLANNING)) {
            $this->setWaitingPayment();
            return;
        }
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