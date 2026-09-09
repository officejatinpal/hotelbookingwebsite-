<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use Razorpay\Api\Api;

class RazorpayApi extends BaseController
{
    private $razorpay_key;
    private $razorpay_secret;

    public function __construct()
    {
        $this->razorpay_key     = env('razorpay.keyId');
        $this->razorpay_secret = env('razorpay.keySecret');
    }

    public function createOrder()
    {
        $data = $this->request->getJSON(true);

        if (empty($data['amount'])) {
            return $this->response->setStatusCode(400)
                ->setJSON(['status' => false, 'message' => 'Amount required']);
        }

        try {
            $api = new Api($this->razorpay_key, $this->razorpay_secret);

            $order = $api->order->create([
                'receipt'  => 'order_' . time(),
                'amount'   => (int)($data['amount'] * 100),
                'currency' => 'INR'
            ]);

            return $this->response->setJSON([
                'status'    => true,
                'key'       => $this->razorpay_key,
                'order_id'  => $order['id'],
                'amount'    => $data['amount'],
                'currency'  => 'INR'
            ]);

        } catch (\Exception $e) {
            return $this->response->setStatusCode(500)
                ->setJSON(['status' => false, 'message' => $e->getMessage()]);
        }
    }

    public function verifyPayment()
    {
        $data = $this->request->getJSON(true);

        $payment_id = $data['razorpay_payment_id'] ?? null;
        $order_id   = $data['razorpay_order_id'] ?? null;
        $signature  = $data['razorpay_signature'] ?? null;

        if (!$payment_id || !$order_id || !$signature) {
            return $this->response->setStatusCode(400)
                ->setJSON(['status' => false, 'message' => 'Invalid data']);
        }

        $generated_signature = hash_hmac(
            'sha256',
            $order_id . "|" . $payment_id,
            $this->razorpay_secret
        );

        if ($generated_signature !== $signature) {
            return $this->response->setJSON([
                'status' => false,
                'message'=> 'Signature verification failed'
            ]);
        }


        return $this->response->setJSON([
            'status' => true,
            'message'=> 'Payment verified successfully',
            'payment_id' => $payment_id,
            'order_id'   => $order_id
        ]);
    }
}
