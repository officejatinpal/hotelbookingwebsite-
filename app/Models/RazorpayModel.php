<?php

namespace App\Models;

use CodeIgniter\Model;
use Razorpay\Api\Api;

class RazorpayModel extends Model
{
    protected $keyId;
    protected $keySecret;

    public function __construct()
    {
        $config = config('RazorpayConfig');
        $this->keyId = $config->keyId;
        $this->keySecret = $config->keySecret;
    }

    public function createOrder($amount, $currency = 'INR')
    {
        try {
            $api = new Api($this->keyId, $this->keySecret);

            $orderData = [
                'receipt'         => rand(1000, 9999),
                'amount'          => $amount * 100, // amount in paise
                'currency'        => $currency,
                'payment_capture' => 1
            ];

            $order = $api->order->create($orderData);
            return $order;
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function verifyPayment($paymentId, $orderId, $signature)
    {
        try {
            $api = new Api($this->keyId, $this->keySecret);
            $api->utility->verifyPaymentSignature([
                'razorpay_order_id'   => $orderId,
                'razorpay_payment_id'  => $paymentId,
                'razorpay_signature'   => $signature
            ]);
            return true;
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }
}
