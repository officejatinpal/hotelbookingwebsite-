<?php

namespace App\Controllers;

class Bengaluru extends BaseController
{
    public function Bengaluru(): string
    {
        return view('bengaluru');
    }
    
        public function BengaluruReview(): string
    {
        return view('bangalore-reviews');
    }
    
}
