<?php
namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Order
 * @package App
 * @property int id
 * @property int product
 * @property string product_name
 * @property int patient_id
 * @property int dentist_id
 * @property int address_id
 * @property array data
 * @property integer status
 * @property string status_desc
 * @property array status_history
 * @property string billing_name
 * @property string billing_document
 * @property string billing_address
 * @property string billing_zip_code
 * @property string billing_pone
 * @property string billing_email
 * @property string shipping
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property Dentist dentist
 * @property Patient patient
 * @property Address address
 */
class Order extends Model
{

    /**
     * Map of the products and their codes
     */
    protected const PRODUCTS = [
        1 => [
            'name' => 'Smart Aligner',
            'statuses' => [1, 2, 3, 4]
        ],
        4 => 'Surgery',
        3 => 'Implant Guiada',
        6 => 'Implant ROG',
        7 => 'Esthetic',
        8 => 'Smart Aligner Pre Protese',
    ];

    /**
     * Map of the statuses and their codes
     */
    protected const STATUSES = [
        1 => 'Pedido Iniciado',
        2 => 'Pedido Realizado',
        3 => 'Projeto Aprovado',
        4 => 'Pagamento'
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
        'status_history' => 'array',
    ];

    /**
     * Acessor to return the status description
     * @return mixed
     */
    public function getStatusDescAttribute()
    {
        return self::STATUSES[$this->status];
    }

    public function getProductNameAttribute()
    {
        return self::PRODUCTS[$this->product];
    }

    public function dentist()
    {
        return $this->belongsTo(Dentist::class);
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}