<?php

namespace App\Controllers\backend;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\AdminModel;
use App\Models\EmployeeModel;

class AuthController extends BaseController
{
     protected $employeeModel;

    public function __construct()
    {
        $this->employeeModel = new EmployeeModel();
    }
    
   public function index()
    {
        $today = date('m-d');

        $employeesWithBirthday = $this->employeeModel
            ->where("DATE_FORMAT(dob, '%m-%d') =", $today) 
            ->findAll();

        return view('backend/official', [ 'birthdays' => $employeesWithBirthday ]);
    }
    
    public function login()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $role = $this->request->getPost('role'); // Get selected role

        $adminModel = new AdminModel();
        $admin = $adminModel->authenticate($username, $password);

        if ($admin && $admin['role'] === $role) {
            session()->set('role', $admin['role']);

            if ($admin['role'] == 'admin') {
                return redirect()->to('/add_member');
            } elseif ($admin['role'] == 'property') {
                return redirect()->to('/webmaster/add_destination');
            }
            elseif ($admin['role'] == 'employee') {
                return redirect()->to('/employee/register');
            }
        } else {
            return redirect()->to('/official')->with('error', 'Invalid username, password, or role');
        }
    }
    
    public function logout()
{
    session()->destroy(); // Destroy all session data
    return redirect()->to('/official')->with('message', 'Logged out successfully');
}

}