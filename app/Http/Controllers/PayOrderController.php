<?php

namespace App\Http\Controllers;

use App\Billing\BankPaymentGateway;
use App\Billing\PaymentGatewayContract;
use App\Order\OrderDetails;
use Illuminate\Http\Request;

class PayOrderController extends Controller
{
    public function store(OrderDetails $orderDetails, PaymentGatewayContract $paymentGateway)
    {
//        $paymentGateway = new PaymentGateway('usd');

        $order = $orderDetails->all();

        dd($paymentGateway->charge(2500));
    }
}
