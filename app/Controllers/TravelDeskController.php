<?php

namespace App\Controllers;
use App\Models\TravelDeskModel;

class TravelDeskController extends BaseController
{

    protected $travelModel;


 public function __construct()
    {
        $this->travelModel = new TravelDeskModel();
    }

public function index()
{
    // Fetch all active blogs, latest first
    $travel = $this->travelModel
        ->where('status', 1)
        ->orderBy('id', 'DESC') // or use 'created_at' if you have a date field
        ->findAll();

    return view('travel_desk', ['travels' => $travel]);
}

    public function view($slug)
{
    $desk = $this->travelModel->where('slug', $slug)->first();

    if (!$desk) {
        throw new \CodeIgniter\Exceptions\PageNotFoundException('Blog not found');
    }

    return view('travel_desk_view', ['desk' => $desk]);
}

    
}