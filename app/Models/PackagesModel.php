<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\PackagesModel;

class PackagesModel extends Model
{
    protected $table            = 'tbl_packages';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['location', 'image', 'duration', 'persons', 'price', 'rating', 'meta_description', 'content', 'title', 'slug', 'status' ];

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

    public function getResortDetails($resortId)
    {
        // Use query builder to join the resort and gallery tables
        $builder = $this->builder();
        $builder->select('tbl_packages.title, tbl_packages.content, tbl_packages.location, tbl_packages.image, tbl_packages_gallery.image AS gallery_image');
        $builder->join('tbl_packages_gallery', 'tbl_packages.id = tbl_packages_gallery.resort_id', 'left');
        $builder->where('tbl_packages.id', $resortId);
        
        // Get the results, fetch all images for the resort (in case there are multiple)
        return $builder->get()->getResultArray();
    }
    
public function getAllPackages() {
    return $this->builder()->get()->getResultArray();
}

}
