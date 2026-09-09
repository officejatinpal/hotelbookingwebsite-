<?php

namespace App\Controllers;

use App\Models\ContactModel; // Make sure your model exists

class ReturnPolicy extends BaseController
{
    public function Return(): string
    {
        return view('return-policy');
    }
    
}