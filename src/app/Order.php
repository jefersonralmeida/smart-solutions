<?php

namespace App;

use App\Scopes\DomainScope;
use Carbon\Carbon;
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
 * @property string billing_pone
 * @property string billing_email
 * @property string shipping
 * @property string payment
 * @property int integration_id
 * @property bool integration_failed
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property Dentist dentist
 * @property Patient patient
 * @property Address address
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
     * Map of the products and their codes
     */
    protected const PRODUCTS = [
        1 => [
            'name' => 'Smart Aligner',
            'statuses' => [1, 2, 3, 4, 5, 6],
        ],
        4 => [
            'name' => 'Surgery',
            'statuses' => [1, 2, 5, 6],
        ],
        3 => [
            'name' => 'Implant Guiada',
            'statuses' => [1, 2, 5, 6],

        ],
        6 => [
            'name' => 'Implant ROG',
            'statuses' => [1, 2, 5, 6],

        ],
        7 => [
            'name' => 'Esthetic',
            'statuses' => [1, 2, 5, 6],
        ],
        8 => [
            'name' => 'Smart Aligner Pre Protese',
            'statuses' => [1, 2, 5, 6],
        ]
    ];

    /**
     * Map of the statuses and their codes
     */
    public const STATUSES = [
        1 => [
            'name' => 'Pedido Iniciado',
            'color' => '#7bdd59',
            'next' => [
                'label' => 'Finalizar Pedido',
                'route' => ['orders.confirm', ['id']],
            ]
        ],
        2 => [
            'name' => 'Em Processamento',
            'color' => '#59ccdd',
        ],
        3 => [
            'name' => 'Pedido Realizado',
            'color' => '#ddbb53',
        ],
        4 => [
            'name' => 'Projeto Aprovado',
            'color' => '#9683d5',
        ],
        5 => [
            'name' => 'Aguardando Pagamento',
            'color' => '#848484',
        ],
        6 => [
            'name' => 'Pedido Enviado',
            'color' => '#848484',
        ]
    ];

    /**
     * @var array
     */
    protected $fillable = ['patient_id', 'dentist_id', 'address_id', 'data'];

    /**
     * @var array
     */
    protected $casts = [
        'data' => 'array',
        'files' => 'array',
        'status_history' => 'array'
    ];

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

    public function getProductNameAttribute()
    {
        return config('products')[$this->product]['name'];
    }

    public function incrementStatus(): void
    {
        $statuses = config('products')[$this->product]['statuses'];
        $currentIndex = array_search($this->status, $statuses);
        $index = $currentIndex === false ? 0 : $currentIndex + 1;
        $this->status = $statuses[$index];

        // save the history
        $statusHistory = $this->status_history;
        $statusHistory[] = [
            'status' => $this->status_desc,
            'date' => now()->format('d/m/Y H:i')
        ];
        $this->status_history = $statusHistory;
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