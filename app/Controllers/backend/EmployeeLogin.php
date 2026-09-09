<?php

namespace App\Controllers\backend;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\SubsidiaryModel;
use App\Models\BranchModel;
use App\Models\DepartmentModel;
use App\Models\DesignationModel;
use App\Models\EmployeeModel; 
use App\Models\SalaryModel;
use App\Models\AttendanceModel;
use Dompdf\Dompdf;
use Dompdf\Options; // Import Dompdf Options correctly

class EmployeeLogin extends BaseController
{
 
    protected $subsidiaryModel;
    protected $branchModel;
    protected $departmentModel;
    protected $designationModel;
    protected $employeeModel;
    protected $salaryModel;
    protected $session;
    protected $attendanceModel;


    public function __construct()
    {
        $this->subsidiaryModel = new SubsidiaryModel();
        $this->branchModel = new BranchModel();
        $this->departmentModel = new DepartmentModel();
        $this->designationModel = new DesignationModel();
        $this->employeeModel = new EmployeeModel();
        $this->salaryModel = new SalaryModel();
        $this->attendanceModel = new AttendanceModel();

    }
    
    public function login()
    {
        $empID    = $this->request->getVar('empID');
        $password = $this->request->getVar('password');

        if (empty($empID) || empty($password)) {
            return $this->handleError('empID and Password are required');
        }

        $employee = $this->employeeModel->where('empID', $empID)->first();

        if (!$employee) {
            return $this->handleError('empID not Found');
        }

        if ($employee['status'] == 0) {
            return $this->handleError('Your account is inactive. Please contact admin.');
        }

        if (!password_verify($password, $employee['password'])) {
            return $this->handleError('Wrong Password');
        }

        session()->set([
            'empID' => $employee['empID'],
            'isEmployeeLoggedIn' => true,
            'department_id' => $employee['department_id'], 
        ]);


        if ($this->request->isAJAX()) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Login successful',
                'redirect' => '/employee/dashboard'
            ]);
        }

        return redirect()->to('official');
    }

    private function handleError($message)
    {
        if ($this->request->isAJAX()) {
            return $this->response->setJSON(['status' => 'error', 'message' => $message]);
        } else {
            session()->setFlashdata('error', $message);
            return redirect()->back();
        }
    }

    public function employeeprofile()
    {
        $empID    = session()->get('empID');
        $employee = $this->employeeModel->where('empID', $empID)->first();
        $data = [
            'employee'         => $employee,
            'subsidiaryName'   => $this->subsidiaryModel->getSubsidiaryName($employee['subsidiary_id']),
            'branchName'       => $this->branchModel->getBranchName($employee['branch_id']),
            'departmentName'   => $this->departmentModel->getDepartmentName($employee['department_id']),
            'designationTitle' => $this->designationModel->getDesignationTitle($employee['designation_id']),
        ];

        return view('backend/employee_login/dashboardprofile', $data);
    }

    public function changepassword()
    {
        $empID    = session()->get('empID');
        $employee = $this->employeeModel->where('empID', $empID)->first();

        return view('backend/employee_login/change-password', ['employee' => $employee]);
    }

    public function update_password()
    {
        $validation = \Config\Services::validation();

        $validation->setRules([
            'old_pwd'   => 'required',
            'new_pwd'   => 'required|min_length[8]',
            'cnew_pwd'  => 'required|matches[new_pwd]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return $this->response->setJSON(['status' => 0, 'message' => 'Validation failed.']);
        }

        $empID  = $this->request->getPost('empID');
        $oldPwd = $this->request->getPost('old_pwd');
        $newPwd = $this->request->getPost('new_pwd');

        $employee = $this->employeeModel->find($empID);

        if (!$employee || !password_verify($oldPwd, $employee['password'])) {
            return $this->response->setJSON(['status' => 0, 'message' => 'Current password is incorrect.']);
        }

        $this->employeeModel->update($empID, ['password' => password_hash($newPwd, PASSWORD_DEFAULT),
        
        'en_password' => $newPwd
        ]);

        return $this->response->setJSON(['status' => 1, 'message' => 'Password changed successfully.']);
    }

    public function markAttendance()
    {
        return view('backend/employee_login/mark-attendance');
    }

    public function attendance()
    {
        $empID = session()->get('empID');

        $data = [
            'empID'    => $empID,
            'employe'  => $this->attendanceModel->getAttendanceByEmployee($empID)
        ];

        return view('backend/employee_login/attendance', $data);
    }

    public function salaryslip()
    {
        $empID    = session()->get('empID');
        $employee = $this->employeeModel->where('empID', $empID)->first();
        $salaries = $this->salaryModel->where('empID', $empID)->findAll();

        return view('backend/employee_login/salary', [
            'employee' => $employee,
            'salaries' => $salaries,
        ]);
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/official'); // Change this to your login page if needed
    }
}
