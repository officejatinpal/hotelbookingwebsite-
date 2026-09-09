<?php

namespace App\Controllers;

class PaymentPayu extends BaseController
{
    protected $merchantKey;
    protected $salt;
    protected $payuBaseUrl;

    public function __construct()
    {
        helper(['url', 'form']);

        $this->merchantKey = env('PAYU_KEY');
        $this->salt        = env('PAYU_SALT');

        // LIVE
        $this->payuBaseUrl = 'https://secure.payu.in/_payment';
        // TEST: https://test.payu.in/_payment
    }

    /* ===============================
       PAYU CHECKOUT
    =============================== */
    public function checkout()
    {
        // 🔹 Get data from session (IMPORTANT)
        $payment = session()->get('payment_data');

        if (!$payment) {
            return redirect()->to('/payment')
                ->with('error', 'Payment session expired. Please try again.');
        }

        $amount = $payment['amount'];
        $name   = trim($payment['fname'] . ' ' . $payment['lname']);
        $email  = $payment['email'];
        $mobile = $payment['phone'];

        $txnid = uniqid('TXN_');

        $hashString = $this->merchantKey
            . '|' . $txnid
            . '|' . $amount
            . '|Holiday Booking'
            . '|' . $name
            . '|' . $email
            . '|||||||||||'
            . $this->salt;

        $hash = strtolower(hash('sha512', $hashString));

        $data = [
            'payuBaseUrl' => $this->payuBaseUrl,
            'key'         => $this->merchantKey,
            'txnid'       => $txnid,
            'amount'      => $amount,
            'productinfo' => 'Holiday Booking',
            'firstname'   => $name,
            'email'       => $email,
            'phone'       => $mobile,
            'surl'        => site_url('payu/success'),
            'furl'        => site_url('payu/failure'),
            'hash'        => $hash,
            'service_provider' => 'payu_paisa'
        ];

        return view('payu_checkout', $data);
    }

    /* ===============================
       PAYMENT SUCCESS
    =============================== */
    public function success()
    {
        $response = $this->request->getPost();

        if (!$response) {
            return redirect()->to('/payment')
                ->with('error', 'Invalid PayU response.');
        }

        // 🔐 HASH VERIFICATION
        $hashSequence = $this->salt
            . '|' . $response['status']
            . '|||||||||||'
            . $response['email']
            . '|' . $response['firstname']
            . '|' . $response['productinfo']
            . '|' . $response['amount']
            . '|' . $response['txnid']
            . '|' . $this->merchantKey;

        $generatedHash = strtolower(hash('sha512', $hashSequence));

        if ($generatedHash !== strtolower($response['hash'])) {
            return redirect()->to('/payment')
                ->with('error', 'Payment verification failed.');
        }

        // ✅ OPTIONAL: Save payment in DB here

        // Clear payment session
        session()->remove('payment_data');

        return view('payu_success', [
            'response' => $response
        ]);
    }

    /* ===============================
       PAYMENT FAILURE
    =============================== */
    public function failure()
    {
        $response = $this->request->getPost();

        session()->remove('payment_data');

        return view('payu_success', [
            'response' => $response
        ]);
    }
}
