<?php

namespace App\Models;

use CodeIgniter\Model;

class BookingModel extends Model
{
    protected $table = 'booking'; // Specify the table name
    protected $primaryKey = 'id'; // Specify the primary key field

    protected $allowedFields = [
        'name',
        'email',
        'datetime',
        'destination',
        'persons',
        'kids',
        'message'
    ];

    public function insertBooking($data)
    {
        return $this->insert($data); // Insert data into the database table
    }
    // Optionally, define any custom methods for your model here
}
