<?php

namespace App\Controllers;

class PrivacyController extends BaseController
{
    public function Privacy(): string
    {
        return view('privacy-policy');
    }
}