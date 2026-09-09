<?php 

namespace App\Models;

use CodeIgniter\Model;

class DepartmentModel extends Model
{
    protected $table = 'tbl_department';
    protected $primaryKey = 'id'; // The primary key for the department table.
    protected $allowedFields = ['id', 'branch_id', 'name', 'status'];

    // Method to get department name by its ID
    public function getDepartmentName($branch_id)
    {
        return $this->where('id', $branch_id)->first()['name'] ?? null;
    }

    // Method to get departments by branch_id (if applicable)
    public function getDepartmentsByBranch($branch_id)
    {
        // If your table has a `branch_id` foreign key, you can add this:
        return $this->where('branch_id', $branch_id)->findAll();
    }
        
    public function getDepartments()
    {
        return $this->where('status', 1) // Only fetch active departments
                    ->orderBy('id', 'ASC') // Order by ID
                    ->findAll();
    }
    
}

