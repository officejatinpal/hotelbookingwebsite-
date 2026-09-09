<?php

namespace App\Controllers;

class Membership extends BaseController
{
    public function Membership(): string
    {
        return view('membership');
    }
}