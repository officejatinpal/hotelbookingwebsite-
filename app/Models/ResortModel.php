<?php

namespace App\Models;

use CodeIgniter\Model;

class ResortModel extends Model
{
    protected $table            = 'tbl_resort';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['desti_category', 'desti_id', 'name', 'slug', 'main_image', 'descr', 'external_url', 'longi', 'lati', 'address', 'status'];
    
    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function getResortsByDestination($desti_id)
    {
        return $this->where('desti_id', $desti_id)->findAll();
    }

       // Method to update employee status
       public function toggleStatus($empID, $newStatus)
       {
           return $this->update($empID, ['status' => $newStatus]);
       }

       public function getDestinationsByCities($city_ids)
{
    return $this->db->table('tbl_resort')
        ->whereIn('city_id', $city_ids)
        ->get()
        ->getResultArray();
}
   
      public function getResortDetails($resortId)
    {
        // Use query builder to join the resort and gallery tables
        $builder = $this->builder();
        $builder->select('tbl_resort.name, tbl_resort.descr, tbl_resort.address, tbl_resort.main_image, tbl_resort_gallery.image AS gallery_image');
        $builder->join('tbl_resort_gallery', 'tbl_resort.id = tbl_resort_gallery.resort_id', 'left');
        $builder->where('tbl_resort.id', $resortId);
        
        // Get the results, fetch all images for the resort (in case there are multiple)
        return $builder->get()->getResultArray();
    }
    
}
