<?php

namespace App\Models;

use CodeIgniter\Model;

class AttendanceModel extends Model
{
    protected $table = 'tbl_emp_attendence';
    protected $primaryKey = 'id';
    protected $allowedFields = ['empID', 'atten_date', 'atten_month', 'atten_year', 'in_time', 'out_time', 'atten_image', 'status'];

    // Fetch attendance for a specific employee
    public function getAttendanceByEmployee($empID)
    {
        return $this->where('empID', $empID)
                    ->orderBy('atten_date', 'DESC')
                    ->findAll();
    }

    // Fetch filtered attendance based on employee ID, month, and year
    public function getFilteredAttendance($empID, $month, $year)
    {
        return $this->where('empID', $empID)
                    ->where('atten_month', $month)
                    ->where('atten_year', $year)
                    ->orderBy('atten_date', 'DESC')
                    ->findAll();
    }
}
