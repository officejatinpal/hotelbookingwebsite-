<?php

namespace App\Controllers;

class TermController extends BaseController
{
    public function Term(): string
    {
        return view('termandcondition');
    }
}