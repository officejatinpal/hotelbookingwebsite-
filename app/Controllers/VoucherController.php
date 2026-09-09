<?php

namespace App\Controllers;
use App\Models\PagevoucherModel;

class VoucherController extends BaseController
{

    protected $pagevoucher;


 public function __construct()
    {
        $this->pagevoucher = new PagevoucherModel();
    }

public function index()
{
    // Fetch all active blogs, latest first
    $voucher = $this->pagevoucher
        ->where('status', 1)
        ->orderBy('id', 'DESC') // or use 'created_at' if you have a date field
        ->findAll();

    return view('voucher', ['vouchers' => $voucher]);
}

}