<?php

namespace App\ExternalApi\Rede;

use Rede\eRede;
use Rede\Transaction;

class Rede
{

    /**
     * @var eRede
     */
    protected $handler;

    public function __construct(eRede $handler)
    {
        $this->handler = $handler;
    }

    public function authorize(
        int $orderId,
        float $amount,
        string $holderName,
        string $cardNumber,
        string $expiration,
        int $securityCode
    )
    {

        [$expirationMonth, $expirationYear] = explode('/', $expiration);

        $expirationYear = "20$expirationYear";

        $transaction = (new Transaction($amount, $orderId))->creditCard(
            $cardNumber,
            $securityCode,
            $expirationMonth,
            $expirationYear,
            $holderName
        );

        try {
            $response = $this->handler->create($transaction);
        } catch (\Throwable $e) {
            return $e->getMessage();
        }

        if ($response->getReturnCode() == '00') {
            return '';
        }

        return $response->getReturnMessage();
    }
}