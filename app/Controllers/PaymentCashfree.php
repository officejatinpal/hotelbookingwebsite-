<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CashfreeOrderModel;

class PaymentCashfree extends BaseController
{
    private $appId;
    private $secretKey;
    private $returnUrl = "cashfree/success";

    public function __construct()
    {
        $this->appId     = env('cashfree.appId');
        $this->secretKey = env('cashfree.secretKey');
    }

    public function checkout()
    {
        $session = session();
        $payment = $session->get('payment_data');

        if (!$payment) {
            return redirect()->to('/');
        }

        $orderId = "CF" . time() . rand(100,999);

        $customerName  = $payment['fname'] . ' ' . $payment['lname'];
        $customerEmail = $payment['email'];
        $customerPhone = $payment['phone'];
        $amount        = (float) $payment['amount'];
        $type          = $payment['type'];

        $orderModel = new CashfreeOrderModel();
        $orderModel->insert([
            'order_id'       => $orderId,
            'customer_name'  => $customerName,
            'customer_email' => $customerEmail,
            'customer_phone' => $customerPhone,
            'amount'         => $amount,
            'type'           => $type,
            'status'         => 'pending'
        ]);

        $fields = [
            "appId"         => $this->appId,
            "orderId"       => $orderId,
            "orderAmount"   => $amount,
            "orderCurrency" => "INR",
            "orderNote"     => "Payment",
            "customerName"  => $customerName,
            "customerEmail" => $customerEmail,
            "customerPhone" => $customerPhone,
            "type"          => $type,
            "returnUrl"     => base_url($this->returnUrl),
            "notifyUrl"     => base_url($this->returnUrl)
        ];

        ksort($fields);
        $signatureData = "";
        foreach ($fields as $key => $value) {
            $signatureData .= $key . $value;
        }

        $signature = base64_encode(
            hash_hmac('sha256', $signatureData, $this->secretKey, true)
        );

        return view("cashfree_checkout", [
            "fields"    => $fields,
            "signature" => $signature
        ]);
    }

    public function success()
    {
        $post = $this->request->getPost();

        if (!isset($post['orderId'])) {
            return redirect()->to('/');
        }

        $orderId = $post["orderId"] ?? '';
        $status  = $post["txStatus"] ?? "FAILED";
        $txId    = $post["referenceId"] ?? "";
        $msg     = $post["txMsg"] ?? "";
        $amount  = $post["orderAmount"] ?? "";

        $orderModel = new CashfreeOrderModel();
        $order = $orderModel->where('order_id', $orderId)->first();

        if ($order) {
            $orderModel->update($order['id'], [
                'status'     => $status === 'SUCCESS' ? 'success' : 'failed',
                'payment_id' => $txId
            ]);

            $customerName  = $order['customer_name'];
            $customerEmail = $order['customer_email'];
            $customerPhone = $order['customer_phone'];
            $type          = $order['type'];
        } else {
            $customerName = $customerEmail = $type = $customerPhone = "N/A";
        }

        return view("cashfree_success", [
            "status"     => strtolower($status),
            "order_id"   => $orderId,
            "payment_id" => $txId,
            "amount"     => $amount,
            "message"    => $msg,
            "name"       => $customerName,
            "email"      => $customerEmail,
            "phone"      => $customerPhone,
            "type"       => $type
        ]);
    }
}
