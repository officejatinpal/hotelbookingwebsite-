<?php

namespace App\Models;

use CodeIgniter\Model;

class TestimonialImageModel extends Model
{
    protected $table = 'testimonial_images';
    protected $primaryKey = 'id';
    protected $allowedFields = ['testimonial_id', 'image'];
}
