<?php

namespace App\ExternalApi\Orders;

use App\Address;
use App\Dentist;
use App\Order;

interface OrdersApiContract
{
    public function createDentist(Dentist $dentist): ?DentistCreateResponseContract;

    public function createAddress(Address $address, Dentist $dentist): ?AddressCreateResponseContract;

    public function createOrder(Order $order): ?OrderCreateResponseContract;

    public function listOrders(Dentist $dentist): ?ListOrdersResponseContract;

    public function approveOrder(Order $order): bool;

    public function reproveOrder(Order $order): bool;
}