<?php

namespace App\Controllers;

class About extends BaseController
{
    public function About(): string
    {
        return view('about');
    }
}
