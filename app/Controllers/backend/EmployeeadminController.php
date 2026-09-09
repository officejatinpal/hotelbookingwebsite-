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
use Dompdf\Options; 

class EmployeeadminController extends BaseController
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

    public function index()
    {
 
    $isAdmin    = session()->get('role') === 'employee';
    $isEmployee = session()->get('isEmployeeLoggedIn') === true;
    $userDept   = session()->get('department_id');

    if (!$isAdmin && (!$isEmployee || $userDept != 8)) {
        return redirect()->to('/official')->with('error', 'Unauthorized access');
    }
    
        $data['subsidiaries'] = $this->subsidiaryModel->getAllSubsidiaries();
        return view('backend/employee_admin/add-employee', $data);

    }

    public function getBranches()
    {
        $subsidiary_id = $this->request->getVar('subsidiary_id');
        $branches = $this->branchModel->getBranchesBySubsidiary($subsidiary_id);
        
        return $this->response->setJSON($branches);
    }

    public function getDepartments()
    {
        $branch_id = $this->request->getVar('branch_id');
        $departments = $this->departmentModel->getDepartmentsByBranch($branch_id);

        return $this->response->setJSON($departments);
    }

    public function getDesignations()
    {
        $department_id = $this->request->getVar('department_id');
        $designations = $this->designationModel->getDesignationsByDepartment($department_id);

        return $this->response->setJSON($designations);
    }
    
    public function dashboard()
{
     $isAdmin    = session()->get('role') === 'employee';
    $isEmployee = session()->get('isEmployeeLoggedIn') === true;
    $userDept   = session()->get('department_id');

    if (!$isAdmin && (!$isEmployee || $userDept != 8)) {
        return redirect()->to('/official')->with('error', 'Unauthorized access');
    }
    
    $search = $this->request->getVar('search') ?? '';
    $limit = (int) ($this->request->getVar('limit') ?? 25);
    $page = (int) ($this->request->getVar('page') ?? 1);
    $offset = ($page - 1) * $limit;

    $builder = $this->employeeModel
        ->select('tbl_employee.*, tbl_branch.name as branch_name, tbl_department.Name as department_name, tbl_designation.name as designation_name')
        ->join('tbl_branch', 'tbl_employee.branch_id = tbl_branch.id')
        ->join('tbl_department', 'tbl_employee.department_id = tbl_department.ID')
        ->join('tbl_designation', 'tbl_employee.designation_id = tbl_designation.id');

    if (!empty($search)) {
        $builder->groupStart()
            ->like('tbl_employee.name', $search)
            ->orLike('tbl_employee.empID', $search)
            ->groupEnd();
    }

    $builder->orderBy('tbl_employee.status', 'DESC');
    $builder->orderBy('tbl_employee.created_at', 'DESC'); 

    $totalRecords = $builder->countAllResults(false);

    $employees = $builder
        ->limit($limit, $offset)
        ->get()
        ->getResultArray();

    $data = [
        'employees'     => $employees,
        'limit'         => $limit,
        'totalRecords'  => $totalRecords,
        'currentPage'   => $page,
        'totalPages'    => ceil($totalRecords / $limit),
        'search'        => $search,
    ];

    if ($this->request->isAJAX()) {
        return $this->response->setJSON([
            'html'         => view('backend/employee_admin/employee_table_rows', $data),
            'totalRecords' => $totalRecords,
            'currentPage'  => $page,
            'limit'        => $limit,
            'startRecord'  => ($page - 1) * $limit + 1,
            'endRecord'    => min($page * $limit, $totalRecords),
            'totalPages'   => ceil($totalRecords / $limit)
        ]);
    }

    return view('backend/employee_admin/all_employee', $data);
}


    public function registerEmployee()
    {
        $validation = \Config\Services::validation();
    
        $validation->setRules([
            'subsidiary_id' => 'required|integer',
            'branch_id'     => 'required|integer',
            'department_id' => 'required|integer',
            'designation_id'=> 'required|integer',
            'empID'         => 'required|string|max_length[100]',
            'join_date'     => 'required|valid_date',
            'name'          => 'required|string|max_length[100]',
            'email'         => 'required|valid_email|max_length[100]',
            'password'      => 'required|string|min_length[8]|max_length[100]',
            'en_password'   => 'required|string|min_length[8]|max_length[100]',
            'mobile'        => 'required|string|max_length[100]',
            'alt_mobile'    => 'permit_empty|string|max_length[100]',
            'dob' => 'required|valid_date[Y-m-d]',
            'gender'        => 'required|in_list[male,female,other]',
            'marital_status'=> 'required|in_list[single,married]',
            'emer_person'   => 'required|string|max_length[100]',
            'emer_num'      => 'required|string|max_length[100]',
            'address'       => 'required|string',
            'bank'          => 'required|string|max_length[100]',
            'branch'        => 'required|string|max_length[100]',
            'acc_num'       => 'required|string|max_length[100]',
            'ifsc'          => 'required|string|max_length[100]',
            'pan'           => 'required|string|max_length[100]',
            'aadhar'        => 'required|string|max_length[100]',
            'status'        => 'required|integer',
        ]);
    
        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }
    
        $existingEmp = $this->employeeModel->where('empID', $this->request->getPost('empID'))
                                           ->orWhere('email', $this->request->getPost('email'))
                                           ->orWhere('mobile', $this->request->getPost('mobile'))
                                           ->first();
    
        if ($existingEmp) {
            $duplicateErrors = [];
    
            if ($existingEmp['empID'] === $this->request->getPost('empID')) {
                $duplicateErrors['empID'] = 'Employee ID already exists.';
            }
            if ($existingEmp['email'] === $this->request->getPost('email')) {
                $duplicateErrors['email'] = 'Email already exists.';
            }
            if ($existingEmp['mobile'] === $this->request->getPost('mobile')) {
                $duplicateErrors['mobile'] = 'Mobile number already exists.';
            }
    
            return redirect()->back()->withInput()->with('errors', $duplicateErrors);
        }
    
        $profilePic = $this->request->getFile('profile_pic');
        
        if ($profilePic && $profilePic->isValid() && !$profilePic->hasMoved()) {
        
            $destination = FCPATH . 'uploads/employee';
            $newFileName = $profilePic->getRandomName();
            $profilePic->move($destination, $newFileName);
        
        } else {

            $newFileName = 'default.png';
        }

        $employeeData = [
            'subsidiary_id' => $this->request->getPost('subsidiary_id'),
            'branch_id'     => $this->request->getPost('branch_id'),
            'department_id' => $this->request->getPost('department_id'),
            'designation_id'=> $this->request->getPost('designation_id'),
            'reporting_name'=> $this->request->getPost('reporting_name'),
            'empID'         => $this->request->getPost('empID'),
            'join_date'     => $this->request->getPost('join_date'),
            'name'          => $this->request->getPost('name'),
            'email'         => $this->request->getPost('email'),
            'password'      => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'en_password'   => $this->request->getPost('en_password'),
            'mobile'        => $this->request->getPost('mobile'),
            'alt_mobile'    => $this->request->getPost('alt_mobile'),
            'dob'           => $this->request->getPost('dob'),
            'gender'        => $this->request->getPost('gender'),
            'marital_status'=> $this->request->getPost('marital_status'),
            'emer_person'   => $this->request->getPost('emer_person'),
            'emer_num'      => $this->request->getPost('emer_num'),
            'address'       => $this->request->getPost('address'),
            'profile_pic'   => $newFileName,
            'bank'          => $this->request->getPost('bank'),
            'branch'        => $this->request->getPost('branch'),
            'acc_num'       => $this->request->getPost('acc_num'),
            'ifsc'          => $this->request->getPost('ifsc'),
            'pan'           => $this->request->getPost('pan'),
            'aadhar'        => $this->request->getPost('aadhar'),
            'status'        => $this->request->getPost('status'),
        ];
    
        $this->employeeModel->insert($employeeData);
    
        return redirect()->to('/employee/register')->with('success', 'Employee registered successfully.');
    }
    
    
    public function editEmployee($id)
    {
        
        $isAdmin    = session()->get('role') === 'employee';
    $isEmployee = session()->get('isEmployeeLoggedIn') === true;
    $userDept   = session()->get('department_id');

    if (!$isAdmin && (!$isEmployee || $userDept != 8)) {
        return redirect()->to('/official')->with('error', 'Unauthorized access');
    }
    
        $employee = $this->employeeModel->find($id);
        
        if (!$employee) {
            return redirect()->to('/backend/employee_admin/all_employee')->with('error', 'Employee not found.');
        }
        
        $subsidiaries = $this->subsidiaryModel->findAll();
        $branches = $this->branchModel->findAll(); 
        $departments = $this->departmentModel->findAll();
        $designations = $this->designationModel
        ->getDesignationsByDepartment($employee['department_id']);
        
        $data = [
            'employee' => $employee,
            'subsidiaries' => $subsidiaries,
            'branches' => $branches, 
            'departments' => $departments,
            'designations' => $designations
        ];

        return view('backend/employee_admin/edit_employee', $data);
    }

    public function updateEmployee($id)
    {
        $validation = \Config\Services::validation();
    
        $validation->setRules([
            'subsidiary_id' => 'required|integer',
            'branch_id'     => 'required|integer',
            'department_id' => 'required|integer',
            'designation_id'=> 'required|integer',
            'empID'         => 'required|string|max_length[100]',
            'join_date'     => 'required|valid_date',
            'name'          => 'required|string|max_length[100]',
            'email'         => 'required|valid_email|max_length[100]',
            'mobile'        => 'required|string|max_length[100]',
            'alt_mobile'    => 'permit_empty|string|max_length[100]',
            'dob'           => 'required|valid_date',
            'gender'        => 'required|in_list[male,female,other]',
            'marital_status'=> 'required|in_list[single,married]',
            'password'      => 'permit_empty|min_length[8]',
            'en_password'   => 'permit_empty',
            'emer_person'   => 'required|string|max_length[100]',
            'emer_num'      => 'required|string|max_length[100]',
            'address'       => 'required|string',
            'bank'          => 'required|string|max_length[100]',
            'branch'        => 'required|string|max_length[100]',
            'acc_num'       => 'required|string|max_length[100]',
            'ifsc'          => 'required|string|max_length[100]',
            'pan'           => 'required|string|max_length[100]',
            'aadhar'        => 'required|string|max_length[100]',
            'status'        => 'required|integer',
        ]);
    
        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }
    
        $employeeData = [
            'subsidiary_id' => $this->request->getPost('subsidiary_id'),
            'branch_id'     => $this->request->getPost('branch_id'),
            'department_id' => $this->request->getPost('department_id'),
            'designation_id'=> $this->request->getPost('designation_id'),
            'reporting_name'         => $this->request->getPost('reporting_name'),
            'empID'         => $this->request->getPost('empID'),
            'join_date'     => $this->request->getPost('join_date'),
            'name'          => $this->request->getPost('name'),
            'email'         => $this->request->getPost('email'),
            'mobile'        => $this->request->getPost('mobile'),
            'alt_mobile'    => $this->request->getPost('alt_mobile'),
            'dob'           => $this->request->getPost('dob'),
            'gender'        => $this->request->getPost('gender'),
            'marital_status'=> $this->request->getPost('marital_status'),
            'emer_person'   => $this->request->getPost('emer_person'),
            'emer_num'      => $this->request->getPost('emer_num'),
            'address'       => $this->request->getPost('address'),
            'bank'          => $this->request->getPost('bank'),
            'branch'        => $this->request->getPost('branch'),
            'acc_num'       => $this->request->getPost('acc_num'),
            'ifsc'          => $this->request->getPost('ifsc'),
            'pan'           => $this->request->getPost('pan'),
            'aadhar'        => $this->request->getPost('aadhar'),
            'status'        => $this->request->getPost('status'),
        ];
    
        if ($this->request->getPost('password')) {
            $employeeData['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
            $employeeData['en_password'] = $this->request->getPost('en_password');
        }
    
            $oldImage  = $this->request->getPost('old_profile_pic');
            $imageFile = $this->request->getFile('profile_pic');
            
            // ðŸ‘‡ default image name
            $defaultImage = 'default.png';
            
            if ($imageFile && $imageFile->isValid() && !$imageFile->hasMoved()) {
            
                // ðŸ”¹ New image upload
                $newName = $imageFile->getRandomName();
                $imageFile->move('uploads/employee', $newName);
            
                $employeeData['profile_pic'] = $newName;
            
                // ðŸ”¹ Old image delete (but NOT default image)
                if (
                    !empty($oldImage) &&
                    $oldImage !== $defaultImage &&
                    file_exists('uploads/employee/' . $oldImage)
                ) {
                    unlink('uploads/employee/' . $oldImage);
                }
            
            } else {
            
                // ðŸ”¹ No new image uploaded
                if (!empty($oldImage)) {
                    // purani image rakho
                    $employeeData['profile_pic'] = $oldImage;
                } else {
                    // kuch bhi nahi â†’ default image
                    $employeeData['profile_pic'] = $defaultImage;
                }
            }
    
        $this->employeeModel->update($id, $employeeData);
    
        return redirect()->back()->with('success', 'Employee updated successfully!');
    }

    
public function toggleStatus($empID)
{
    $employee = $this->employeeModel->find($empID);
    $newStatus = ($employee['status'] == 1) ? 0 : 1;

    if ($this->employeeModel->toggleStatus($empID, $newStatus)) {
        return $this->response->setJSON([
            'success' => true,
            'status' => $newStatus,
            'message' => 'Status updated successfully'
        ]);
    } else {
        return $this->response->setJSON([
            'success' => false,
            'message' => 'Failed to update status'
        ]);
    }
}

public function generate_emp_salary($empID = null)
{
    $role = session()->get('role');

    if ($role !== 'employee') {
        return redirect()->to('/official')
            ->with('error', 'Unauthorized access');
    }
  
     if ($empID === null) {
            return redirect()->back()->with('error', 'employee id not found in URL!');
        }
               $employee['empID'] = $empID;
               

    return view('backend/employee_admin/generate-salary', $employee);
}

    public function generate_emp_salary_process()
    {    
        $empID = $this->request->getPost('empID');
        $sal_month = $this->request->getPost('sal_month');
        $sal_year = $this->request->getPost('sal_year');
    
        $salaryModel = new SalaryModel();
        $existingSlip = $salaryModel->where('empID', $empID)
                                     ->where('sal_month', $sal_month)
                                     ->where('sal_year', $sal_year)
                                     ->first();
    
        if ($existingSlip) {
            return redirect()->back()->with('warning', 'A salary slip for this employee for the year ' . $sal_month . ' already exists. Please check the details.');
        }
    
        $slipNum = $salaryModel->generateSlipNumber($empID); 
        
        $data = [
            'slip_num'    => $slipNum,
            'empID'       => $empID,
            'sal_month'   => $sal_month,
            'gen_date'     => date('Y-m-d'),
            'sal_year'    => $sal_year,
            'wd'          => $this->request->getPost('wd'),
            'pd'          => $this->request->getPost('pd'),
            'lwp'         => $this->request->getPost('lwp'),
            'netsalary'         => $this->request->getPost('netsalary'),
            'payablesalary'         => $this->request->getPost('payablesalary'),
            'basic_pay'   => $this->request->getPost('basic_pay'),
            'hra'         => $this->request->getPost('hra'),
            'ca'          => $this->request->getPost('ca'),
            'incentive'   => $this->request->getPost('incentive'),
            'allowance'   => $this->request->getPost('allowance'),
            'arrears'     => $this->request->getPost('arrears'),
            'esi'         => $this->request->getPost('esi'),
            'pf'          => $this->request->getPost('pf'),
            'tds'         => $this->request->getPost('tds'),
            'advance'     => $this->request->getPost('advance')
        ];
    
        if ($salaryModel->insert($data)) {
            return redirect()->back()->with('success', 'Salary slip generated successfully!');
        } else {
            return redirect()->back()->with('error', 'Failed to generate salary slip.');
        }
    }
    
  
 public function GenerateviewSalaries($empID = null)
{
    $role = session()->get('role');
    if ($role !== 'employee') {
        return redirect()->to('/official')->with('error', 'Unauthorized access');
    }

    $salaryModel = new SalaryModel();

    $limit = 100;
    $page = max(1, (int) $this->request->getGet('page'));
    $offset = ($page - 1) * $limit;

    // ✅ URL se empID aayega
    if (!empty($empID)) {
        $salaryModel->where('empID', $empID);
    }

    $total = $salaryModel->countAllResults(false);

    $salaries = $salaryModel
        ->orderBy('id', 'DESC')
        ->findAll($limit, $offset);

    return view('backend/employee_admin/Generated-view-salaryslip', [
        'salaries' => $salaries,
        'empID'    => $empID,
        'page'     => $page,
        'limit'    => $limit,
        'total'    => $total,
    ]);
}

    public function allsalaryedit($id)
{

    $salary = $this->salaryModel->find($id);
    return view('backend/employee_admin/edit-generated-all-salary', ['salary' => $salary]);
}

public function allsalaryupdate($id)
{
    $data = [
        
            'sal_month'   => $this->request->getPost('sal_month'),
            'sal_year'    => $this->request->getPost('sal_year'),
            'wd'          => $this->request->getPost('wd'),
            'pd'          => $this->request->getPost('pd'),
            'lwp'         => $this->request->getPost('lwp'),
            'netsalary'   => $this->request->getPost('netsalary'),
            'payablesalary' => $this->request->getPost('payablesalary'),
            'basic_pay'   => $this->request->getPost('basic_pay'),
            'hra'         => $this->request->getPost('hra'),
            'ca'          => $this->request->getPost('ca'),
            'incentive'   => $this->request->getPost('incentive'),
            'allowance'   => $this->request->getPost('allowance'),
            'arrears'     => $this->request->getPost('arrears'),
            'esi'         => $this->request->getPost('esi'),
            'pf'          => $this->request->getPost('pf'),
            'tds'         => $this->request->getPost('tds'),
            'advance'     => $this->request->getPost('advance')
    ];

    $this->salaryModel->update($id, $data);

    return redirect()->back()->with('success', 'Salary updated successfully');
}
    
    public function salary_search()
    {
        $empID = session()->get('empID');
        $search_sal_year = $this->request->getPost('search_sal_year');
        
        if (!$search_sal_year) {
            return "<tr><td colspan='7' class='text-center'><b>No year selected!</b></td></tr>";
        }
    
        $salaries = $this->salaryModel->where('empID', $empID)
                                      ->where('sal_year', $search_sal_year)
                                      ->findAll();
    
        if (!empty($salaries)) {
            $output = '';
            $count = 1;
            foreach ($salaries as $salary) {
                $output .= '<tr>';
                $output .= '<td>' . $count++ . '</td>';
                $output .= '<td>' . esc($salary['gen_date']) . '</td>';
                $output .= '<td>' . esc($salary['sal_month']) . '</td>';
                $output .= '<td>' . esc($salary['sal_year']) . '</td>';
                $output .= '<td>' . esc($salary['basic_pay']) . '</td>';
                $output .= '<td>' . esc($salary['slip_num']) . '</td>';
                $output .= '<td>
                <a href="' . site_url('salary/view_pdf/' . esc($salary['slip_num'])) . '" class="btn btn-info">View</a>
                <a href="' . site_url('salary/download_pdf/' . esc($salary['slip_num'])) . '" class="btn btn-info">Download</a>
                    </td>';
                $output .= '</tr>';
            }
            return $output;
        } else {
            return "<tr><td colspan='7' class='text-center'><b>NO DATA FOUND</b></td></tr>";
        }
    }

public function view_pdf($slip_num)
{
    $salaryData = $this->salaryModel->where('slip_num', $slip_num)->first();

    if (!$salaryData) {
        return redirect()->back()->with('error', 'Salary slip not found.');
    }

    $html = $this->generatePDFHtml($salaryData);

    return $this->generatePDF($html, 'I');
}

public function download_pdf($slip_num) {

    $salaryData = $this->salaryModel->where('slip_num', $slip_num)->first();

    if (!$salaryData) {
        return redirect()->back()->with('error', 'Salary slip not found.');
    }

    $html = $this->generatePDFHtml($salaryData);
    
    $this->generatePDF($html, 'D'); 
}


private function generatePDF($html, $mode) {

    $options = new \Dompdf\Options();
    $options->set('defaultFont', 'Arial');
    $options->set('isRemoteEnabled', true);   // ⭐ Important

    $dompdf = new \Dompdf\Dompdf($options);

    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();

    $dompdf->stream('salary_slip.pdf', ["Attachment" => $mode === 'D']);

    exit;
}

private function generatePDFHtml($salaryData)
{
    $session = session();

    $role = $session->get('role');


    // ✅ Employee login
    if ($session->get('isEmployeeLoggedIn')) {
        $empID = $session->get('empID');
    } 
    // ✅ Admin panel (role = employee)
    elseif ($role === 'employee') {
        $empID = $salaryData['empID'];
    } 

    else {
        return '<h3 style="color:red;">Unauthorized Access</h3>';
    }

    if (empty($empID)) {
        return '<h3 style="color:red;">Employee ID not found</h3>';
    }

    $employee = $this->employeeModel
        ->select('tbl_employee.*, tbl_designation.name as designation_name')
        ->join('tbl_designation', 'tbl_designation.id = tbl_employee.designation_id', 'left')
        ->where('tbl_employee.empID', $empID)
        ->first();

    $data = [
        'employee' => $employee,
        'salaryData' => $salaryData,
    ];

    return view('backend/employee_login/salary_pdf_view', $data);
}
  
public function attendence_search()
{
    if ($this->request->isAJAX()) {
        $month = $this->request->getPost('search_month');
        $year = $this->request->getPost('search_year');
        $empID = $this->request->getPost('search_empID');

        $attendanceData = $this->attendanceModel->getFilteredAttendance($empID, $month, $year);

        return view('backend/employee_login/attendance_data', ['employe' => $attendanceData]);
    }
}

 public function attendance_success()
 {
     $session = session();
 
     if (!$session->get('isEmployeeLoggedIn')) {
         return redirect()->to('/official')->with('error', 'Please log in to mark attendance.');
     }
 
     $empID = $this->request->getVar('empID');
     $imageData = $this->request->getVar('image');
     
     date_default_timezone_set('Asia/Kolkata');
     
     $date = date('Y-m-d');
     $time = date('H:i:s'); 
 
     $existingAttendance = $this->attendanceModel->where('empID', $empID)
         ->where('atten_date', $date)
         ->first();
 
     if ($existingAttendance) {
         $session->setFlashdata('error', 'Attendance for today has already been marked.');
         return redirect()->to('/employee/attendance');
     }
 
     if (preg_match('/^data:image\/(\w+);base64,/', $imageData, $type)) {
         $data = substr($imageData, strpos($imageData, ',') + 1);
         $data = base64_decode($data);
 
         $fileName = 'attendance_' . $empID . '_' . time() . '.jpg';
         $directoryPath = FCPATH . 'uploads/attendance/';
 
         if (!is_dir($directoryPath)) {
             mkdir($directoryPath, 0755, true); 
         }
 
         $filePath = $directoryPath . $fileName;
 
         if (file_put_contents($filePath, $data)) {
             $attendanceData = [
                 'empID' => $empID,
                 'atten_date' => $date,
                 'atten_month' => date('n'),
                 'atten_year' => date('Y'),
                 'in_time' => $time, 
                 'atten_image' => $fileName,
                 'status' => 'Present'
             ];
 
             if ($this->attendanceModel->insert($attendanceData)) {
                 $session->setFlashdata('success', 'Attendance marked successfully.');
             } else {
                 $session->setFlashdata('error', 'Failed to mark attendance. Please try again.');
             }
         } else {
             $session->setFlashdata('error', 'Failed to save the image. Please try again.');
         }
     } else {
         $session->setFlashdata('error', 'Invalid image data.');
     }
 
     return redirect()->to('/employee/attendance');
 }

   public function allttendance()
     {
          $role = session()->get('role');
          if ($role !== 'employee') {
         return redirect()->to('/official')->with('error', 'Unauthorized access');
         }
 
         $allttendance = $this->attendanceModel->findAll();
            $data = [
                    
                    'employe' => $allttendance,
            ];

         return view('backend/employee_admin/all_Attendance', $data); 
     }     

     public function allattendence_search()
     {
         $search_month = $this->request->getPost('search_month');
         $search_year = $this->request->getPost('search_year');
         $search_empID = $this->request->getPost('search_empID');
     
         $attendanceModel = new AttendanceModel();
         
         $builder = $attendanceModel->where('atten_month', $search_month)
             ->where('atten_year', $search_year);
     
         if (!empty($search_empID)) {
             $builder->where('empID', $search_empID);
         }
     
         $results = $builder->findAll();
     
         if (!empty($results)) {
             $data = '';
             foreach ($results as $attendance) {
                 $data .= '<tr>';
                 $data .= '<td>' . esc($attendance['id']) . '</td>';
                 $data .= '<td>' . date('d-m-Y', strtotime($attendance['atten_date'])) . '</td>';
                 $data .= '<td>' . date('h:i A', strtotime($attendance['in_time'])) . '</td>';
                 $data .= '<td>' . date('h:i A', strtotime($attendance['out_time'])) . '</td>';
                 $data .= '<td><img src="' . base_url('uploads/attendance/' . $attendance['atten_image']) . '"></td>';
                 $data .= '<td>' . esc($attendance['status']) . '</td>';
                 $data .= '</tr>';
             }
             return $this->response->setJSON(['status' => 'success', 'data' => $data]);
         } else {
             return $this->response->setJSON(['status' => 'error', 'message' => 'No attendance data found for the selected criteria.']);
         }
     }

     public function addMultipleBranches()
     {
         $subsidiaryId = $this->request->getPost('subsidiary_id');
         $branchNames = $this->request->getPost('branch_names');
         $branchCodes = $this->request->getPost('branch_codes');
     
         if (!empty($subsidiaryId) && !empty($branchNames) && !empty($branchCodes)) {
             $data = [];
             foreach ($branchNames as $index => $name) {
                 $data[] = [
                     'subsidiary_id' => $subsidiaryId,
                     'name' => $name,
                     'code' => $branchCodes[$index],
                     'status' => 1,
                 ];
             }
     
             $this->branchModel->insertBatch($data);
     
             session()->setFlashdata('success', 'Branches added successfully.');
         } else {
             session()->setFlashdata('error', 'Please fill out all fields.');
         }
     
         return redirect()->back();
     }
     
     public function AddBranches()
     {
             $role = session()->get('role');
             if ($role !== 'employee') {
            return redirect()->to('/official')->with('error', 'Unauthorized access');
            }

         $data['branches'] = $this->branchModel->findAll();
         $data['subsidiaries'] = $this->subsidiaryModel->findAll();
         $data['success'] = session()->getFlashdata('success');
         $data['error'] = session()->getFlashdata('error');
     
         return view('backend/employee_admin/add-branch-name', $data);
     }

     public function addMultipledepartment()
{
    $branchId = $this->request->getPost('branch_id');
    $departmentNames = $this->request->getPost('department_names');

    if (!empty($branchId) && !empty($departmentNames)) {
        $data = [];
        foreach ($departmentNames as $name) {
            if (!empty(trim($name))) {
                $data[] = [
                    'branch_id' => $branchId,
                    'name' => trim($name), 
                    'status' => 1, 
                ];
            }
        }

        if (!empty($data)) {
            $this->departmentModel->insertBatch($data);
            session()->setFlashdata('success', 'Departments added successfully.');
        } else {
            session()->setFlashdata('error', 'No valid department names provided.');
        }
    } else {
        session()->setFlashdata('error', 'Please fill out all fields.');
    }

    return redirect()->back();
}

public function AddDepartment()
{
        $role = session()->get('role');
        if ($role !== 'employee') {
        return redirect()->to('/official')->with('error', 'Unauthorized access');
        }

    $data['branches'] = $this->branchModel->findAll(); 
    $data['success'] = session()->getFlashdata('success');
    $data['error'] = session()->getFlashdata('error');
    $data['departments'] = $this->departmentModel->getDepartments();

    return view('backend/employee_admin/add-department-name', $data);
}

public function addMultipleDesignation()
{
    $departmentId = $this->request->getPost('department_id');
    $designationNames = $this->request->getPost('designation_names');

    if (!empty($departmentId) && !empty($designationNames)) {
        $data = [];
        foreach ($designationNames as $name) {
            if (!empty(trim($name))) {
                $data[] = [
                    'department_id' => $departmentId,
                    'name' => trim($name), 
                    'status' => 1, 
                ];
            }
        }

        if (!empty($data)) {
            $this->designationModel->insertBatch($data);
            session()->setFlashdata('success', 'Designations added successfully.');
        } else {
            session()->setFlashdata('error', 'No valid designation names provided.');
        }
    } else {
        session()->setFlashdata('error', 'Please fill out all fields.');
    }

    return redirect()->back();
}

public function AddDesignation()
{
    $role = session()->get('role');
    if ($role !== 'employee') {
    return redirect()->to('/official')->with('error', 'Unauthorized access');
    }
    
    $data['designations'] = $this->designationModel->getDesignations();
    $data['departments'] = $this->departmentModel->findAll(); 
    $data['success'] = session()->getFlashdata('success');
    $data['error'] = session()->getFlashdata('error');

    return view('backend/employee_admin/add-designation-name', $data);
}
   
}