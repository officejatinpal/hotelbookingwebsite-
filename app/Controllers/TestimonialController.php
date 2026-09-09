<?php

namespace App\Controllers;

use App\Models\TestimonialModel;
use App\Models\TestimonialImageModel;
use App\Controllers\BaseController;
use App\Models\VideoModel;

class TestimonialController extends BaseController
{
    
  public function index()
{
    $testimonialModel = new TestimonialModel();
    $imageModel       = new TestimonialImageModel();

    $testimonials = $testimonialModel
                        ->orderBy('id', 'DESC') // or 'id', 'DESC'
                        ->findAll();

    foreach ($testimonials as &$t) {

        $t['image'] = $t['image'];

        $images = $imageModel
                    ->where('testimonial_id', $t['id'])
                    ->findAll();

        $t['images'] = array_column($images, 'image');
    }

    return view('review', [
        'testimonials' => $testimonials
    ]);
}
        public function VideoReview()
    {
        $videoModel = new VideoModel();
        $data['videos'] = $videoModel->orderBy('id', 'DESC')->findAll();  // Fetch all videos

        return view('videos_list', $data);
    }
    
}
