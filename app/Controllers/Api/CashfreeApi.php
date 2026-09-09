<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;

class CashfreeApi extends BaseController
{
    private $appId;
    private $secretKey;

    public function __construct()
    {
        $this->appId     = env('cashfree.appId');
        $this->secretKey = env('cashfree.secretKey');
    }

    public function createOrder()
    {
        $data = $this->request->getJSON(true);

        if (empty($data['amount']) || empty($data['name']) || empty($data['email']) || empty($data['phone'])) {
            return $this->response->setStatusCode(400)
                ->setJSON(['status' => false, 'message' => 'Required fields missing']);
        }

        $orderId = "CFORDER_" . time();

        $fields = [
            "appId"         => $this->appId,
            "orderId"       => $orderId,
            "orderAmount"   => $data['amount'],
            "orderCurrency" => "INR",
            "orderNote"     => "Payment",
            "customerName"  => $data['name'],
            "customerEmail" => $data['email'],
            "customerPhone" => $data['phone'],
            "returnUrl"     => base_url('cashfree/success'),
            "notifyUrl"     => base_url('cashfree/success')
        ];

        ksort($fields);
        $signatureData = "";
        foreach ($fields as $key => $value) {
            $signatureData .= $key . $value;
        }

        $signature = base64_encode(
            hash_hmac('sha256', $signatureData, $this->secretKey, true)
        );

        return $this->response->setJSON([
            'status'    => true,
            'order_id'  => $orderId,
            'fields'    => $fields,
            'signature' => $signature
        ]);
    }

    public function verifyPayment()
    {
        $data = $this->request->getJSON(true);

        if (empty($data['orderId']) || empty($data['txStatus'])) {
            return $this->response->setStatusCode(400)
                ->setJSON(['status' => false, 'message' => 'Invalid data']);
        }

        // Cashfree usually sends status directly; you can also verify signature if needed
        if ($data['txStatus'] === 'SUCCESS') {
            return $this->response->setJSON([
                'status' => true,
                'message'=> 'Payment successful',
                'order_id' => $data['orderId'],
                'payment_id' => $data['referenceId'] ?? ''
            ]);
        }

        return $this->response->setJSON([
            'status' => false,
            'message'=> 'Payment failed',
            'order_id' => $data['orderId']
        ]);
    }
}
