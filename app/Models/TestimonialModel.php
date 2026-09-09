<?php

namespace App\Models;

use CodeIgniter\Model;

class TestimonialModel extends Model
{
    protected $table = 'testimonials'; 
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'location', 'testimonial', 'image', 'rating'];

    public function addTestimonial($data)
    {
        return $this->insert($data);
    }
}
