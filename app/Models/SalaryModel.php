<?php

namespace App\Models;

use CodeIgniter\Model;

class SalaryModel extends Model
{
    protected $table = 'tbl_salary';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'slip_num', 'empID', 'gen_date', 'sal_month', 'sal_year', 'wd', 'pd', 'netsalary', 'payablesalary', 'lwp', 'basic_pay', 'hra', 'ca', 'incentive', 'allowance',
        'arrears', 'esi', 'pf', 'tds', 'advance'
    ];

    // Method to generate unique slip number
    public function generateSlipNumber($empID)
    {
        // Ensure the slip number is unique
        $newSlipNum = $empID . '-' . time();
        while ($this->where('slip_num', $newSlipNum)->first()) {
            $newSlipNum = $empID . '-' . (time() + rand(1, 999)); // Add randomness
        }
        return $newSlipNum;
    }
}
