<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\HolidayModel;
use App\Models\OfferModel;
use App\Models\DestinationModel;
use App\Models\GenerateinvoiceModel;

class Login extends BaseController
{
    protected $generateinvoiceModel;
    protected $userModel;

    public function __construct()
    {
        $this->generateinvoiceModel = new GenerateinvoiceModel();
        $this->userModel = new UserModel();
    }

    public function index()
    {
        return view('login');
    }

    public function authenticate()
    {
        $session = session();
        $userModel = new UserModel();

        $ms_num = $this->request->getVar('ms_num');
        $password = $this->request->getVar('password');

        $user = $userModel->where('ms_num', $ms_num)->first();

        if (is_null($user)) {
            return redirect()->back()->withInput()->with('error', 'Invalid username or password.');
        }

        if ($user['status'] == '0') {
            return redirect()->back()->withInput()->with('error', 'Your account is inactive. Please contact support.');
        }

        if (!password_verify($password, $user['password'])) {
            return redirect()->back()->withInput()->with('error', 'Invalid username or password.');
        }

        $ses_data = [
            'id' => $user['id'],
            'ms_num' => $user['ms_num'],
            'isLoggedIn' => true
        ];

        $session->set($ses_data);
        return redirect()->to('/member/profile');
    }

    public function Datashow()
    {
        $ms_num = session()->get('ms_num');
        $user = (new UserModel())->where('ms_num', $ms_num)->first();

        if (!$user || $user['status'] == '0') {
            session()->destroy();
            return redirect()->to('/login')->with('error', 'Your account is inactive or does not exist.');
        }

        $data['user'] = $user;
       return view('backend/member_login/profile', $data);
    }
    
    public function viewMemberDocument()
    {
        $ms_num = session()->get('ms_num');
    
        if (!$ms_num) {
            return redirect()->to('/login')->with('error', 'Please login first');
        }
    
        $documents = $this->userModel
                          ->where('ms_num', $ms_num)
                          ->findAll();   // ✅ MULTIPLE ROWS
    
        return view('backend/member_login/member_document_view', [
            'documents' => $documents
        ]);
    }

    public function holidays()
    {
        $ms_num = session()->get('ms_num');
        $member = (new UserModel())->where('ms_num', $ms_num)->first();

        if (!$member || $member['status'] == '0') {
            session()->destroy();
            return redirect()->to('/login')->with('error', 'Your account is inactive.');
        }

        $data['holi_res'] = (new HolidayModel())->where('mem_ms_num', $ms_num)->findAll();
        $data['member'] = $member;

        return view('backend/member_login/holiday', $data);
    }

    public function offermember()
    {
        $ms_num = session()->get('ms_num');
        $member = (new UserModel())->where('ms_num', $ms_num)->first();

        if (!$member || $member['status'] == '0') {
            session()->destroy();
            return redirect()->to('/login')->with('error', 'Your account is inactive.');
        }

        $data['offer_res'] = (new OfferModel())->where('mem_ms_num', $ms_num)->findAll();
        $data['member'] = $member;

        return view('backend/member_login/offers', $data);
    }

    public function amcPayments()
    {
        $ms_num = session()->get('ms_num');
        $member = (new UserModel())->where('ms_num', $ms_num)->first();

        if (!$member || $member['status'] == '0') {
            session()->destroy();
            return redirect()->to('/login')->with('error', 'Your account is inactive.');
        }

        $data['amc_res'] = $this->generateinvoiceModel
            ->where('mem_ms_num', $ms_num)
            ->where('payment_type', 'AMC')
            ->orderBy('gen_date', 'DESC')
            ->findAll();

        $data['member'] = $member;

        return view('backend/member_login/amcfee', $data);
    }

    public function holidayPayments()
    {
        $ms_num = session()->get('ms_num');
        $member = (new UserModel())->where('ms_num', $ms_num)->first();

        if (!$member || $member['status'] == '0') {
            session()->destroy();
            return redirect()->to('/login')->with('error', 'Your account is inactive.');
        }

        $data['amc_res'] = $this->generateinvoiceModel
            ->where('mem_ms_num', $ms_num)
            ->where('payment_type', 'Holiday Amount')
            ->orderBy('gen_date', 'DESC')
            ->findAll();

        $data['member'] = $member;

        return view('backend/member_login/memberfee', $data);
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }

    public function changePasswordForm()
    {
        return view('backend/member_login/change_password');
    }

    public function updatePassword()
    {
        $userModel = new UserModel();
        $session = session();
        $id = $session->get('id');

        $current = $this->request->getPost('current_password');
        $new = $this->request->getPost('new_password');
        $confirm = $this->request->getPost('confirm_password');

        $user = $userModel->find($id);

        if (!password_verify($current, $user['password'])) {
            return redirect()->back()->with('error', 'Current password is incorrect.');
        }

        if ($new !== $confirm) {
            return redirect()->back()->with('error', 'New password and confirm password do not match.');
        }

        $userModel->update($id, [
            'password' => password_hash($new, PASSWORD_DEFAULT),
            'en_password' => $confirm
        ]);

        return redirect()->to('/member/change_password')->with('success', 'Password updated successfully.');
    }
    

}
