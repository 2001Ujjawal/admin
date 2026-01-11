<?php

namespace App\Controllers;

use App\Services\StripePayment;
use App\Services\PaypalPayment;

class Home extends BaseController
{
    public function index(): string
    {
        return view('welcome_message');
    }


    public function interfaceAndImplements()
    {

        $payment = new PaypalPayment();
        $stripPayment = new StripePayment();
        $result = [
            'payPal' => $payment->pay(5000),
            'stripPayment' => $stripPayment->payPal(5000)
        ];
        prt($result);
    }
}
