<?php

namespace App\Controllers;

class packages extends BaseController
{
    public function packages(): string
    {
        return view('packages');
    }
}