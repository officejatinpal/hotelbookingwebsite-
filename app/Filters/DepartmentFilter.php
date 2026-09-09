<?php 

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use App\Models\EmployeeModel;   

class DepartmentFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();
        $allowedDepartments = $arguments ?? [];

        $empID = $session->get('empID');

        $employeeModel = new EmployeeModel();
        $employee = $employeeModel->where('empID', $empID)->first();

        if (!$employee || !in_array($employee['department_id'], $allowedDepartments)) {
            return redirect()->to('official')->with('error', 'Access Denied: Not authorized for this section.');
        }

        return; // allow access
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    }
}
