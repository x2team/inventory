<?php


namespace App\Order;

use App\Billing\PaymentGatewayContract;

class OrderDetails
{
    private $paymentGateway;

    public function __construct(PaymentGatewayContract $paymentGateway)
    {

        $this->paymentGateway = $paymentGateway;
    }

    public function all()
    {
        $this->paymentGateway->setDiscount(500);

        return [
            'name' => 'BeeSupper',
            'address' => 'Phu my, Binh Duong',
        ];
    }

}
