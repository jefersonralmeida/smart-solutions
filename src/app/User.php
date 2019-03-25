<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User
 * @package App
 * @property int $id
 * @property string $name
 * @property string $cpf_cnpj
 * @property string $email
 * @property string $phone
 * @property string $cro
 * @property string $city
 * @property string $state
 * @property string $cellphone
 * @property string $document_type
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'cpf_cnpj', 'email', 'phone', 'cro', 'city', 'state', 'cellphone'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Accessor to return if the document provided by the user is a CNPJ or a CPF
     * @return string
     */
    public function getDocumentTypeAttribute()
    {
        return strlen($this->attributes['cpf_cnpj']) > 11 ? 'cnpj' : 'cpf';
    }

    /**
     * Accessor to return the document provided by the user with dots
     * @return string
     */
    public function getCpfCnpjAttribute()
    {
        return addMask($this->attributes['cpf_cnpj'], getMask($this->document_type));
    }

    public function setCpfCnpjAttribute($value)
    {
        $docType = preg_match('/^\d{3}\.\d{3}\.\d{3}\-\d{2}$/', $value) ? 'cpf' : 'cnpj';
        $this->attributes['cpf_cnpj'] = removeMask($value, getMask($docType));
    }

    public function getPhoneAttribute()
    {
        return addMask($this->attributes['phone'], getMask('phone'));
    }

    public function setPhoneAttribute($value)
    {
        $this->attributes['phone'] = removeMask($value, getMask('phone'));
    }

    public function getCellphoneAttribute()
    {
        return addMask($this->attributes['cellphone'], getMask('cellphone'));
    }

    public function setCellphoneAttribute($value)
    {
        $this->attributes['cellphone'] = removeMask($value, getMask('cellphone'));
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = sanitizeString($value);
    }
}
