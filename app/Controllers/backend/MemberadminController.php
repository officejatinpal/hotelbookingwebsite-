<?php

namespace App\Controllers\Backend;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserModel;
use App\Models\SubsidiaryModel;
use App\Models\BranchModel;
use App\Models\HolidayModel;
use App\Models\DestinationModel;
use App\Models\ResortModel;
use App\Models\OfferModel;
use App\Models\GenerateconformvoucherModel;
use App\Models\GenerateholidayvoucherModel;
use App\Models\GenerategiftvoucherModel;
use App\Models\GenerateinvoiceModel;
use Dompdf\Dompdf;
use Dompdf\Options; 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class MemberadminController extends BaseController
{
    protected $userModel;
    protected $subsidiaryModel;
    protected $branchModel;
    protected $managerModel;
    protected $holidayModel;
    protected $saleexecutiveModel;
    protected $destinationModel;
    protected $resortModel;
    protected $offerModel;
    protected $generateconformvoucherModel;
    protected $generateholidayvoucherModel;
    protected $generategiftvoucherModel;
    protected $GenerateinvoiceModel;


public function __construct()
{
    $this->userModel = new UserModel();
    $this->subsidiaryModel = new SubsidiaryModel();
    $this->branchModel = new BranchModel();
    $this->holidayModel = new HolidayModel();
    $this->destinationModel = new DestinationModel();
    $this->resortModel = new ResortModel();
    $this->offerModel = new OfferModel();
    $this->generateconformvoucherModel = new GenerateconformvoucherModel();
    $this->generateholidayvoucherModel = new GenerateholidayvoucherModel();
    $this->generategiftvoucherModel = new generategiftvoucherModel();
    $this->generateinvoiceModel = new GenerateinvoiceModel();

}

public function dashboard()
{
    $isAdmin    = session()->get('role') === 'admin';
    $isEmployee = session()->get('isEmployeeLoggedIn') === true;
    $userDept   = session()->get('department_id');

    if (!$isAdmin && (!$isEmployee || $userDept != 2)) {
        return redirect()->to('/official')->with('error', 'Unauthorized access');
    }
    
    $data['subsidiaries'] = $this->subsidiaryModel->getAllSubsidiaries();
    return view('backend/member_admin/Add_Member', $data);
}

public function getBranchesBySubsidiary($subsidiary_id)
{
    $branches = $this->branchModel->where('subsidiary_id', $subsidiary_id)->findAll();
    return $this->response->setJSON($branches);
}

public function getBranchesBySub($subsidiary_id)
    {
    $branches = $this->branchModel->where('subsidiary_id', $subsidiary_id)->findAll();
    return $this->response->setJSON($branches);
}

public function getmembersByBra($branch_id)
{
    $search = $this->request->getGet('search'); 
    
    $builder = $this->userModel->where('branch_id', $branch_id);

    if (!empty($search)) {
        $builder = $builder->like('ms_num', $search);
    }

 $members = $builder
                ->orderBy('id', 'DESC') 
                ->findAll(50);
                
    return $this->response->setJSON($members);
}

public function store()
{
    $validation = \Config\Services::validation();

    // Validation rules with custom messages
    $validationRules = [
        'ms_num' => [
            'rules' => 'required|is_unique[users.ms_num]',
            'errors' => [
                'is_unique' => 'Membership ID is already registered'
            ]
        ],
        'email' => [
            'rules' => 'required|valid_email|is_unique[users.email]',
            'errors' => [
                'is_unique' => 'Email already exists.'
            ]
        ],
        'mobile' => [
            'rules' => 'required|numeric|is_unique[users.mobile]',
            'errors' => [
                'is_unique' => 'Mobile number already exists.'
            ]
        ],
        'address' => 'required|string',

    ];

    if (!$validation->setRules($validationRules)->withRequest($this->request)->run()) {
        return redirect()->back()->withInput()->with('errors', $validation->getErrors());
    }

    // Prepare data for saving
    $data = [
        'created_on' => date('Y-m-d H:i:s'),
        'updated_on' => date('Y-m-d H:i:s'),
        'branch_id' => $this->request->getPost('branch_id'),
        'join_date' => $this->request->getPost('join_date'),
        'ms_num' => $this->request->getPost('ms_num'),
        'password' => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
        'en_password' => $this->request->getPost('en_password'),
        'name' => $this->request->getPost('name'),
        'email' => $this->request->getPost('email'),
        'dob' => $this->request->getPost('dob'),
        'venue' => $this->request->getPost('venue'),
        'marriage_anniversary' => $this->request->getPost('marriage_anniversary'),
        'spouse' => $this->request->getPost('spouse'),
        'f_child_name' => $this->request->getPost('f_child_name'),
        'f_child_age' => $this->request->getPost('f_child_age'),
        's_child_name' => $this->request->getPost('s_child_name'),
        's_child_age' => $this->request->getPost('s_child_age'),
        'last_holiday' => $this->request->getPost('last_holiday'),
        'ms_category' => $this->request->getPost('ms_category'),
        'ms_year' => $this->request->getPost('ms_year'),
        'day_night' => $this->request->getPost('day_night'),
        'mobile' => $this->request->getPost('mobile'),
        'alt_mobile' => $this->request->getPost('alt_mobile'),
        'address' => $this->request->getPost('address'),
        'ms_amount' => $this->request->getPost('ms_amount'),
        'ms_advance' => $this->request->getPost('ms_advance'),
        'ms_due' => $this->request->getPost('ms_due'),
        'ms_amc' => $this->request->getPost('ms_amc'),
        'mngr_id' => $this->request->getPost('mngr_id'),
        'salep_id' => $this->request->getPost('salep_id'),
        'status' => $this->request->getPost('status'),
        'exchange_num' => $this->request->getPost('exchange_num'),
        'subsidiary_id' => $this->request->getPost('subsidiary_id'),
    ];

    // Save employee data
    if ($this->userModel->insert($data)) {
        return redirect()->back()->with('success', 'Member registered successfully.');
    } else {
        return redirect()->back()->withInput()->with('errors', ['database' => 'An error occurred while saving.']);
    }
}
        public function edit($id)
        {
            $isAdmin     = session()->get('role') === 'admin';
            $isEmployee  = session()->get('isEmployeeLoggedIn') === true;
            $userDept    = session()->get('department_id');
        
            $allowedDepts = [2, 6];
        
            if (!$isAdmin && (!$isEmployee || !in_array($userDept, $allowedDepts))) {
                return redirect()->to('/official')->with('error', 'Unauthorized access');
            }
        
                
             $data['subsidiaries'] = $this->subsidiaryModel->getAllSubsidiaries();
            $data['record'] = $this->userModel->find($id); // use userModel
            return view('backend/member_admin/edit_member_record', $data);
            
        }
        
        public function update($id)
        {
            $data = [
        'updated_on' => date('Y-m-d H:i:s'),
        'branch_id' => $this->request->getPost('branch_id'),
        'join_date' => $this->request->getPost('join_date'),
        'ms_num' => $this->request->getPost('ms_num'),
        'password' => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
        'en_password' => $this->request->getPost('en_password'),
        'name' => $this->request->getPost('name'),
        'email' => $this->request->getPost('email'),
        'dob' => $this->request->getPost('dob'),
        'venue' => $this->request->getPost('venue'),
        'marriage_anniversary' => $this->request->getPost('marriage_anniversary'),
        'spouse' => $this->request->getPost('spouse'),
        'f_child_name' => $this->request->getPost('f_child_name'),
        'f_child_age' => $this->request->getPost('f_child_age'),
        's_child_name' => $this->request->getPost('s_child_name'),
        's_child_age' => $this->request->getPost('s_child_age'),
        'last_holiday' => $this->request->getPost('last_holiday'),
        'ms_category' => $this->request->getPost('ms_category'),
        'ms_year' => $this->request->getPost('ms_year'),
        'day_night' => $this->request->getPost('day_night'),
        'mobile' => $this->request->getPost('mobile'),
        'alt_mobile' => $this->request->getPost('alt_mobile'),
        'address' => $this->request->getPost('address'),
        'ms_amount' => $this->request->getPost('ms_amount'),
        'ms_advance' => $this->request->getPost('ms_advance'),
        'ms_due' => $this->request->getPost('ms_due'),
        'ms_amc' => $this->request->getPost('ms_amc'),
        'mngr_id' => $this->request->getPost('mngr_id'),
        'salep_id' => $this->request->getPost('salep_id'),
        'status' => $this->request->getPost('status'),
        'exchange_num' => $this->request->getPost('exchange_num'),
        'subsidiary_id' => $this->request->getPost('subsidiary_id'),
            ];
        
            $this->userModel->update($id, $data); // use userModel
        
            return redirect()->back()->with('success', 'Record updated successfully.');
        }
    
        // Delete a record
        public function delete($id)
        {
            $this->userModel->delete($id);
            return redirect()->to('/yourcontroller');
        }

    public function searchmember()
    {
        
        $isAdmin     = session()->get('role') === 'admin';
        $isEmployee  = session()->get('isEmployeeLoggedIn') === true;
        $userDept    = session()->get('department_id');
    
        $allowedDepts = [2, 6, 7];
    
        if (!$isAdmin && (!$isEmployee || !in_array($userDept, $allowedDepts))) {
            return redirect()->to('/official')->with('error', 'Unauthorized access');
        }
    
        $data['users'] = $this->userModel->findAll();
               
        return view('backend/member_admin/search-member', $data);
        
    }

    public function searchmembervalue()
    {
        $post_data = $this->request->getJSON();
    
        if (!$post_data || !isset($post_data->search_key) || !isset($post_data->search_value)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Invalid request.'
            ]);
        }
    
        $search_key = esc($post_data->search_key);
        $search_value = esc($post_data->search_value);
    
        $allowed_keys = ['name', 'email', 'mobile', 'ms_num'];
        if (!in_array($search_key, $allowed_keys)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Invalid search key.'
            ]);
        }
    
        $users = $this->userModel->like($search_key, $search_value)->findAll();
    
        if (empty($users)) {
            return $this->response->setJSON([
                'success' => true,
                'users' => [],
                'message' => 'No matching members found.'
            ]);
        }
    
        return $this->response->setJSON([
            'success' => true,
            'users' => $users
        ]);
    }
    
    public function searchinvoice()
    {
        
   $isAdmin    = session()->get('role') === 'admin';
    $isEmployee = session()->get('isEmployeeLoggedIn') === true;
    $userDept   = session()->get('department_id');

    if (!$isAdmin && (!$isEmployee || $userDept != 2)) {
        return redirect()->to('/official')->with('error', 'Unauthorized access');
    }
        
        return view('backend/member_admin/search-invoice');
    }
    
    public function searchInvoicevalue()
    {
        $request = service('request');
        $searchKey = $request->getPost('search_key');
        $searchValue = $request->getPost('search_value');

        if (empty($searchKey) || empty($searchValue)) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Please fill all required fields.']);
        }

        $result = [];
        if ($searchKey == 'receipt_num') {
            $result = $this->generateinvoiceModel->where('receipt_num', $searchValue)->findAll();
        } elseif ($searchKey == 'mem_ms_num') {
            $result = $this->generateinvoiceModel->where('mem_ms_num', $searchValue)->findAll();
        }

        if (!empty($result)) {
            return $this->response->setJSON(['status' => 'success', 'data' => $result]);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'No records found.']);
        }
    }

    public function searchInvoiceByDate()
    {
        $request = service('request');
        $searchDate = $request->getPost('search_value_date');

        if (empty($searchDate)) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Please select a date.']);
        }

        $result = $this->generateinvoiceModel->where('DATE(gen_date)', $searchDate)->findAll();

        if (!empty($result)) {
            return $this->response->setJSON(['status' => 'success', 'data' => $result]);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'No records found.']);
        }
    }
        
        
     public function generateinvoice($ms_num)
    {
       $isAdmin    = session()->get('role') === 'admin';
        $isEmployee = session()->get('isEmployeeLoggedIn') === true;
        $userDept   = session()->get('department_id');
    
        if (!$isAdmin && (!$isEmployee || $userDept != 2)) {
            return redirect()->to('/official')->with('error', 'Unauthorized access');
        }
        
        $db = \Config\Database::connect();
        $builder = $db->table('users');
        $builder->select('users.*, tbl_subsidiary.name AS subsidiary_name, tbl_branch.name AS branch_name');
        $builder->join('tbl_subsidiary', 'users.subsidiary_id = tbl_subsidiary.id', 'left');
        $builder->join('tbl_branch', 'users.branch_id = tbl_branch.id', 'left');
        $builder->where('users.ms_num', $ms_num);
    
        $users = $builder->get()->getResultArray();
    
        if (empty($users)) {
            return redirect()->back()->with('error', 'User not found');
        }
    
        $data = [
            'users' => $users,
            'ms_num' => $ms_num,
        ];
    
        return view('backend/member_admin/generate-invoice', $data);
    }

public function viewinvoice($invoice_id)
{

    $isAdmin    = session()->get('role') === 'admin';
    $isEmployee = session()->get('isEmployeeLoggedIn') === true;
    $userDept   = session()->get('department_id');

    if (!$isAdmin && (!$isEmployee || $userDept != 2)) {
        return redirect()->to('/official')->with('error', 'Unauthorized access');
    }

    $invoice = $this->generateinvoiceModel->find($invoice_id);
    
    if (!$invoice) {
        return redirect()->back()->with('error', 'Invoice not found');
    }

    $logoPath = FCPATH . 'asset/logo.png';
    
    $logo = '';
    if (file_exists($logoPath)) {
        $logoBase64 = base64_encode(file_get_contents($logoPath));
        $logo = 'data:image/png;base64,' . $logoBase64;
    }

    
    $data = [
        'invoices' => [$invoice], 
        'logo' => $logo
    ];

    $html = view('backend/member_admin/invoice-view', $data);

    $dompdf = new \Dompdf\Dompdf();
    $options = $dompdf->getOptions();
    $options->set('isHtml5ParserEnabled', true);
    $options->set('isRemoteEnabled', true); 
    $dompdf->setOptions($options);

    $dompdf->loadHtml($html);

    $dompdf->setPaper('A4', 'portrait');

    $dompdf->render();

    $dompdf->stream("invoice_{$invoice_id}.pdf", ["Attachment" => false]); 
    exit;
}

public function SendInvoiceEmailPdf($invoiceId = null)
{
    if (!$invoiceId) {
        return $this->response->setJSON([
            "status" => "error",
            "message" => "Invalid invoice ID."
        ]);
    }

    $data = $this->generateinvoiceModel->find($invoiceId);

    if (!$data) {
        return $this->response->setJSON([
            "status" => "error",
            "message" => "No data found for this invoice ID."
        ]);
    }

    $logoPath = FCPATH . 'asset/logo.png';

    $logo = '';
    if (file_exists($logoPath)) {
        $logoBase64 = base64_encode(file_get_contents($logoPath));
        $logo = 'data:image/png;base64,' . $logoBase64;
    }

    $htmlContent = view('backend/member_admin/invoice-view', [
        'invoices' => [$data],
        'logo' => $logo
    ]);

    // ✅ Dompdf Setup
    $options = new Options();
    $options->set('isHtml5ParserEnabled', true);
    $options->set('isPhpEnabled', true);

    $dompdf = new Dompdf($options);
    $dompdf->loadHtml($htmlContent);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();

    // ✅ Get PDF Output
    $pdfContent = $dompdf->output();

    // ✅ Email Setup
    $email = \Config\Services::email();

    $email->setFrom('info@delviaholidaysinternational.com', 'Delvia Holidays International');
    $email->setTo($data['mem_email']);

    $email->setSubject('Delvia Holidays | Invoice No: ' . $invoiceId . ' | Your Invoice PDF');

    $message = '
        <p>Dear <strong>' . esc($data['mem_name']) . '</strong>,</p>

        <p>Thank you for choosing <strong>Delvia Holidays International</strong>.<br>
        Please find your invoice attached as a PDF.</p>

        <p>If you have any questions, feel free to contact us.</p>

        <br>

        <p>Warm Regards,<br>
        <strong>Delvia Holidays Team</strong></p>
    ';

    $email->setMessage($message);
    $email->setMailType('html');

    $email->attach(
        $pdfContent,
        'attachment',
        "Invoice_{$invoiceId}.pdf",
        'application/pdf'
    );

    // ✅ Send Email
    if ($email->send()) {
        return $this->response->setJSON([
            "status" => "success",
            "message" => "Invoice email sent successfully with PDF."
        ]);
    } else {

        $debugData = $email->printDebugger(['headers', 'subject', 'message', 'to']);

        log_message('error', 'Invoice Email Failed: ' . print_r($debugData, true));

        return $this->response->setJSON([
            "status" => "error",
            "message" => "Failed to send invoice email.",
            "debug" => $debugData
        ]);
    }
}

public function saveDataFrom()
{
    $request = service('request');

    // Validate input data
    $validation = \Config\Services::validation();
    $validation->setRules([
        'mngr_id' => 'required',
        'salep_id' => 'required',
        'gen_date' => 'required|valid_date',
        'bank' => 'required',
        'amount' => 'required|numeric',
        
    ]);

    if (!$validation->withRequest($request)->run()) {
        // Return validation errors
        return redirect()->back()->withInput()->with('errors', $validation->getErrors());
    }

    $receipt_num = $this->generateReceiptNumber();

    $data = [
        'receipt_num' => $receipt_num, // Automatically generated
        'subsidiary_id' => $request->getPost('subsidiary_id'),
        'branch_id' => $request->getPost('branch_id'),
        'mem_ms_num' => $request->getPost('mem_ms_num'),
        'mem_name' => $request->getPost('mem_name'),
        'mem_email' => $request->getPost('mem_email'),
        'mobile' => $request->getPost('mobile'),
        'mem_address' => $request->getPost('address'),
        'gen_date' => $request->getPost('gen_date'),
        'mngr_id' => $request->getPost('mngr_id'),
        'salep_id' => $request->getPost('salep_id'),    
        'bank' => $request->getPost('bank'),
        'tid' => $request->getPost('tid'),
        'mode' => $request->getPost('mode'),
        'card_num' => $request->getPost('card_num'),
        'payment_type' => $request->getPost('payment_type'),
        'amount' => $request->getPost('amount'),
        'status' => '1',
    ];

    // Save to the database (use appropriate model)
    if ($this->generateinvoiceModel->insert($data)) {
        return redirect()->back()->with('success', 'Invoice generated successfully.');
    } else {
        return redirect()->back()->withInput()->with('error', 'Failed to save invoice.');
    }
}

private function generateReceiptNumber()
{
    $prefix = 'REC-';
    
    $lastReceipt = $this->generateinvoiceModel
        ->orderBy('id', 'DESC')
        ->select('receipt_num')
        ->first();

    if ($lastReceipt && isset($lastReceipt['receipt_num'])) {
        $lastNumber = intval(str_replace($prefix, '', $lastReceipt['receipt_num']));
    } else {
        $lastNumber = 0;
    }

    $newNumber = $lastNumber + 1;

    return $prefix . str_pad($newNumber, 6, '0', STR_PAD_LEFT); // e.g., REC-000001
}
    
        public function editDatainvoice($id)
        {
            $isAdmin    = session()->get('role') === 'admin';
            $isEmployee = session()->get('isEmployeeLoggedIn') === true;
            $userDept   = session()->get('department_id');
        
            if (!$isAdmin && (!$isEmployee || $userDept != 2)) {
                return redirect()->to('/official')->with('error', 'Unauthorized access');
            }
            
            $invoiceData = $this->generateinvoiceModel->find($id);
            if (!$invoiceData) {
                return redirect()->back()->with('error', 'Invoice not found.');
            }
        
            $db = \Config\Database::connect();
            $builder = $db->table('users');
            $builder->select('users.*, tbl_subsidiary.name AS subsidiary_name, tbl_branch.name AS branch_name');
            $builder->join('tbl_subsidiary', 'users.subsidiary_id = tbl_subsidiary.id', 'left');
            $builder->join('tbl_branch', 'users.branch_id = tbl_branch.id', 'left');
            $builder->where('users.ms_num', $invoiceData['mem_ms_num']); 
            $query = $builder->get();
            $user = $query->getRowArray();
        
            if (empty($user)) {
                return redirect()->back()->with('error', 'User not found.');
            }
        
            $data = [
                'users' => [$user], 
                'invoice' => $invoiceData,
            ];
        
            return view('backend/member_admin/edit-generate-invoice', $data);
        }

        public function updateDatainvoice($id)
        {
            $request = service('request');
        
            $validation = \Config\Services::validation();
            $validation->setRules([
                'gen_date' => 'required|valid_date',
                'bank' => 'required',
                'amount' => 'required|numeric',
            ]);
        
            if (!$validation->withRequest($request)->run()) {
                return redirect()->back()->withInput()->with('errors', $validation->getErrors());
            }
        
            $data = [
                'subsidiary_id' => $request->getPost('subsidiary_id'),
                'branch_id' => $request->getPost('branch_id'),
                'mem_ms_num' => $request->getPost('mem_ms_num'),
                'mem_name' => $request->getPost('mem_name'),
                'mem_email' => $request->getPost('mem_email'),
                'mobile' => $request->getPost('mobile'),
                'mem_address' => $request->getPost('address'),
                'gen_date' => $request->getPost('gen_date'),
                'mngr_id' => $request->getPost('mngr_id'),
                'salep_id' => $request->getPost('salep_id'),
                'bank' => $request->getPost('bank'),
                'tid' => $request->getPost('tid'),
                'mode' => $request->getPost('mode'),
                'card_num' => $request->getPost('card_num'),
                'payment_type' => $request->getPost('payment_type'),
                'amount' => $request->getPost('amount'),
                'updated_on' => date('Y-m-d H:i:s'), 
            ];
        
            if ($this->generateinvoiceModel->update($id, $data)) {
                return redirect()->back()->with('success', 'Invoice updated successfully.');
            } else {
                return redirect()->back()->withInput()->with('error', 'Failed to update invoice.');
            }
        }
        
    public function generategiftvoucher()
    {
     
    $isAdmin    = session()->get('role') === 'admin';
    $isEmployee = session()->get('isEmployeeLoggedIn') === true;
    $userDept   = session()->get('department_id');

    if (!$isAdmin && (!$isEmployee || $userDept != 2)) {
        return redirect()->to('/official')->with('error', 'Unauthorized access');
    }
               
       $data['subsidiaries'] = $this->subsidiaryModel->getAllSubsidiaries();

        return view('backend/member_admin/generate-voucher', $data);
    }
    
    
 public function getMemberDetails($ms_num)
     {
         $memberDetails = $this->userModel->where('ms_num', $ms_num)->first();
    
         if ($memberDetails) {
             return $this->response->setJSON([
                 'name' => $memberDetails['name'],
                 'mobile' => $memberDetails['mobile'],
                 'email' => $memberDetails['email']
             ]);
         } else {
             log_message('error', 'Member not found: ' . $ms_num);
             return $this->response->setJSON(['error' => 'Member not found']);
         }
     } 
         

    public function Giftvoucherstore()
    {
        $status = '1';
    
        // AUTO GENERATE v_num
        $v_num = $this->generateVoucherNumber();
    
        $data = [
            'issue_date'     => $this->request->getPost('issue_date'),
            'category'       => $this->request->getPost('category'),
            'subsidiary_id'  => $this->request->getPost('subsidiary_id'),
            'branch_id'      => $this->request->getPost('branch_id'),
            'member_num'     => $this->request->getPost('member_num'),
            'name'           => $this->request->getPost('name'),
            'email'          => $this->request->getPost('email'),
            'phone'          => $this->request->getPost('phone'),
            'v_num'          => $v_num, // AUTO GENERATED
            'movie'          => $this->request->getPost('movie'),
            'holiday'        => $this->request->getPost('holiday'),
            'status'         => $status,
        ];
    
        if ($this->generategiftvoucherModel->insert($data)) {
            return redirect()->back()->with('success', 'Voucher Generated successfully.');
        } else {
            return redirect()->back()->withInput()->with('errors', ['database' => 'An error occurred while saving.']);
        }
    }

    private function generateVoucherNumber()
    {
        // Get last inserted voucher
        $last = $this->generategiftvoucherModel->orderBy('id', 'DESC')->first();
    
        if ($last) {
            // Extract number part
            $lastNumber = intval(substr($last['v_num'], 4)); // removes "VCH-"
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        return 'VCH-' . str_pad($newNumber, 5, '0', STR_PAD_LEFT);
    }

    
public function allmember()
{
    $role = session()->get('role');
    if ($role !== 'admin') {
        return redirect()->to('/official')->with('error', 'Unauthorized access');
    }

    $search = $this->request->getVar('search') ?? '';
    $limit = (int) ($this->request->getVar('limit') ?? 100); // default to 100
    $page  = (int) ($this->request->getVar('page') ?? 1);
    $offset = ($page - 1) * $limit;

    $builder = $this->userModel
        ->orderBy('status', 'DESC')
        ->orderBy('join_date', 'DESC'); 

    if (!empty($search)) {
        $builder->groupStart()
            ->like('name', $search)
            ->orLike('ms_num', $search)
            ->orLike('mobile', $search)
            ->groupEnd();
    }

    $totalRecords = $builder->countAllResults(false);

    // Get paginated result
    $users = $builder->limit($limit, $offset)->get()->getResultArray();

    $branches = $this->branchModel->findAll();

    $data = [
        'users'         => $users,
        'limit'         => $limit,
        'totalRecords'  => $totalRecords,
        'currentPage'   => $page,
        'totalPages'    => ceil($totalRecords / $limit), // âœ… Fix added here
        'search'        => $search,
        'branchMap'     => array_column($branches, 'name', 'id'),
    ];

    // AJAX return (optional)
    if ($this->request->isAJAX()) {
        return $this->response->setJSON([
            'html'         => view('backend/member_admin/all-member-view-table', $data),
            'totalRecords' => $totalRecords,
            'currentPage'  => $page,
            'limit'        => $limit,
            'startRecord'  => $offset + 1,
            'endRecord'    => min($offset + $limit, $totalRecords),
            'totalPages'   => ceil($totalRecords / $limit),
        ]);
    }

    return view('backend/member_admin/all-member', $data);
}


  public function updateStatus()
{
    $data = json_decode($this->request->getBody(), true);

    $id = $data['mem_id'] ?? null;
    $status = $data['mem_status'] ?? null;

    if ($id === null || $status === null) {
        return $this->response->setJSON([
            'success' => false,
            'message' => 'Invalid input'
        ]);
    }

    $updated = $this->userModel->update($id, ['status' => $status]);

    if ($updated) {
        return $this->response->setJSON([
            'success' => true,
            'message' => 'Status updated successfully'
        ]);
    } else {
        return $this->response->setJSON([
            'success' => false,
            'message' => 'Failed to update status'
        ]);
    }
}

    //-------------------------offer-->
    public function memberoffers($ms_num)
    {
        
        $isAdmin     = session()->get('role') === 'admin';
        $isEmployee  = session()->get('isEmployeeLoggedIn') === true;
        $userDept    = session()->get('department_id');
    
        $allowedDepts = [2, 6, 7];
    
        if (!$isAdmin && (!$isEmployee || !in_array($userDept, $allowedDepts))) {
            return redirect()->to('/official')->with('error', 'Unauthorized access');
        }
    
    
        $user = $this->userModel->where('ms_num', $ms_num)->first();
        $offers = $this->offerModel->where('mem_ms_num', $ms_num)->findAll();
    
        if (!$user) {
            return redirect()->back()->with('error', 'User not found');
        }
    
        $currentDate = date('Y-m-d');
    
      foreach ($offers as &$offer) {

        if ($offer['status'] === 'Booked') {
            $offer['status_display'] = 'Booked';
            $offer['can_book'] = false;
            $offer['show_buttons'] = true;
    
        } elseif ($offer['status'] === 'Generated') {
            $offer['status_display'] = 'Generated';
            $offer['can_book'] = false;
            $offer['show_buttons'] = true;
    
        } elseif ($offer['v_to'] < $currentDate) {
            $offer['status_display'] = 'Expired';
            $offer['can_book'] = false;
            $offer['show_buttons'] = true;   // ✅ very important
    
        } else {
            $offer['status_display'] = 'Available';
            $offer['can_book'] = true;
            $offer['show_buttons'] = true;
        }
    }

        $data = [
            'user' => $user,
            'offers' => $offers,
            'ms_num' => $ms_num
        ];
    
        return view('backend/member_admin/member-offers', $data);
    }
    
 public function deleteMemberOffer($offer_id, $ms_num)
{
    $isAdmin     = session()->get('role') === 'admin';
    $isEmployee  = session()->get('isEmployeeLoggedIn') === true;
    $userDept    = session()->get('department_id');

    $allowedDepts = [6];

    if (!$isAdmin && (!$isEmployee || !in_array($userDept, $allowedDepts))) {
        return redirect()->to('/official')->with('error', 'Unauthorized access');
    }

    $offer = $this->offerModel->find($offer_id);

    if (!$offer) {
        return redirect()->back()->with('error', 'Offer not found');
    }

    $this->offerModel->delete($offer_id);

    return redirect()->back()
        ->with('success', 'Offer deleted successfully');
}


    public function bookOffer()
    {
        $isAdmin    = session()->get('role') === 'admin';
        $isEmployee = session()->get('isEmployeeLoggedIn') === true;
        $userDept   = session()->get('department_id');
    
        if (!$isAdmin && (!$isEmployee || $userDept != 7)) {
            return redirect()->to('/official')->with('error', 'Unauthorized access');
        }
        
        $offerModel = new OfferModel();
    
        $offerId = $this->request->getPost('offer_id');
        $bookDate = $this->request->getPost('book_date');
        $detail = $this->request->getPost('detail');
    
        if (empty($offerId) || empty($bookDate) || empty($detail)) {
            return $this->response->setJSON(['error' => 'All fields are required.'])->setStatusCode(400);
        }
    
        // Find the offer by ID
        $offer = $offerModel->find($offerId);
    
        if (!$offer) {
            return $this->response->setJSON(['error' => 'Offer not found.'])->setStatusCode(404);
        }
    
        if ($offer['status'] === 'Booked') {
            return $this->response->setJSON(['error' => 'This offer is already booked.'])->setStatusCode(400);
        } elseif ($offer['v_to'] < date('Y-m-d')) {
            return $this->response->setJSON(['error' => 'This offer has expired.'])->setStatusCode(400);
        }
    
        $offerData = [
            'book_date' => $bookDate,
            'detail' => $detail,
            'status' => 'Booked', // Set the status to 'Booked'
        ];
    
        $updateSuccess = $offerModel->update($offerId, $offerData);
    
        // Check if the update was successful
        if (!$updateSuccess) {
            return $this->response->setJSON(['error' => 'Failed to update offer status.'])->setStatusCode(500);
        }
    
        // Return a success response
        return $this->response->setJSON(['success' => 'Offer booked successfully!']);
    } 

    public function generateconformvoucher($offer_id)
    {
        
          $isAdmin    = session()->get('role') === 'admin';
        $isEmployee = session()->get('isEmployeeLoggedIn') === true;
        $userDept   = session()->get('department_id');
    
        if (!$isAdmin && (!$isEmployee || $userDept != 7)) {
            return redirect()->to('/official')->with('error', 'Unauthorized access');
        }
    
        $offer = $this->offerModel->where('id', $offer_id)->findAll();
        if (!$offer || !is_array($offer)) {
            return redirect()->back()->with('error', 'Offer not found or invalid data');
        }
    
        $user = $this->userModel->where('ms_num', $offer[0]['mem_ms_num'] ?? null)->first();
        if (!$user || !is_array($user)) {
            return redirect()->back()->with('error', 'User not found or invalid data');
        }

        $data = [
            'user' => $user,
            'offer' => $offer,
        ];
    
        return view('backend/member_admin/generate-confirmation-voucher', $data);
    }

    public function viewVoucher($offer_id)
    {
        
        $isAdmin     = session()->get('role') === 'admin';
        $isEmployee  = session()->get('isEmployeeLoggedIn') === true;
        $userDept    = session()->get('department_id');
    
        $allowedDepts = [6, 7];
    
        if (!$isAdmin && (!$isEmployee || !in_array($userDept, $allowedDepts))) {
            return redirect()->to('/official')->with('error', 'Unauthorized access');
        }
        
        $offer = $this->offerModel->where('id', $offer_id)->findAll();
        if (!$offer || !is_array($offer)) {
            return redirect()->back()->with('error', 'Offer not found or invalid data');
        }
    
        $user = $this->userModel->where('ms_num', $offer[0]['mem_ms_num'] ?? null)->first();
        if (!$user || !is_array($user)) {
            return redirect()->back()->with('error', 'User not found or invalid data');
        }
    
        $vouchers = $this->generateconformvoucherModel->where('tbl_id', $offer_id)->findAll();
    
        $data = [
            'user' => $user,
            'offer' => $offer,
            'vouchers' => $vouchers,
        ];
    
        $dompdf = new \Dompdf\Dompdf();
        $options = $dompdf->getOptions();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);
        $dompdf->setOptions($options);
    
        // Generate HTML using the same view template
        $html = view('backend/member_admin/voucher-view', $data);
        $dompdf->loadHtml($html);
    
        // Set up paper size and orientation
        $dompdf->setPaper('A4', 'portrait');
    
    // Render the HTML as PDF
        $dompdf->render();
    
           // Send headers for PDF output
    header("Content-Type: application/pdf");
    header("Content-Disposition: inline; filename=voucher_offer_{$offer_id}.pdf");
    header("Cache-Control: public, must-revalidate, max-age=0");
    header("Pragma: public");

    // Output the generated PDF to the browser
    echo $dompdf->output();
    exit;
    }
    
    public function downloadVoucher($offer_id)
{
        $isAdmin     = session()->get('role') === 'admin';
        $isEmployee  = session()->get('isEmployeeLoggedIn') === true;
        $userDept    = session()->get('department_id');
    
        $allowedDepts = [6, 7];
    
        if (!$isAdmin && (!$isEmployee || !in_array($userDept, $allowedDepts))) {
            return redirect()->to('/official')->with('error', 'Unauthorized access');
        }
        
        
    $offer = $this->offerModel->where('id', $offer_id)->findAll();
    if (!$offer || !is_array($offer)) {
        return redirect()->back()->with('error', 'Offer not found or invalid data');
    }

    $user = $this->userModel->where('ms_num', $offer[0]['mem_ms_num'] ?? null)->first();
    if (!$user || !is_array($user)) {
        return redirect()->back()->with('error', 'User not found or invalid data');
    }

    $vouchers = $this->generateconformvoucherModel->where('tbl_id', $offer_id)->findAll();

    $data = [
        'user' => $user,
        'offer' => $offer,
        'vouchers' => $vouchers
    ];

    $dompdf = new \Dompdf\Dompdf();
    $options = $dompdf->getOptions();
    $options->set('isHtml5ParserEnabled', true);
    $options->set('isRemoteEnabled', true); 
    $dompdf->setOptions($options);

    $html = view('backend/member_admin/voucher-view', $data);
    $dompdf->loadHtml($html);

    $dompdf->setPaper('A4', 'portrait');

    $dompdf->render();

    $dompdf->stream("voucher_offer_{$offer[0]['mem_ms_num']}.pdf", ["Attachment" => true]);
}
         public function storevoucher()
         {
             $data = [
                 'created_at'       => date('Y-m-d H:i:s'),  
                 'book_id'          => $this->request->getPost('book_id'),
                 'confirm_by'       => $this->request->getPost('confirm_by'),
                 'tbl_id'           => $this->request->getPost('tbl_id'), 
                 'ms_num'           => $this->request->getPost('ms_num'),
                 'name'             => $this->request->getPost('name'),
                 'email'            => $this->request->getPost('email'),
                 'mobile'           => $this->request->getPost('mobile'),
                 'destination'      => $this->request->getPost('destination'),
                 'property_name'    => $this->request->getPost('property_name'),
                 'location'         => $this->request->getPost('location'),
                 'contact_num'      => $this->request->getPost('contact_num'),
                 'no_of_room'       => $this->request->getPost('no_of_room'),
                 'room_type'        => $this->request->getPost('room_type'),
                 'includes'         => $this->request->getPost('includes'),
                 'adults'           => $this->request->getPost('adults'),
                 'kids'             => $this->request->getPost('kids'),
                 'check_in'         => $this->request->getPost('check_in'),
                 'check_out'        => $this->request->getPost('check_out'),
                 'check_in_time'    => $this->request->getPost('check_in_time'),
                 'check_out_time'   => $this->request->getPost('check_out_time'),
                 'book_amount'      => $this->request->getPost('book_amount'),
                 'book_through'     => $this->request->getPost('book_through'),
                 'book_from'        => $this->request->getPost('book_from'),
                 'received_amount'  => $this->request->getPost('received_amount'),
                 'deduction_amount' => $this->request->getPost('deduction_amount'),
             ];
         
             if ($this->generateconformvoucherModel->insert($data)) {
                 $offerId = $this->request->getPost('tbl_id');
         
                 $offerData = [
                     'status' => 'Generated', 
                 ];
         
                 $this->offerModel->update($offerId, $offerData);
         
                 return redirect()->to('member-offers/' . $data['ms_num'])->with('message', 'Submitted Successfully!');
             } else {
                 return redirect()->back()->withInput()->with('errors', ['database' => 'An error occurred while saving.']);
             }
         }

         public function editgenerateconformvoucher($offer_id)
         {
             
       $isAdmin    = session()->get('role') === 'admin';
        $isEmployee = session()->get('isEmployeeLoggedIn') === true;
        $userDept   = session()->get('department_id');
    
        if (!$isAdmin && (!$isEmployee || $userDept != 7)) {
            return redirect()->to('/official')->with('error', 'Unauthorized access');
        }
         
             $offer = $this->offerModel->where('id', $offer_id)->findAll();
             if (!$offer || !is_array($offer)) {
                 return redirect()->back()->with('error', 'Offer not found or invalid data');
             }
         
             $user = $this->userModel->where('ms_num', $offer[0]['mem_ms_num'] ?? null)->first();
             if (!$user || !is_array($user)) {
                 return redirect()->back()->with('error', 'User not found or invalid data');
             }

             $vouchers = $this->generateconformvoucherModel->where('tbl_id', $offer_id)->findAll();

             $data = [
                 'user' => $user,
                 'offer' => $offer,
                 'vouchers' => $vouchers
             ];
         
             return view('backend/member_admin/edit-generate-confirmation-voucher', $data);
         }
         
         public function updateVoucher($offer_id)
         {
             
       $isAdmin    = session()->get('role') === 'admin';
        $isEmployee = session()->get('isEmployeeLoggedIn') === true;
        $userDept   = session()->get('department_id');
    
        if (!$isAdmin && (!$isEmployee || $userDept != 7)) {
            return redirect()->to('/official')->with('error', 'Unauthorized access');
        }
         
             // Check if the voucher exists in the database
             $voucher = $this->generateconformvoucherModel->where('tbl_id', $offer_id)->first();
             if (!$voucher) {
                 return redirect()->back()->with('error', 'Voucher not found.');
             }
         
             // Prepare data for updating, including setting the updated timestamp
             $data = [
                 'updated_at'       => date('Y-m-d H:i:s'),
                 'confirm_by'       => $this->request->getPost('confirm_by'),
                 'book_id'          => $this->request->getPost('book_id'),
                 'ms_num'           => $this->request->getPost('ms_num'),
                 'name'             => $this->request->getPost('name'),
                 'email'            => $this->request->getPost('email'),
                 'mobile'           => $this->request->getPost('mobile'),
                 'destination'      => $this->request->getPost('destination'),
                 'property_name'    => $this->request->getPost('property_name'),
                 'location'         => $this->request->getPost('location'),
                 'contact_num'      => $this->request->getPost('contact_num'),
                 'no_of_room'       => $this->request->getPost('no_of_room'),
                 'room_type'        => $this->request->getPost('room_type'),
                 'includes'         => $this->request->getPost('includes'),
                 'adults'           => $this->request->getPost('adults'),
                 'kids'             => $this->request->getPost('kids'),
                 'check_in'         => $this->request->getPost('check_in'),
                 'check_out'        => $this->request->getPost('check_out'),
                 'check_in_time'    => $this->request->getPost('check_in_time'),
                 'check_out_time'   => $this->request->getPost('check_out_time'),
                 'book_amount'      => $this->request->getPost('book_amount'),
                 'book_through'     => $this->request->getPost('book_through'),
                 'book_from'        => $this->request->getPost('book_from'),
                 'received_amount'  => $this->request->getPost('received_amount'),
                 'deduction_amount' => $this->request->getPost('deduction_amount'),
             ];
         
             // Attempt to update the voucher record
             if ($this->generateconformvoucherModel->where('tbl_id', $offer_id)->set($data)->update()) {
                 return redirect()->back()->with('message', 'Voucher updated successfully!');
             } else {
                 return redirect()->back()->withInput()->with('errors', ['database' => 'An error occurred while updating the voucher.']);
             }
         }      
         
     public function addoffer($ms_num = null)
    {
        $isAdmin     = session()->get('role') === 'admin';
        $isEmployee  = session()->get('isEmployeeLoggedIn') === true;
        $userDept    = session()->get('department_id');
    
        $allowedDepts = [6, 7];
    
        if (!$isAdmin && (!$isEmployee || !in_array($userDept, $allowedDepts))) {
            return redirect()->to('/official')->with('error', 'Unauthorized access');
        }

    
        if ($ms_num === null) {
            return redirect()->back()->with('error', 'Membership number not found in URL!');
        }
    
        $data['ms_num'] = $ms_num;
    
        return view('backend/member_admin/add-offers', $data);
    }

    public function storedataoffer()
    {
        $status = 'Available';

        $validationRules = [
            'mem_ms_num' => 'required|alpha_numeric|min_length[3]',
            'v_from'     => 'required|valid_date',
            'v_to'       => 'required|valid_date',
            'offer'      => 'required|max_length[255]',
        ];
    
        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
    
        $data = [
            'mem_ms_num' => $this->request->getPost('mem_ms_num'),
            'v_from'     => $this->request->getPost('v_from'),
            'v_to'       => $this->request->getPost('v_to'),
            'offer'      => $this->request->getPost('offer'),
            'status'     => $status
        ];
    
        if ($this->offerModel->insert($data)) {
            return redirect()->back()->with('message', 'Submitted Successfully!');
        } else {
            return redirect()->back()->withInput()->with('errors', ['database' => 'An error occurred while saving.']);
        }
    }
    
    public function addHoliday($ms_num = null)
    {
        $isAdmin     = session()->get('role') === 'admin';
        $isEmployee  = session()->get('isEmployeeLoggedIn') === true;
        $userDept    = session()->get('department_id');
    
        $allowedDepts = [6, 7];
    
        if (!$isAdmin && (!$isEmployee || !in_array($userDept, $allowedDepts))) {
            return redirect()->to('/official')->with('error', 'Unauthorized access');
        }

               
    if ($ms_num === null) {
        return redirect()->back()->with('error', 'Membership number not found in URL!');
    }
           $data['ms_num'] = $ms_num;

            return view('backend/member_admin/add-holidays', $data);
        
    }

    public function storeholiday()
    {          
            $packageMapping = [
                1 => ['night' => 1, 'day' => 2],
                2 => ['night' => 2, 'day' => 3],
                3 => ['night' => 3, 'day' => 4],
                4 => ['night' => 4, 'day' => 5],
                5 => ['night' => 5, 'day' => 6],
                6 => ['night' => 6, 'day' => 7],
                7 => ['night' => 7, 'day' => 8],
                8 => ['night' => 8, 'day' => 9],
            ];
    
        $pkg_type = $this->request->getPost('pkg_type');
        $night = isset($packageMapping[$pkg_type]) ? $packageMapping[$pkg_type]['night'] : 0;
        $day = isset($packageMapping[$pkg_type]) ? $packageMapping[$pkg_type]['day'] : 0;
        $status = 'Available';
    
        $data = [
            'mem_ms_num' => $this->request->getPost('mem_ms_num'),
            'night' => $night,
            'day' => $day,
            'v_from' => $this->request->getPost('v_from'),
            'v_to' => $this->request->getPost('v_to'),
            'status' => $status,
        ];
        
        if ($this->holidayModel->insert($data)) {
            return redirect()->back()->with('success', 'Holiday Added successfully.');
        } else {
            return redirect()->back()->withInput()->with('errors', ['database' => 'An error occurred while saving.']);
        }
    }

    public function viewmanageHoliday($ms_num)
    {
        
        $isAdmin     = session()->get('role') === 'admin';
        $isEmployee  = session()->get('isEmployeeLoggedIn') === true;
        $userDept    = session()->get('department_id');
    
        $allowedDepts = [2, 6, 7];
    
        if (!$isAdmin && (!$isEmployee || !in_array($userDept, $allowedDepts))) {
            return redirect()->to('/official')->with('error', 'Unauthorized access');
        }

        $user = $this->userModel->where('ms_num', $ms_num)->first();
        $holidays = $this->holidayModel->where('mem_ms_num', $ms_num)->findAll();
    
        if (!$user) {
            return redirect()->back()->with('error', 'User not found');
        }
    
        $holidays = array_filter($holidays, function ($holiday) {
            return $holiday['night'] > 0;
        });
    
        $currentDate = date('Y-m-d');
    
        foreach ($holidays as &$holiday) {
            if ($holiday['status'] === 'Booked') {
                $holiday['status_display'] = 'Booked';
                $holiday['can_book'] = false; 
                $holiday['show_buttons'] = false; 
            }

            elseif ($holiday['v_to'] < $currentDate) {
                if ($holiday['status'] !== 'Booked') { 
                    $holiday['status_display'] = 'Expired';
                }
                $holiday['can_book'] = false; 
                $holiday['show_buttons'] = false; 
            }

            elseif ($holiday['status'] === 'Generated') {
                $holiday['status_display'] = 'Generated';
                $holiday['can_book'] = false; 
                $holiday['show_buttons'] = true; 
            }

            else {
                $holiday['status_display'] = 'Available';
                $holiday['can_book'] = true; 
                $holiday['show_buttons'] = false; 
            }
        }
    
        usort($holidays, function($a, $b) {
            $dateComparison = strtotime($a['v_from']) - strtotime($b['v_from']);
            
            if ($dateComparison === 0) {
                return ($a['status'] === 'Booked') ? -1 : 1; 
            }
            
            return $dateComparison; 
        });
    
        $destinations = $this->destinationModel->findAll();
    
        $data = [
            'user' => $user,
            'ms_num' => $ms_num,
            'holidays' => $holidays,
            'destinations' => $destinations
        ];
    
        return view('backend/member_admin/view-member-holiday', $data);
    } 
    
    public function getResortsByDestination()
    {
        if ($this->request->isAJAX()) {
            $desti_id = $this->request->getVar('desti_id');
            $resortModel = new ResortModel();
            $resorts = $resortModel->getResortsByDestination($desti_id);

            return $this->response->setJSON($resorts);
        }
    } 
    
  public function bookHoliday()
{
    $isAdmin    = session()->get('role') === 'admin';
    $isEmployee = session()->get('isEmployeeLoggedIn') === true;
    $userDept   = session()->get('department_id');

    if (!$isAdmin && (!$isEmployee || $userDept != 7)) {
        return $this->response->setJSON([
            'error' => 'Unauthorized access'
        ])->setStatusCode(403);
    }

    $packageMapping = [
        1 => 1,
        2 => 2,
        3 => 3,
        4 => 4,
        5 => 5,
        6 => 6,
    ];

    $pkg_type = $this->request->getPost('pkg_type');
    $night    = $packageMapping[$pkg_type] ?? 0;
    $day      = $night + 1;

    $holidayId     = $this->request->getPost('holiday_id');
    $bookDate      = $this->request->getPost('book_date');
    $destinationId = $this->request->getPost('destination');
    $resortId      = $this->request->getPost('hotel');
    $detail        = $this->request->getPost('detail');

    if (!$holidayId || !$bookDate || !$destinationId || !$resortId || !$pkg_type) {
        return $this->response->setJSON([
            'error' => 'All required fields are mandatory.'
        ])->setStatusCode(400);
    }

    $holiday = $this->holidayModel->find($holidayId);

    if (!$holiday) {
        return $this->response->setJSON([
            'error' => 'Holiday not found.'
        ])->setStatusCode(404);
    }

    if ($holiday['status'] === 'Booked') {
        return $this->response->setJSON([
            'error' => 'This holiday is already booked.'
        ])->setStatusCode(400);
    }

    if ($holiday['v_to'] < date('Y-m-d')) {
        return $this->response->setJSON([
            'error' => 'This holiday has expired.'
        ])->setStatusCode(400);
    }

    if ($holiday['night'] < $night) {
        return $this->response->setJSON([
            'error' => 'Not enough nights available.'
        ])->setStatusCode(400);
    }

    $remainingNights = $holiday['night'] - $night;
    $remainingDays   = $remainingNights + 1;

    $this->holidayModel->update($holidayId, [
        'night' => $remainingNights,
        'day'   => $remainingDays,
    ]);

    $destinationRow  = $this->destinationModel->find($destinationId);
    $destinationName = $destinationRow['name'] ?? '';

    if ($resortId === 'other') {
        if (empty($detail)) {
            return $this->response->setJSON([
                'error' => 'Please mention resort name in details.'
            ])->setStatusCode(400);
        }
        $resortName = $detail;
    } else {
        $resortRow  = $this->resortModel->find($resortId);
        $resortName = $resortRow['name'] ?? '';
    }

    $newBookingData = [
        'book_date'         => $bookDate,
        'night'             => $night,
        'day'               => $day,
        'location'          => $destinationName,
        'hotel'             => $resortName,
        'other'             => $detail,
        'status'            => 'Booked',
        'mem_ms_num'        => $holiday['mem_ms_num'],
        'v_from'            => $holiday['v_from'],
        'v_to'              => $holiday['v_to'],
        'original_offer_id' => $holidayId,
    ];

    if (!$this->holidayModel->insert($newBookingData)) {
        return $this->response->setJSON([
            'error' => 'Failed to create booking.'
        ])->setStatusCode(500);
    }

    return $this->response->setJSON([
        'success' => true,
        'message' => 'Holiday booked successfully!'
    ]);
}

    
    public function deleteHoliday($holidayid,  $ms_num)
{
    $isAdmin     = session()->get('role') === 'admin';
    $isEmployee  = session()->get('isEmployeeLoggedIn') === true;
    $userDept    = session()->get('department_id');

    $allowedDepts = [6];

    if (!$isAdmin && (!$isEmployee || !in_array($userDept, $allowedDepts))) {
        return redirect()->to('/official')->with('error', 'Unauthorized access');
    }

    $holiday = $this->holidayModel->find($holidayid);

    if (!$holiday) {
        return redirect()->back()->with('error', 'Holiday offer not found');
    }

    $this->holidayModel->delete($holidayid);

    return redirect()->back()
        ->with('success', 'Holiday offer deleted successfully');
}

    public function holidaygenerateconformvoucher($holidayid)
    {
       $isAdmin    = session()->get('role') === 'admin';
        $isEmployee = session()->get('isEmployeeLoggedIn') === true;
        $userDept   = session()->get('department_id');
    
        if (!$isAdmin && (!$isEmployee || $userDept != 7)) {
            return redirect()->to('/official')->with('error', 'Unauthorized access');
        }
              
    
        $holiday = $this->holidayModel->where('id', $holidayid)->findAll();
        if (!$holiday || !is_array($holiday)) {
            return redirect()->back()->with('error', 'Offer not found or invalid data');
        }
    
        $user = $this->userModel->where('ms_num', $holiday[0]['mem_ms_num'] ?? null)->first();
        if (!$user || !is_array($user)) {
            return redirect()->back()->with('error', 'User not found or invalid data');
        }

        $data = [
            'user' => $user,
            'holiday' => $holiday,
        ];
    
        return view('backend/member_admin/holiday-generate-voucher', $data);
    }

    public function holidayviewVoucher($holidayid)
    {
        
        $isAdmin     = session()->get('role') === 'admin';
        $isEmployee  = session()->get('isEmployeeLoggedIn') === true;
        $userDept    = session()->get('department_id');
    
        $allowedDepts = [6, 7];
    
        if (!$isAdmin && (!$isEmployee || !in_array($userDept, $allowedDepts))) {
            return redirect()->to('/official')->with('error', 'Unauthorized access');
        }
        
               
        $holiday = $this->holidayModel->where('id', $holidayid)->findAll();
        if (!$holiday || !is_array($holiday)) {
            return redirect()->back()->with('error', 'Offer not found or invalid data');
        }
    
        $user = $this->userModel->where('ms_num', $holiday[0]['mem_ms_num'] ?? null)->first();
        if (!$user || !is_array($user)) {
            return redirect()->back()->with('error', 'User not found or invalid data');
        }
    
        $vouchers = $this->generateholidayvoucherModel->where('tbl_id', $holidayid)->findAll();
    
        $data = [
            'user' => $user,
            'holiday' => $holiday,
            'vouchers' => $vouchers,
        ];
    
        $dompdf = new \Dompdf\Dompdf();
        $options = $dompdf->getOptions();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);
        $dompdf->setOptions($options);
    
        $html = view('backend/member_admin/voucher-view', $data);
        $dompdf->loadHtml($html);
    
        $dompdf->setPaper('A4', 'portrait');
    
        $dompdf->render();
    
    header("Content-Type: application/pdf");
    header("Content-Disposition: inline; filename=voucher_holiday_{$holidayid}.pdf");
    header("Cache-Control: public, must-revalidate, max-age=0");
    header("Pragma: public");

    echo $dompdf->output();
    exit;
    }
    
    public function holidaydownloadVoucher($holidayid)
{
        
        $isAdmin     = session()->get('role') === 'admin';
        $isEmployee  = session()->get('isEmployeeLoggedIn') === true;
        $userDept    = session()->get('department_id');
    
        $allowedDepts = [6, 7];
    
        if (!$isAdmin && (!$isEmployee || !in_array($userDept, $allowedDepts))) {
            return redirect()->to('/official')->with('error', 'Unauthorized access');
        }
        
    $holiday = $this->holidayModel->where('id', $holidayid)->findAll();
    if (!$holiday || !is_array($holiday)) {
        return redirect()->back()->with('error', 'Offer not found or invalid data');
    }

    $user = $this->userModel->where('ms_num', $holiday[0]['mem_ms_num'] ?? null)->first();
    if (!$user || !is_array($user)) {
        return redirect()->back()->with('error', 'User not found or invalid data');
    }

    $vouchers = $this->generateholidayvoucherModel->where('tbl_id', $holidayid)->findAll();

    $data = [
        'user' => $user,
        'holiday' => $holiday,
        'vouchers' => $vouchers
    ];

    $dompdf = new \Dompdf\Dompdf();
    $options = $dompdf->getOptions();
    $options->set('isHtml5ParserEnabled', true);
    $options->set('isRemoteEnabled', true); // Enable for external assets if needed
    $dompdf->setOptions($options);

    $html = view('backend/member_admin/voucher-view', $data);
    $dompdf->loadHtml($html);

    $dompdf->setPaper('A4', 'portrait');

    $dompdf->render();


     // Send headers for PDF output
    header("Content-Type: application/pdf");
    header("Content-Disposition: attachment; filename=voucher_holiday_{$holidayid}.pdf");
    header("Cache-Control: public, must-revalidate, max-age=0");
    header("Pragma: public");

    echo $dompdf->output();
    exit;
    
}
         public function holidaystorevoucher()
         {
             $data = [
                 'created_at'       => date('Y-m-d H:i:s'),  // Automatically set the creation date
                 'book_id'          => $this->request->getPost('book_id'),
                 'confirm_by'       => $this->request->getPost('confirm_by'),
                 'tbl_id'           => $this->request->getPost('tbl_id'), // This is assumed to be the offer ID
                 'ms_num'           => $this->request->getPost('ms_num'),
                 'name'             => $this->request->getPost('name'),
                 'email'            => $this->request->getPost('email'),
                 'mobile'           => $this->request->getPost('mobile'),
                 'destination'      => $this->request->getPost('destination'),
                 'property_name'    => $this->request->getPost('property_name'),
                 'location'         => $this->request->getPost('location'),
                 'contact_num'      => $this->request->getPost('contact_num'),
                 'no_of_room'       => $this->request->getPost('no_of_room'),
                 'room_type'        => $this->request->getPost('room_type'),
                 'includes'         => $this->request->getPost('includes'),
                 'adults'           => $this->request->getPost('adults'),
                 'kids'             => $this->request->getPost('kids'),
                 'check_in'         => $this->request->getPost('check_in'),
                 'check_out'        => $this->request->getPost('check_out'),
                 'check_in_time'    => $this->request->getPost('check_in_time'),
                 'check_out_time'   => $this->request->getPost('check_out_time'),
                 'book_amount'      => $this->request->getPost('book_amount'),
                 'book_through'     => $this->request->getPost('book_through'),
                 'book_from'        => $this->request->getPost('book_from'),
                 'received_amount'  => $this->request->getPost('received_amount'),
                 'deduction_amount' => $this->request->getPost('deduction_amount'),
             ];
         
             if ($this->generateholidayvoucherModel->insert($data)) {
                 $holidayid = $this->request->getPost('tbl_id');
         
                 $holidayData = [
                     'status' => 'Generated', 
                 ];
         
                 $this->holidayModel->update($holidayid, $holidayData);
         
                 return redirect()->to('view-holiday/' . $data['ms_num'])->with('message', 'Submitted Successfully!');
             } else {
                 return redirect()->back()->withInput()->with('errors', ['database' => 'An error occurred while saving.']);
             }
         }

         public function holidayeditgenerateconformvoucher($holidayid)
         {
        
       $isAdmin    = session()->get('role') === 'admin';
        $isEmployee = session()->get('isEmployeeLoggedIn') === true;
        $userDept   = session()->get('department_id');
    
        if (!$isAdmin && (!$isEmployee || $userDept != 7)) {
            return redirect()->to('/official')->with('error', 'Unauthorized access');
        }
         
             $holiday = $this->holidayModel->where('id', $holidayid)->findAll();
             if (!$holiday || !is_array($holiday)) {
                 return redirect()->back()->with('error', 'Offer not found or invalid data');
             }
         
             $user = $this->userModel->where('ms_num', $holiday[0]['mem_ms_num'] ?? null)->first();
             if (!$user || !is_array($user)) {
                 return redirect()->back()->with('error', 'User not found or invalid data');
             }

             $vouchers = $this->generateholidayvoucherModel->where('tbl_id', $holidayid)->findAll();

             $data = [
                 'user' => $user,
                 'holiday' => $holiday,
                 'vouchers' => $vouchers
             ];
         
             return view('backend/member_admin/holiday-edit-generate-confirmation-voucher', $data);
         }
    
         public function updateHolidayVoucher($holidayid)
        {
            $isAdmin    = session()->get('role') === 'admin';
            $isEmployee = session()->get('isEmployeeLoggedIn') === true;
            $userDept   = session()->get('department_id');
        
            if (!$isAdmin && (!$isEmployee || $userDept != 7)) {
                return redirect()->to('/official')
                    ->with('error', 'Unauthorized access');
            }
        
            $voucher = $this->generateholidayvoucherModel
                ->where('tbl_id', $holidayid)
                ->first();
        
            if (!$voucher) {
                return redirect()->back()
                    ->with('error', 'Voucher not found.');
            }
        
            if (!$this->request->getPost('confirm_by')) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Confirmed By field is required.');
            }
        
           $data = [
                 'updated_at'       => date('Y-m-d H:i:s'),
                 'book_id'          => $this->request->getPost('book_id'),
                 'confirm_by'       => $this->request->getPost('confirm_by'),
                 'ms_num'           => $this->request->getPost('ms_num'),
                 'name'             => $this->request->getPost('name'),
                 'email'            => $this->request->getPost('email'),
                 'mobile'           => $this->request->getPost('mobile'),
                 'destination'      => $this->request->getPost('destination'),
                 'property_name'    => $this->request->getPost('property_name'),
                 'location'         => $this->request->getPost('location'),
                 'contact_num'      => $this->request->getPost('contact_num'),
                 'no_of_room'       => $this->request->getPost('no_of_room'),
                 'room_type'        => $this->request->getPost('room_type'),
                 'includes'         => $this->request->getPost('includes'),
                 'adults'           => $this->request->getPost('adults'),
                 'kids'             => $this->request->getPost('kids'),
                 'check_in'         => $this->request->getPost('check_in'),
                 'check_out'        => $this->request->getPost('check_out'),
                 'check_in_time'    => $this->request->getPost('check_in_time'),
                 'check_out_time'   => $this->request->getPost('check_out_time'),
                 'cv_num'           => $this->request->getPost('cv_num'),
                 'book_amount'      => $this->request->getPost('book_amount'),
                 'book_through'     => $this->request->getPost('book_through'),
                 'book_from'        => $this->request->getPost('book_from'),
                 'company'          => $this->request->getPost('company'),
                 'received_amount'  => $this->request->getPost('received_amount'),
                 'deduction_amount' => $this->request->getPost('deduction_amount'),
             ];
        
            $updated = $this->generateholidayvoucherModel
                ->where('tbl_id', $holidayid)
                ->update(null, $data);
        
            if ($updated === false) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Failed to update voucher. Please try again.');
            }
        
            return redirect()->back()
                ->with('success', 'Voucher updated successfully!');
        }

    public function searchgifvoucher()
    {
        $isAdmin     = session()->get('role') === 'admin';
        $isEmployee  = session()->get('isEmployeeLoggedIn') === true;
        $userDept    = session()->get('department_id');
    
        $allowedDepts = [2, 6, 7];
    
        if (!$isAdmin && (!$isEmployee || !in_array($userDept, $allowedDepts))) {
            return redirect()->to('/official')->with('error', 'Unauthorized access');
        }
    
        return view('backend/member_admin/search-voucher');
    }

        public function searchgiftvouchervalue()
        {
            $post_data = $this->request->getJSON();
        
            if (!$post_data || !isset($post_data->search_key) || !isset($post_data->search_value)) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Invalid request.'
                ]);
            }
        
            $search_key = $post_data->search_key;
            $search_value = $post_data->search_value;
        
            $builder = $this->generategiftvoucherModel->builder();
            $builder->select('tbl_gift_voucher.*, tbl_branch.name AS branch_name');
            $builder->join('tbl_branch', 'tbl_gift_voucher.branch_id = tbl_branch.id', 'left');
        
            if ($search_key == 'name') {
                $builder->like('tbl_gift_voucher.name', $search_value);
                $vouchers = $builder->get()->getResultArray();
            } elseif ($search_key == 'email') {
                $builder->like('tbl_gift_voucher.email', $search_value);
                $vouchers = $builder->get()->getResultArray();
            } elseif ($search_key == 'phone') {
                $builder->like('tbl_gift_voucher.phone', $search_value);
                $vouchers = $builder->get()->getResultArray();
            } elseif ($search_key == 'v_num') {
                $builder->where('tbl_gift_voucher.v_num', $search_value);
                $vouchers = $builder->get()->getResultArray();
            } elseif ($search_key == 'issue_date') {
                $builder->where('tbl_gift_voucher.issue_date', $search_value);
                $vouchers = $builder->get()->getResultArray();
            } else {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Invalid search key.'
                ]);
            }
        
            if ($vouchers) {
                return $this->response->setJSON([
                    'success' => true,
                    'vouchers' => $vouchers
                ]);
            } else {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'No vouchers found.'
                ]);
            }
        }


    public function Giftviewvoucher($vouchersId)
    {
        
              $isAdmin    = session()->get('role') === 'admin';
            $isEmployee = session()->get('isEmployeeLoggedIn') === true;
            
            if (!$isAdmin && !$isEmployee) {
                return redirect()->to('/official')->with('error', 'Unauthorized access');
            }
            
        $voucher = $this->generategiftvoucherModel->find($vouchersId);
    
        if (!$voucher) {
            return redirect()->back()->with('error', 'Voucher not found');
        }
    
        $branch = $this->branchModel->find($voucher['branch_id']);
        $voucher['branch_name'] = $branch['name'] ?? 'Unknown Branch';
    
        // DomPDF setup
        $dompdf = new \Dompdf\Dompdf();
        $options = $dompdf->getOptions();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);
        $dompdf->setOptions($options);
    
        // Load HTML view
        $html = view('backend/member_admin/voucher_pdf_template', [
            'vouchers' => [$voucher]
        ]);
    
        $dompdf->loadHtml($html);
    
        // Paper size
        $dompdf->setPaper('A4', 'portrait');
    
        // Render
        $dompdf->render();
    
        // Output PDF inline
        header("Content-Type: application/pdf");
        header("Content-Disposition: inline; filename=voucher_{$vouchersId}.pdf");
        header("Cache-Control: public, must-revalidate, max-age=0");
        header("Pragma: public");
    
        echo $dompdf->output();
        exit;
    }
    
    public function sendgiftvoucheremail()
    {
        $input = $this->request->getJSON();
        $voucherId = $input->voucher_id ?? null;
    
        if (!$voucherId) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Voucher ID missing'
            ]);
        }
    
        $voucher = $this->generategiftvoucherModel->find($voucherId);
        if (!$voucher) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Voucher not found'
            ]);
        }
        
        $branch = $this->branchModel->find($voucher['branch_id']);
        $voucher['branch_name'] = $branch['name'] ?? 'Unknown Branch';
    
        $dompdf = new \Dompdf\Dompdf();
        $options = $dompdf->getOptions();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);
        $dompdf->setOptions($options);
    
        $html = view('backend/member_admin/voucher_pdf_template', ['vouchers' => [$voucher]]);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
    
        $pdfContent = $dompdf->output();
    
        $emailService = \Config\Services::email();
        $emailService->setFrom('voucher@delviaholidaysinternational.com', 'Delvia Holidays International');
        $emailService->setTo($voucher['email']);
    
    
        $emailService->setSubject(
            'Delvia Holidays | Voucher No: ' . $voucher['v_num'] . ' | Travel Voucher Details'
        );
    
    
        $message = '
            <p>Dear <strong>' . esc($voucher['name']) . '</strong>,</p>
    
            <p>Thank you for choosing <strong>Delvia Holidays International</strong>.</p>
    
            <p>Your travel voucher is attached below. Please review the details carefully.  
            If you need any assistance, our team is here to help you.</p>
    
            <br>
    
            <p>Warm Regards,<br>
            <strong>Delvia Holidays Team</strong></p>
        ';
    
        $emailService->setMessage($message);
        $emailService->setMailType('html'); // Important for HTML email
    
    
        $emailService->attach(
            $pdfContent,
            'attachment',
            'voucher_' . $voucherId . '.pdf',
            'application/pdf'
        );
    
        if ($emailService->send()) {
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Email sent successfully'
            ]);
        } else {
            $debug = $emailService->printDebugger(['headers', 'subject', 'body']);
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Email sending failed.',
                'debug'   => $debug
            ]);
        }
    }
    
        public function changegiftvoucherstatus()
        {
            // Get the JSON payload from the request
            $input = $this->request->getJSON();
    
            if (isset($input->mem_id) && isset($input->mem_status)) {
                $id = $input->mem_id;
                $status = $input->mem_status;
    
                // Load the model
    
                // Update the status
                $update = $this->generategiftvoucherModel->update($id, ['status' => $status]);
    
                if ($update) {
                    return $this->response->setJSON([
                        'success' => true,
                        'message' => 'Status updated successfully.'
                    ]);
                } else {
                    return $this->response->setJSON([
                        'success' => false,
                        'message' => 'Failed to update status. Please check the ID.'
                    ]);
                }
            } else {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Invalid input data.'
                ]);
            }
        }
        
public function editGiftVoucher($voucher_id)
{
    $session = session();

    $isAdmin    = $session->get('role') === 'admin';
    $isEmployee = $session->get('isEmployeeLoggedIn') === true;
    $userDept   = $session->get('department_id');

    // Authorization check
    if (!$isAdmin && (!$isEmployee || (int)$userDept !== 2)) {
        return redirect()->to('/official')
            ->with('error', 'Unauthorized access');
    }

    // Get voucher data
    $voucher = $this->generategiftvoucherModel
        ->where('id', (int)$voucher_id)
        ->first();

    if (!$voucher) {
        return redirect()->back()
            ->with('error', 'Gift voucher not found');
    }

    // Subsidiaries list
    $data['subsidiaries'] = $this->subsidiaryModel->getAllSubsidiaries();

    // Branches for selected subsidiary (EDIT case)
    $data['branches'] = $this->branchModel
        ->where('subsidiary_id', $voucher['subsidiary_id'])
        ->findAll();

    $data['voucher'] = $voucher;

    return view('backend/member_admin/edit-gift-voucher', $data);
}

public function update_gift_voucher($id)
{
    // Check voucher exists
    $voucher = $this->generategiftvoucherModel->find($id);
    if (!$voucher) {
        return redirect()->back()
            ->with('error', 'Voucher not found');
    }

    // Validation
    $rules = [
        'category'       => 'required|in_list[Member,Non-Member]',
        'subsidiary_id'  => 'required|integer',
        'branch_id'      => 'required|integer',
        'name'           => 'required|min_length[3]',
        'phone'          => 'required|numeric|min_length[10]|max_length[10]',
        'email'          => 'required|valid_email',
        'issue_date'     => 'required|valid_date',
    ];

    if (!$this->validate($rules)) {
        return redirect()->back()
            ->withInput()
            ->with('error', $this->validator->listErrors());
    }

    // Voucher types
    $voucherTypes = $this->request->getPost('voucher_type') ?? [];
    $voucherTypeStr = implode(',', $voucherTypes);

    // Member number
    $memberNum = $this->request->getPost('member_num');
    if ($this->request->getPost('category') === 'Non-Member') {
        $memberNum = 0;
    }

    // Update data
    $data = [
        'category'      => $this->request->getPost('category'),
        'subsidiary_id' => (int)$this->request->getPost('subsidiary_id'),
        'branch_id'     => (int)$this->request->getPost('branch_id'),
        'member_num'    => $memberNum,
        'name'          => trim($this->request->getPost('name')),
        'phone'         => trim($this->request->getPost('phone')),
        'email'         => trim($this->request->getPost('email')),
        'issue_date'    => $this->request->getPost('issue_date'),
        'voucher_type'  => $voucherTypeStr,
        'holiday'       => in_array('holiday', $voucherTypes)
                            ? $this->request->getPost('holiday')
                            : null,
        'movie'         => in_array('movie', $voucherTypes)
                            ? $this->request->getPost('movie')
                            : null,
        'updated_at'    => date('Y-m-d H:i:s')
    ];

    // Update
    $this->generategiftvoucherModel->update($id, $data);

    return redirect()->back()
        ->with('success', 'Gift voucher updated successfully');
}


 public function addmemberdocument($ms_num = null)
{
      $isAdmin     = session()->get('role') === 'admin';
        $isEmployee  = session()->get('isEmployeeLoggedIn') === true;
        $userDept    = session()->get('department_id');
    
        $allowedDepts = [6, 7];
    
        if (!$isAdmin && (!$isEmployee || !in_array($userDept, $allowedDepts))) {
            return redirect()->to('/official')->with('error', 'Unauthorized access');
        }
    
    if (!$ms_num) {
        return redirect()->back()->with('error', 'Membership number missing');
    }

    $documents = $this->userModel
        ->where('ms_num', $ms_num)
        ->findAll();

    return view('backend/member_admin/add-document', [
        'ms_num'    => $ms_num,
        'documents' => $documents
    ]);
}

public function storeDocument()
{
    $ms_num = $this->request->getPost('ms_num');

    if (!$ms_num) {
        return redirect()->to('/official')->with('error', 'Membership number missing');
    }

    $rules = [
        'document' => 'uploaded[document]|max_size[document,20480]|ext_in[document,pdf,jpg,jpeg,png]'
    ];

    if (!$this->validate($rules)) {
        return redirect()->to('member/add-document/'.$ms_num)
            ->with('error', 'Invalid file');
    }

    $file = $this->request->getFile('document');

    if ($file->isValid() && !$file->hasMoved()) {

        $old = $this->userModel->where('ms_num', $ms_num)->first();

        if ($old && !empty($old['document'])) {
            $oldPath = FCPATH.'uploads/member_documents/'.$old['document'];
            if (file_exists($oldPath)) {
                unlink($oldPath);
            }
        }

        // ðŸ”¹ Upload new
        $newName = $file->getRandomName();
        $file->move(FCPATH.'uploads/member_documents', $newName);


        $this->userModel
            ->where('ms_num', $ms_num)
            ->set(['document' => $newName])
            ->update();

        // âœ… IMPORTANT FIX HERE
        return redirect()->back()
            ->with('message', 'Document updated successfully');
    }

    return redirect()->back()
        ->with('error', 'File upload failed');
}

public function deleteDocument($ms_num)
{
        $isAdmin     = session()->get('role') === 'admin';
        $isEmployee  = session()->get('isEmployeeLoggedIn') === true;
        $userDept    = session()->get('department_id');
    
        $allowedDepts = [6, 7];
    
        if (!$isAdmin && (!$isEmployee || !in_array($userDept, $allowedDepts))) {
            return redirect()->to('/official')->with('error', 'Unauthorized access');
        }
    

    if (!$ms_num) {
        return redirect()->back()->with('error', 'Membership number missing');
    }

    $member = $this->userModel
        ->where('ms_num', $ms_num)
        ->first();

    if (!$member || empty($member['document'])) {
        return redirect()->back()
            ->with('error', 'Document not found');
    }

    $filePath = FCPATH.'uploads/member_documents/'.$member['document'];

    if (file_exists($filePath)) {
        unlink($filePath);
    }

    $this->userModel
        ->where('ms_num', $ms_num)
        ->set(['document' => null])
        ->update();

    return redirect()->back()
        ->with('message', 'Document deleted successfully');
}


public function addmembercomment($ms_num = null)
{
    $isAdmin     = session()->get('role') === 'admin';
    $isEmployee  = session()->get('isEmployeeLoggedIn') === true;
    $userDept    = session()->get('department_id');

    $allowedDepts = [6, 7];

    if (!$isAdmin && (!$isEmployee || !in_array($userDept, $allowedDepts))) {
        return redirect()->to('/official')->with('error', 'Unauthorized access');
    }

    if (!$ms_num) {
        return redirect()->back()->with('error', 'Membership number missing');
    }

    $user = $this->userModel
        ->where('ms_num', $ms_num)
        ->first();

    return view('backend/member_admin/add-comment', [
        'ms_num'  => $ms_num,
        'comment' => $user['comment'] ?? ''  
    ]);
}


public function storecomment()
{
    $ms_num = $this->request->getPost('ms_num');
    
    if (!$ms_num) {
        return redirect()->to('/official')->with('error', 'Membership number missing');
    }

   $comment = $this->request->getPost('comment');

        $this->userModel
            ->where('ms_num', $ms_num)
            ->set(['comment' => $comment])
            ->update();

        return redirect()->back()
            ->with('message', 'Comment updated successfully');
    }


         }    
         
         
         