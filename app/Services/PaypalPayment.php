<?php

namespace App\Services;

use App\Interfaces\PaymentInterface;

class PaypalPayment implements PaymentInterface
{
    public function pay(float $amount): string
    {
        return "Paid ₹{$amount} using PayPal";
    }
}
