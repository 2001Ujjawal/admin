<?php

namespace App\Services;

use App\Interfaces\PaymentInterface;

class StripePayment   implements PaymentInterface
{
    public function pay(float $amount): string
    {
        return "Paid ₹{$amount} using Stripe";
    }
}
