<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\UploadedFile;

/**
 * Class ChangeAvatar
 * @package App\Http\Requests
 * @property UploadedFile avatar
 */
class ChangeAvatar extends FormRequest
{

    protected $redirect = 'profile/change-avatar';

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
            'avatar' => 'required|mimes:png,jpeg'
        ];
    }
}
