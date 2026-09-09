<?php

namespace App\Controllers;
use CodeIgniter\Controller;

class PaymentCcavenue extends Controller
{
    public function checkout()
    {
        $data = session()->get('payment_data');
        echo view('ccavenue_checkout',['data'=>$data]);
    }
}
