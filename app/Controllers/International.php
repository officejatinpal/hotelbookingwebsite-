<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DestinationModel;
use App\Models\ResortModel;
use App\Models\ResortgallaryModel;


class International extends BaseController
{
    protected $destinationModel;
    protected $resortModel;
    protected $resortgallaryModel;


    public function __construct()
    {
        $this->resortModel = new ResortModel();
        $this->destinationModel = new DestinationModel();
        $this->resortgallaryModel = new ResortgallaryModel();
        
    }

    public function index()
    {
        $category = 'International';
    
        $cities = $this->destinationModel
            ->select('id, name')
            ->where('category', $category)
            ->where('status', 1)  
            ->orderBy('name', 'ASC') 
            ->findAll();
    
        $resorts = $this->resortModel
            ->select('tbl_resort.*, tbl_destination.name as destination_name, tbl_destination.status as destination_status')
            ->join('tbl_destination', 'tbl_resort.desti_id = tbl_destination.id')
            ->where('tbl_resort.desti_category', $category)
            ->where('tbl_resort.status', 1)  
            ->where('tbl_destination.status', 1)  
            ->findAll();
    
        // Prepare data for the view
        $data = [
            'category' => $category,
            'cities' => $cities,
            'resorts' => $resorts,
        ];
    
        return view('international', $data);
    }
    
    public function filterByCity()
    {
        $city_ids = $this->request->getPost('city_ids');
        $category = 'International'; 
        
        $cities = $this->destinationModel
            ->select('id, name')
            ->where('category', $category)
            ->where('status', 1) 
            ->findAll();
        
        if (!empty($city_ids)) {
            $resorts = $this->resortModel
                ->select('tbl_resort.*, tbl_destination.status as destination_status')
                ->join('tbl_destination', 'tbl_resort.desti_id = tbl_destination.id')
                ->whereIn('desti_id', $city_ids)
                ->whereIn('desti_id', array_column($cities, 'id'))
                ->where('tbl_resort.status', 1)  
                ->where('tbl_destination.status', 1) 
                ->findAll();
        } else {
            $resorts = $this->resortModel
                ->select('tbl_resort.*, tbl_destination.status as destination_status')
                ->join('tbl_destination', 'tbl_resort.desti_id = tbl_destination.id')
                ->whereIn('desti_id', array_column($cities, 'id'))
                ->where('tbl_resort.status', 1) 
                ->where('tbl_destination.status', 1)  
                ->findAll();
        }
    
        if (!empty($resorts)) {
            $count = 0; 
            echo '<div class="container">'; 
            foreach ($resorts as $resort) {
                if ($count % 2 === 0) {
                    echo '<div class="row g-2">'; 
                }
    
                $description = implode(' ', array_slice(explode(' ', $resort['descr']), 0, 20)) . '...';
    
                $destination = $this->destinationModel->find($resort['desti_id']);
    
                // Resort card
                echo '
                    <div class="col-md-6 mb-4"> <!-- Display 2 items per row with margin-bottom -->
                        <div class="destination-item">
                            <div class="destination-img">
                                <img src="' . base_url('uploads/resorts/' . $resort['main_image']) . '" alt="' . $resort['name'] . '" class="img-fluid top-rounded-img">
                            </div>
                            <div class="destination-content">
                                <h3>' . $resort['name'] . '</h3>
                                <p>' . $description . '</p>
                                <a href="' . base_url('resort/' . $resort['id']) . '" class="btn btn-primary"> Read more</a>
                            </div> 
                            <div class="detailsEnclude"><br>
                                <h6 style="padding: 10px">Details and Includes</h6>
                                <div class="row text-center desti_icon_main">
                                    <div class="col-2">
                                        <div class="desti_icon">
                                            <img src="asset/icons/bad.png" alt="Hotel" class="img-fluid icon-bordered">
                                            <p>Hotel</p>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="desti_icon">
                                            <img src="asset/icons/bus.png" alt="Transfer" class="img-fluid icon-bordered">
                                            <p>Transfer</p>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="desti_icon">
                                            <img src="asset/icons/bag.png" alt="Luggage" class="img-fluid icon-bordered">
                                            <p>Luggage</p>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="desti_icon">
                                            <img src="asset/icons/location1.png" alt="Location" class="img-fluid icon-bordered">
                                            <p>' . ($destination ? $destination['name'] : $resort['desti_id']) . '</p>
                                        </div>
                                    </div>
                                </div>
                            </div>                          
                        </div>
                    </div>
                ';
    
                $count++;
    
                if ($count % 2 === 0) {
                    echo '</div>';
                }
            }
    
            if ($count % 2 !== 0) {
                echo '</div>';
            }
    
            echo '</div>'; 
        } else {
            echo '<div class="text-center"><p>No resorts found.</p></div>';
        }
    }


}
