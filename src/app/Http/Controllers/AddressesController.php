<?php

namespace App\Http\Controllers;

use App\Address;
use App\Http\Requests\CreateAddress;
use App\Http\Requests\UpdateAddress;

class AddressesController extends Controller
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

    public function create()
    {
        return view('addresses.form', [
            'breadcrumbs' => [
                ['label' => 'Endereços'],
                ['label' => 'Novo'],
            ],
            'action' => route('addresses.store'),
            'method' => 'post',
        ]);
    }

    public function store(CreateAddress $request)
    {
        $address = new Address();
        $address->fill($request->all());
        $address->save();

        return redirect(route('profile'))->with('success', 'Endereço criado com sucesso');
    }

    public function edit(Address $address)
    {
        return view('addresses.form', [
            'breadcrumbs' => [
                ['label' => 'Endereços'],
                ['label' => $address->identification],
                ['label' => 'Alterar'],
            ],
            'action' => route('addresses.update', [$address->id]),
            'method' => 'put',
            'address' => $address
        ]);
    }

    public function update(Address $address, UpdateAddress $request)
    {
        $address->fill($request->all());
        $address->save();

        return redirect(route('profile'))->with('success', 'Endereço alterado com sucesso');;
    }
}