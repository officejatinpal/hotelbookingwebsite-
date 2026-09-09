<?php

namespace App\Controllers;

use App\Models\GalleryModel;

class Gallery extends BaseController
{
    public function index()
    {
        $model = new GalleryModel();

      $data['galleryImages'] = $model
            ->orderBy('id', 'DESC')
            ->findAll();
            
        return view('gallery', $data);
    }
}
