<?php

namespace App\Models;

use CodeIgniter\Model;

class ContactModel extends Model
{
    protected $table = 'contact'; // Name of your database table
    protected $primaryKey = 'id'; // Primary key of your table
    protected $allowedFields = ['name', 'email', 'subject', 'message','ipaddress']; // Fields that can be mass-assigned

    // protected $useTimestamps = true; // Enable automatic timestamping (created_at and updated_at)
    // protected $createdField  = 'created_at'; // Column name for the created_at timestamp
    // protected $updatedField  = 'updated_at'; // Column name for the updated_at timestamp

    public function insertContact($data)
      // Set success message
    
    {
        return $this->insert($data); // Insert data into the database table
    }
}
