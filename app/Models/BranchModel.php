<?php

namespace App\Models;

use CodeIgniter\Model;

class BranchModel extends Model
{
    protected $table = 'tbl_branch';
    protected $primaryKey = 'id'; // The primary key here could be the subsidiary ID.
    protected $allowedFields = ['id', 'subsidiary_id','name', 'status', 'code'];

    // Method to get branch name by subsidiary_id
    public function getBranchName($subsidiary_id)
    {
        return $this->where('id', $subsidiary_id)->first()['name'] ?? null;
    }

    // Method to get branches by subsidiary_id
    public function getBranchesBySubsidiary($subsidiary_id)
    {
        return $this->where('subsidiary_id', $subsidiary_id)->findAll();
    }

}
