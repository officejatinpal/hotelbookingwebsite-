<?php

namespace App\Models;

use CodeIgniter\Model;


class EmployeeModel extends Model
{
    protected $table = 'tbl_employee';
    protected $primaryKey = 'id'; // Assuming 'id' is the primary key

protected $allowedFields = [
    'branch_id',
    'join_date',
    'empID',
    'subsidiary_id',
    'department_id',
    'designation_id',
    'reporting_name',
    'name',
    'email',
    'mobile',
    'alt_mobile',
    'dob',
    'gender',
    'emer_person',
    'emer_num',
    'address',
    'password',
    'en_password',
    'profile_pic',
    'bank',
    'branch',
    'acc_num',
    'ifsc',
    'pan',
    'aadhar',
    'status',
    'created_at',
    'updated_at',
    'deleted_at'
];


    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at'; // If using soft deletes

        // Method to update employee status
    public function toggleStatus($empID, $newStatus)
    {
        return $this->update($empID, ['status' => $newStatus]);
    }

    public function searchByName($search)
    {
        return $this->groupStart()
            ->like('name', $search)
            ->orLike('empID', $search)
            ->groupEnd()
            ->findAll();
    }

    // Method to fetch employees with search criteria
    public function getEmployees($search = null)
    {
        $builder = $this->db->table('tbl_employee')
                    ->select('tbl_employee.*, tbl_employee.name, tbl_branch.name as branch_name, tbl_department.Name as department_name, tbl_designation.name as designation_name')
                    ->join('tbl_branch', 'tbl_employee.branch_id = tbl_branch.id')
                    ->join('tbl_department', 'tbl_employee.department_id = tbl_department.ID')
                    ->join('tbl_designation', 'tbl_employee.designation_id = tbl_designation.id');

        // Apply search filter if provided
        if ($search) {
            $builder->orLike('tbl_employee.name', $search);
            $builder->orLike('tbl_employee.empID', $search);

        }

        return $builder->get()->getResultArray();
    }
    
 
}
