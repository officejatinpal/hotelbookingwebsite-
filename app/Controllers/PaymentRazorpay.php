<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use Razorpay\Api\Api;

class PaymentRazorpay extends BaseController
{
    private $razorpay_key;
    private $razorpay_secret;

    public function __construct()
    {
        $this->razorpay_key    = env('razorpay.keyId');
        $this->razorpay_secret = env('razorpay.keySecret');
    }

    public function checkout()
    {
        $session = session();
        $paymentData = $session->get('payment_data');

        if (!$paymentData) {
            return redirect()->to('/');
        }

        $api = new Api($this->razorpay_key, $this->razorpay_secret);

        $order = $api->order->create([
            'receipt' => 'order_' . time(),
            'amount' => $paymentData['amount'] * 100,
            'currency' => 'INR',
            'payment_capture' => 1
        ]);

        return view('razorpay_checkout', [
            'key'      => $this->razorpay_key,
            'order_id'=> $order['id'],
            'amount'  => $paymentData['amount'],
            'name'    => $paymentData['fname'].' '.$paymentData['lname'],
            'email'   => $paymentData['email'],
            'phone'   => $paymentData['phone'],
            'type'    => $paymentData['type']
        ]);
    }

    public function success()
    {
        $session = session();

        $payment_id = $this->request->getGet('razorpay_payment_id');
        $order_id   = $this->request->getGet('razorpay_order_id');
        $signature  = $this->request->getGet('razorpay_signature');

        if (!$payment_id || !$order_id || !$signature) {
            return redirect()->to('/');
        }

        $generated_signature = hash_hmac(
            'sha256',
            $order_id . "|" . $payment_id,
            $this->razorpay_secret
        );

        if ($generated_signature !== $signature) {
            return view('razorpay_success', ['status' => 'failure']);
        }

        $paymentData = $session->get('payment_data');

        return view('razorpay_success', [
            'status'     => 'success',
            'payment_id'=> $payment_id,
            'order_id'  => $order_id,
            'amount'    => $paymentData['amount'],
            'name'      => $paymentData['fname'].' '.$paymentData['lname'],
            'email'     => $paymentData['email'],
            'phone'     => $paymentData['phone'],
            'type'      => $paymentData['type']
        ]);
    }

    public function failure()
    {
        $error_code = $this->request->getGet('error_code');
        $error_desc = $this->request->getGet('error_description');

        if (!$error_code) {
            return redirect()->to('/');
        }

        return view('razorpay_success', [
            'status' => 'failure',
            'error_code' => $error_code,
            'error_desc' => $error_desc
        ]);
    }
}
