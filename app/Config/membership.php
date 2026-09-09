<?php

namespace App\Controllers;

class Membership extends BaseController
{
    public function membership(): string
    {
        return view('membership');
    }
}