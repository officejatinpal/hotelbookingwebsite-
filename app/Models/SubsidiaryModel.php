<?php 

namespace App\Models;

use CodeIgniter\Model;

class SubsidiaryModel extends Model
{
    protected $table = 'tbl_subsidiary';
    protected $primaryKey = 'id'; // The primary key for the subsidiary table.
    protected $allowedFields = ['id', 'name'];

    public function getAllSubsidiaries()
    {
        return $this->findAll();
    }

    // Method to get the name of a subsidiary by its ID
    public function getSubsidiaryName($subsidiary_id)
    {
        return $this->where('id', $subsidiary_id)->first()['name'] ?? null;
    }
    
   
}

