<?php

namespace App\Http\Requests;

use App\Address;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ConfirmOrder
 * @package App\Http\Requests
 * @property int $address_id
 * @property string billing_data
 * @property string billing_name
 * @property string billing_document
 * @property string billing_address
 * @property string billing_zip_code
 * @property string billing_phone
 * @property string billing_email
 * @property string shipping
 * @property string payment
 */
class ConfirmOrder extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'address_id' => 'required', // TODO - Validate if the address id is valid (from the clinic)
            'billing_name' => 'required_if:billing_data,manual',
            'billing_document' => 'required_if:billing_data,manual',
            'billing_address' => 'required_if:billing_data,manual',
            'billing_district' => 'required_if:billing_data,manual',
            'billing_city' => 'required_if:billing_data,manual',
            'billing_state' => 'required_if:billing_data,manual',
            'billing_zip_code' => 'required_if:billing_data,manual',
            'billing_phone' => 'required_if:billing_data,manual',
            'billing_email' => 'required_if:billing_data,manual',
            'shipping' => 'required' // TODO - Validate if the shipping is supported
        ];
    }
}
