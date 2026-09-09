<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\DestinationModel;
use App\Models\DestidetailModel;
use App\Models\ResortModel;
use App\Models\ResortgallaryModel;

class DestinationApi extends BaseController
{
    protected $destinationModel;
    protected $resortModel;
    protected $resortgallaryModel;

    public function __construct()
    {
        $this->destinationModel   = new DestinationModel();
        $this->resortModel        = new ResortModel();
        $this->resortgallaryModel = new ResortgallaryModel();
    }

    public function category($category)
    {
        $destiDetailModel = new DestidetailModel();

        $destinations = $this->destinationModel
            ->where('status', 1)
            ->where('category', ucfirst(strtolower($category)))
            ->findAll();

        $data = [];

        foreach ($destinations as $destination) {
            $details = $destiDetailModel
                ->where('desti_id', $destination['id'])
                ->where('status', 1)
                ->findAll();

            $image = !empty($details) ? $details[0]['image'] : 'default.jpg';

            $data[] = [
                'id'       => $destination['id'],
                'category' => $destination['category'],
                'name'     => $destination['name'],
                'slug'     => $destination['slug'],
                'image'    => base_url('uploads/destinations/' . $image),
            ];
        }

        return $this->response->setJSON([
            'status'   => true,
            'category' => $category,
            'count'    => count($data),
            'data'     => $data
        ]);
    }

    public function resortsApi($slug)
    {
        $destination = $this->destinationModel->where('slug', $slug)->first();
    
        if (!$destination) {
            return $this->response->setJSON([
                'status'  => false,
                'message' => 'Destination not found'
            ]);
        }
    
        $resorts = $this->resortModel
            ->select('id, name, main_image') 
            ->where('desti_id', $destination['id'])
            ->where('status', 1)
            ->findAll();
    
        $data = [];
    
        foreach ($resorts as $resort) {
            $data[] = [
                'id'    => $resort['id'],
                'name'  => $resort['name'],
                'image' => base_url('uploads/resorts/' . $resort['main_image']),
            ];
        }
    
        return $this->response->setJSON([
            'status'       => true,
            'destination' => [
                'id'   => $destination['id'],
                'name' => $destination['name'],
                'slug' => $destination['slug'],
            ],
            'resorts' => $data
        ]);
    }
    
public function resortDetailApi($resortId = null)
{
    if ($resortId === null) {
        return $this->response->setJSON([
            'status' => false,
            'message' => 'Resort ID is required'
        ]);
    }

    $model = new ResortModel();
    $galleryModel = new ResortgallaryModel();

    $resort = $model->where('id', $resortId)->where('status', 1)->first();

    if (!$resort) {
        return $this->response->setJSON([
            'status' => false,
            'message' => 'Resort not found'
        ]);
    }

    // Gallery
    $gallery = $galleryModel->where('resort_id', $resortId)->findAll();
    $galleryImages = [];
    foreach ($gallery as $img) {
        if (!empty($img['image'])) {
            $galleryImages[] = base_url('uploads/resorts/' . $img['image']);
        }
    }

    $amenities = [
        [
            'name' => 'WiFi',
            'icon' => base_url('asset/icons/wifi.png')
        ],
        [
            'name' => 'Parking',
            'icon' => base_url('asset/icons/parking.png')
        ],
        [
            'name' => 'Food',
            'icon' => base_url('asset/icons/amenities/food.png')
        ],
        [
            'name' => 'Air Conditioned',
            'icon' => base_url('asset/icons/amenities/ac.png')
        ],
        [
            'name' => 'Swimming Pool',
            'icon' => base_url('asset/icons/amenities/pool.png')
        ],
        [
            'name' => 'Room Service',
            'icon' => base_url('asset/icons/room_service.png')
        ],
    ];

    return $this->response->setJSON([
        'status' => true,
        'resort' => [
            'id'      => $resort['id'],
            'name'    => $resort['name'],
            'banner'  => base_url('uploads/resorts/' . $resort['main_image']),
            'descr'   => $resort['descr'] ?? '',
            'address' => $resort['address'] ?? '',
        ],
        'amenities' => $amenities, 
        'gallery'   => $galleryImages
    ]);
}

 public function searchResorts()
{
    $keyword = trim($this->request->getGet('keyword'));

    if (empty($keyword)) {
        return $this->response->setJSON([
            'status' => false,
            'message' => 'Keyword is required'
        ]);
    }

    $builder = $this->resortModel
        ->select('tbl_resort.id, tbl_resort.name, tbl_resort.main_image')
        ->where('tbl_resort.status', 1)
        ->like('tbl_resort.name', $keyword);

    $resorts = $builder->findAll();

    $data = [];
    foreach ($resorts as $resort) {
        $data[] = [
            'id'    => $resort['id'],   
            'name'  => $resort['name'],
            'image' => !empty($resort['main_image'])
                ? base_url('uploads/resorts/' . $resort['main_image'])
                : ''
        ];
    }

    return $this->response->setJSON([
        'status' => true,
        'count'  => count($data),
        'data'   => $data
    ]);
}


}
