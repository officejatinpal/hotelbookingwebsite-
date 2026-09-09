<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DestinationModel;
use App\Models\ResortModel;
use App\Models\ResortgallaryModel;

class DestinationController extends BaseController
{
    protected $destinationModel;
    protected $resortModel;

    public function __construct()
    {
        $this->resortModel = new ResortModel();
        $this->destinationModel = new DestinationModel();
        $this->resortgallaryModel = new ResortgallaryModel();
        
    }

public function city($type, $direction, $city)
{
    $cityName = str_replace('-', ' ', $city);

    // Get city ID
    $cityData = $this->destinationModel
        ->where('LOWER(name)', strtolower($cityName))
        ->first();

    if (!$cityData) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }

    $resorts = $this->resortModel
        ->select('tbl_resort.*, tbl_destination.name as destination_name')
        ->join('tbl_destination', 'tbl_resort.desti_id = tbl_destination.id')
        ->where('tbl_resort.status', 1)
        ->where('tbl_destination.status', 1)
        ->where('tbl_resort.desti_id', $cityData['id'])  
        ->orderBy('tbl_resort.name', 'ASC')
        ->findAll();

    $data = [
        'selected_city' => ucfirst($cityName),
        'resorts' => $resorts,
    ];

    return view('resort_short_details', $data);
}

public function gallaryimage($slug = null)
{
    $detail = $this->resortModel
        ->where('slug', $slug)
        ->first();

    if (!$detail) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }

    $gallery = $this->resortgallaryModel
        ->where('resort_id', $detail['id'])
        ->where('status', 1)
        ->findAll();

    return view('resort_detail', [
        'detail'  => $detail,    
        'gallery' => $gallery  
    ]);
}

}
