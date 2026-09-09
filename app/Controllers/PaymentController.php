<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class PaymentController extends BaseController
{
    public function index()
    {
        return view('payment_form');
    }
   
    public function process()
    {
        $gateway = $this->request->getPost('pay_gateway');

        $data = [
            'fname'  => $this->request->getPost('pay_fname'),
            'lname'  => $this->request->getPost('pay_lname'),
            'email'  => $this->request->getPost('pay_email'),
            'phone'  => $this->request->getPost('pay_phone'),
            'amount' => $this->request->getPost('pay_amount'),
            'type'   => $this->request->getPost('pay_type'),
        ];

        session()->set('payment_data', $data);

        switch ($gateway) {
            case 'razorpay': return redirect()->to(base_url('razorpay/checkout'));
            case 'cashfree': return redirect()->to(base_url('cashfree/checkout'));
            case 'paytm':    return redirect()->to(base_url('payment/paytm'));
            case 'payu':     return redirect()->to(base_url('payu/checkout'));
            case 'ccavenue': return redirect()->to(base_url('payment/ccavenue'));
            default:         return redirect()->back()->with('error','Invalid gateway.');
        }
    }

}
