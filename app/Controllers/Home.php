<?php

namespace App\Controllers;

use App\Models\TestimonialModel;
use App\Models\DestinationModel; 
use App\Models\DestidetailModel; 
use App\Models\ResortModel; 
use App\Models\CarouselModel;

class Home extends BaseController
{

protected $carouselModel;

    public function __construct()
    {
        $this->carouselModel = new CarouselModel();
        $this->destinationModel = new DestinationModel();
    }
    
 public function index()
{
    $destinationModel = new DestinationModel();
    $destiDetailModel = new DestidetailModel();
    $testimonialModel = new TestimonialModel();
    $resortModel = new ResortModel();

    $data['testimonials'] = $testimonialModel->findAll();


    $data['slides'] = $this->carouselModel->where('is_active', 1)->orderBy('sort_order', 'ASC')->findAll();

    $destinations = $destinationModel->where('status', 1)->findAll();

    $data['destinations'] = [];
    foreach ($destinations as $destination) {
        $details = $destiDetailModel
            ->where('desti_id', $destination['id'])
            ->where('status', 1)
            ->findAll();

        $image = !empty($details) ? $details[0]['image'] : 'default.jpg';

        $data['destinations'][] = [
            'id'       => $destination['id'],
            'category' => $destination['category'],
            'name'     => $destination['name'],
            'slug'     => $destination['slug'],
            'status'   => $destination['status'],
            'directions'   => $destination['directions'],
            'image'    => base_url('backend/assets/admin/images/destination' . $image),
            'details'  => $details,
        ];
    }

    return view('index', $data);
}

public function short($slug)
{
    $destination = $this->destinationModel
        ->where('slug', $slug)
        ->first();

    if (!$destination) {
        throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
    }

    return redirect()->to(
        base_url(
            'destination/' .
            strtolower($destination['category']) . '/' .
            strtolower($destination['directions']) . '/' .
            $destination['slug']
        ),
        301
    );
}

public function scanner()
{
    return view('qr_scanner');
}

public function chatbot()
{
    return view('chatbot');
}

}

