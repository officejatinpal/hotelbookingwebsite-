<?php 

namespace App\Models;

use CodeIgniter\Model;

class DesignationModel extends Model
{
    protected $table = 'tbl_designation';
    protected $primaryKey = 'id'; // The primary key here could be the department ID.
    protected $allowedFields = ['id', 'department_id', 'name', 'status'];

    // Method to get designation title by department_id
    public function getDesignationTitle($department_id)
    {
        return $this->where('id', $department_id)->first()['name'] ?? null;
    }

    // Method to get designations by department_id
    public function getDesignationsByDepartment($department_id)
    {
        return $this->where('department_id', $department_id)->findAll();
    }

            
    public function getDesignations()
    {
        return $this->where('status', 1) // Only fetch active departments
                    ->orderBy('id', 'ASC') // Order by ID
                    ->findAll();
    }
    


}

