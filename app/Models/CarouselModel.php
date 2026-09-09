<?php

namespace App\Models;

use CodeIgniter\Model;

class CarouselModel extends Model
{
    protected $table = 'carousel_slides';
    protected $primaryKey = 'id';
    protected $allowedFields = ['type', 'file_name', 'caption', 'is_active', 'sort_order'];
    protected $useTimestamps = true;
}
