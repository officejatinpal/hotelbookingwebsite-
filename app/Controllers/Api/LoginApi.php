<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\HolidayModel;
use App\Models\OfferModel;
use App\Models\GenerateinvoiceModel;
use App\Models\GenerateholidayvoucherModel;

class LoginApi extends BaseController
{
    protected $userModel;
    protected $generateinvoiceModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->generateinvoiceModel = new GenerateinvoiceModel();
    }

    private function getInput()
    {
        return $this->request->getJSON(true) ?? $this->request->getPost();
    }

    private function getUserByToken()
    {
        $header = $this->request->getHeaderLine('Authorization');
    
        if (!$header || !str_starts_with($header, 'Bearer ')) {
            return false;
        }
    
        $token = trim(str_replace('Bearer', '', $header));
    
        $user = $this->userModel
            ->where('api_token', $token)
            ->first();
    
        return $user ?: false;
    }

    public function login()
    {
        $data = $this->getInput();

        $ms_num   = $data['ms_num'] ?? null;
        $password = $data['password'] ?? null;

        if (!$ms_num || !$password) {
            return $this->response->setStatusCode(400)->setJSON([
                'status' => false,
                'message' => 'MS Number and password required.'
            ]);
        }

        $user = $this->userModel->where('ms_num', $ms_num)->first();

        if (!$user || !password_verify($password, $user['password'])) {
            return $this->response->setStatusCode(401)->setJSON([
                'status' => false,
                'message' => 'Invalid username or password.'
            ]);
        }

        if ($user['status'] == '0') {
            return $this->response->setStatusCode(403)->setJSON([
                'status' => false,
                'message' => 'Your account is inactive. Please contact support.'
            ]);
        }

        $token = bin2hex(random_bytes(32));

        $this->userModel->update($user['id'], [
            'api_token' => $token
        ]);

        return $this->response->setJSON([
            'status' => true,
            'message' => 'Login successful.',
            'data' => [
                'id' => $user['id'],
                'ms_num' => $user['ms_num'],
                'token' => $token,
                'isLoggedIn' => true
            ]
        ]);
    }

    public function profile()
    {
        $user = $this->getUserByToken();

        if (!$user) {
            return $this->response->setStatusCode(401)->setJSON([
                'status' => false,
                'message' => 'Session Expired!!! Please Logout & then Login again'
            ]);
        }

        if ($user['status'] == '0') {
            return $this->response->setStatusCode(403)->setJSON([
                'status' => false,
                'message' => 'User inactive.'
            ]);
        }

        return $this->response->setJSON([
            'status' => true,
            'data' => $user
        ]);
    }

    public function documents()
    {
        $user = $this->getUserByToken();
    
        if (!$user) {
            return $this->response->setStatusCode(401)->setJSON([
                'status' => false,
                'message' => 'Session Expired!!! Please Logout & then Login again'
            ]);
        }
    
        $docs = $this->userModel
                     ->select('document')
                     ->where('ms_num', $user['ms_num'])
                     ->findAll();
    
            foreach ($docs as &$row) {
                $row['document']  = base_url('uploads/member_documents/' . $row['document']);
                $row['doc_name'] = pathinfo($row['document'], PATHINFO_FILENAME);
            }
    
    
        return $this->response->setJSON([
            'status' => true,
            'data' => $docs
        ]);
    }

    public function holidays()
    {
        $user = $this->getUserByToken();

        if (!$user) {
            return $this->response->setStatusCode(401)->setJSON([
                'status' => false,
                'message' => 'Session Expired!!! Please Logout & then Login again'
            ]);
        }

        $data = (new HolidayModel())
            ->where('mem_ms_num', $user['ms_num'])
            ->findAll();

        return $this->response->setJSON([
            'status' => true,
            'data' => $data
        ]);
    }

    public function offers()
    {
        $user = $this->getUserByToken();

        if (!$user) {
            return $this->response->setStatusCode(401)->setJSON([
                'status' => false,
                'message' => 'Session Expired!!! Please Logout & then Login again'
            ]);
        }

        $data = (new OfferModel())
            ->where('mem_ms_num', $user['ms_num'])
            ->findAll();

        return $this->response->setJSON([
            'status' => true,
            'data' => $data
        ]);
    }
    
    public function amcPayments()
    {
        $user = $this->getUserByToken();

        if (!$user) {
            return $this->response->setStatusCode(401)->setJSON([
                'status' => false,
                'message' => 'Session Expired!!! Please Logout & then Login again'
            ]);
        }

        $data = $this->generateinvoiceModel
            ->where('mem_ms_num', $user['ms_num'])
            ->where('payment_type', 'AMC')
            ->orderBy('gen_date', 'DESC')
            ->findAll();

        return $this->response->setJSON([
            'status' => true,
            'data' => $data
        ]);
    }

    public function holidayPayments()
    {
        $user = $this->getUserByToken();

        if (!$user) {
            return $this->response->setStatusCode(401)->setJSON([
                'status' => false,
                'message' => 'Session Expired!!! Please Logout & then Login again'
            ]);
        }

        $data = $this->generateinvoiceModel
            ->where('mem_ms_num', $user['ms_num'])
            ->where('payment_type', 'Holiday Amount')
            ->orderBy('gen_date', 'DESC')
            ->findAll();

        return $this->response->setJSON([
            'status' => true,
            'data' => $data
        ]);
    }

    public function changePassword()
    {
        $user = $this->getUserByToken();

        if (!$user) {
            return $this->response->setStatusCode(401)->setJSON([
                'status' => false,
                'message' => 'Session Expired!!! Please Logout & then Login again'
            ]);
        }

        $data = $this->getInput();

        $current = $data['current_password'] ?? null;
        $new     = $data['new_password'] ?? null;
        $confirm = $data['confirm_password'] ?? null;

        if (!$current || !$new || !$confirm) {
            return $this->response->setStatusCode(400)->setJSON([
                'status' => false,
                'message' => 'All fields are required.'
            ]);
        }

        if (!password_verify($current, $user['password'])) {
            return $this->response->setStatusCode(401)->setJSON([
                'status' => false,
                'message' => 'Current password is incorrect.'
            ]);
        }

        if ($new !== $confirm) {
            return $this->response->setStatusCode(400)->setJSON([
                'status' => false,
                'message' => 'New password and confirm password do not match.'
            ]);
        }

        $this->userModel->update($user['id'], [
            'password' => password_hash($new, PASSWORD_DEFAULT),
            'en_password' => $confirm
        ]);

        return $this->response->setJSON([
            'status' => true,
            'message' => 'Password updated successfully.'
        ]);
    }
    
    public function myTrips($trip_type = null)
    {
        $user = $this->getUserByToken();
    
        if (!$user) {
            return $this->response->setStatusCode(401)->setJSON([
                'status' => false,
                'message' => 'Session Expired!!! Please Logout & then Login again'
            ]);
        }
    
        if (!$trip_type) {
            return $this->response->setJSON([
                'status' => false,
                'message' => 'Trip type required (upcoming / completed)'
            ]);
        }
    
        $today = date('Y-m-d');
        $holidayModel = new GenerateholidayvoucherModel();
    
        // Base query
        $builder = $holidayModel->where('ms_num', $user['ms_num']);
    
        if ($trip_type === 'upcoming') {
    
            $builder->where('check_in >', $today)
                    ->orderBy('check_in', 'ASC');
    
            $tripStatus = 'upcoming';
    
        } elseif ($trip_type === 'completed') {
    
            $builder->where('check_out <', $today)
                    ->orderBy('check_out', 'DESC');
    
            $tripStatus = 'completed';
    
        } else {
            return $this->response->setJSON([
                'status' => false,
                'message' => 'Invalid trip type'
            ]);
        }
    
        $rows = $builder->findAll();
    
        $data = [];
        foreach ($rows as $row) {
    
            $nights = 0;
            if (!empty($row['check_in']) && !empty($row['check_out'])) {
                $nights = (strtotime($row['check_out']) - strtotime($row['check_in'])) / 86400;
            }
    
            $data[] = [
                'destination'  => $row['destination'] ?? ($row['destination_name'] ?? null),
                'property'     => $row['property_name'] ?? null,
                'check_in'     => $row['check_in'] ?? null,
                'check_out'    => $row['check_out'] ?? null,
                'nights_days'  => $nights . 'N / ' . ($nights + 1) . 'D',
                'trip_status'  => $tripStatus,
            ];
        }
    
        return $this->response->setJSON([
            'status' => true,
            'type'   => $trip_type,
            'count'  => count($data),
            'data'   => $data
        ]);
    }

     public function booking()
    {
        $user = $this->getUserByToken();
        if (!$user) {
            return $this->response->setStatusCode(401)->setJSON([
                'status' => false,
                'message' => 'Session Expired!!! Please Logout & then Login again'
            ]);
        }
    
        if ($this->request->getMethod(true) === 'GET') {
    
            $locations = (new \App\Models\DestinationModel())
                ->select('id, name')
                ->where('status', 1)
                ->orderBy('name', 'ASC')
                ->findAll();
    
            $months = [];
            for ($i = 0; $i < 12; $i++) {
                $time = strtotime("+$i month");
                $months[] = [
                    'month_no'   => date('n', $time),
                    'month_name' => date('F', $time)
                ];
            }
    
            $packages = [
                ['label' => '1N / 2D'],
                ['label' => '2N / 3D'],
                ['label' => '3N / 4D'],
                ['label' => '5N / 6D'],
                ['label' => '6N / 7D'],
            ];
    
            return $this->response->setJSON([
                'status' => true,
                'dropdowns' => [
                    'locations' => $locations,
                    'months'    => $months,
                    'packages'  => $packages
                ]
            ]);
        }
    
        $data = $this->getInput();
    
        $holiday_id = $data['holiday_id'] ?? null;   // „„„~„Q IMPORTANT
        $location   = $data['location'] ?? null;
        $month      = $data['month'] ?? null;
        $package    = $data['package'] ?? null;
        $message    = $data['message'] ?? '';
    
        if (!$holiday_id || !$location || !$month || !$package) {
            return $this->response->setJSON([
                'status'  => false,
                'message' => 'holiday_id, location, month and package are required'
            ]);
        }
    
        $cache = cache();
        $cacheKey = 'holiday_booking_' . $user['ms_num'] . '_' . $holiday_id;
    
        if ($cache->get($cacheKey)) {
            return $this->response->setJSON([
                'status' => false,
                'message' => 'You have already sent enquiry for this holiday. Please check your email for further communication.'
            ]);
        }
    
        $monthName = date("F", mktime(0, 0, 0, $month, 10));
        $memberEmail = $user['email'] ?? null;
    
        $email = \Config\Services::email();
        $email->setFrom('no-reply@delviaholidaysinternational.com', 'Holiday Booking');
        $email->setTo('info@delviaholidaysinternational.com');
        $email->setSubject('New Holiday Booking Enquiry');
        $email->setMailType('html');
    
        if ($memberEmail) {
            $email->setReplyTo($memberEmail, $user['name'] ?? 'Member');
        }
    
        $email->setMessage("
            <h3>Holiday Booking Enquiry</h3>
            
            <p><b>Holiday ID:</b> $holiday_id</p>
            <p><b>Member No:</b> {$user['ms_num']}</p>
            <p><b>Member Name:</b> {$user['name']}</p>
            <p><b>Member Email:</b> {$user['email']}</p>
    
            <hr>
            
            <p><b>Location:</b> $location</p>
            <p><b>Month:</b> $monthName</p>
            <p><b>Package:</b> $package</p>
            <p><b>Message:</b> $message</p>
    
        ");
    
        try {
            $email->send();
    
            $cache->save($cacheKey, true, 86400); 
    
            return $this->response->setJSON([
                'status' => true,
                'message' => 'Holiday booking enquiry sent successfully. You will get reply on mail soon.'
            ]);
    
        } catch (\Throwable $e) {
    
            return $this->response->setJSON([
                'status' => false,
                'message' => 'Mail error: ' . $e->getMessage()
            ]);
        }
    }

     public function offerEnquiry()
    {
        $user = $this->getUserByToken();
        if (!$user) {
            return $this->response->setStatusCode(401)->setJSON([
                'status' => false,
                'message' => 'Session Expired!!! Please Logout & then Login again'
            ]);
        }
    
        $data = $this->request->getJSON(true) ?? $this->request->getPost();
    
        $offer_id = isset($data['offer_id']) ? (int)$data['offer_id'] : null;
        $message  = isset($data['message']) ? trim($data['message']) : '';
    
        if (!$offer_id) {
            return $this->response->setJSON([
                'status' => false,
                'message' => 'Valid offer_id is required'
            ]);
        }
    
        $offerModel = new \App\Models\OfferModel();
        $offer = $offerModel->find($offer_id);
    
        if (!$offer) {
            return $this->response->setJSON([
                'status' => false,
                'message' => 'Offer not found'
            ]);
        }
    
        $cache = cache();
        $cacheKey = 'offer_enquiry_' . $user['ms_num'] . '_' . $offer_id;
    
        if ($cache->get($cacheKey)) {
            return $this->response->setJSON([
                'status' => false,
                'message' => 'You have already enquired for this offer. Please coordinate via email/call.'
            ]);
        }
    
        $email = \Config\Services::email();
        $email->setFrom('no-reply@delviaholidaysinternational.com', 'Offer Enquiry');
        $email->setTo('info@delviaholidaysinternational.com');
        $email->setSubject('New Offer Enquiry');
        $email->setMailType('html');
    
        if (!empty($user['email'])) {
            $email->setReplyTo($user['email'], $user['name'] ?? 'Member');
        }
    
        $email->setMessage("
            <h3>Offer Enquiry</h3>
            
            <b>Member No:</b> {$user['ms_num']}
            <b>Member Name:</b> {$user['name']}
            <b>Member Email:</b> {$user['email']}
            <b>Offer ID:</b> {$offer_id}
            <b>Message:</b> " . esc($message) . "
            <b>Offer Name:</b> {$offer['offer']}
        ");
    
        if (!$email->send()) {
            return $this->response->setJSON([
                'status' => false,
                'message' => 'Mail sending failed'
            ]);
        }
    
        $cache->save($cacheKey, true, 86400); // 24 hours
    
        return $this->response->setJSON([
            'status' => true,
            'message' => 'Offer enquiry sent successfully. Our team will contact you soon.'
        ]);
    }
    
    public function memberFeedback()
    {
        $user = $this->getUserByToken();
        if (!$user) {
            return $this->response->setStatusCode(401)->setJSON([
                'status'  => false,
                'message' => 'Session Expired!!! Please Logout & then Login again'
            ]);
        }
    
        $rating          = $this->request->getPost('rating');
        $comment         = $this->request->getPost('comment');
        $suggestion      = $this->request->getPost('suggestion');
        $property        = $this->request->getPost('property');
        $destinationName = $this->request->getPost('destination_name');
    
        if (
            empty($rating) ||
            empty($comment) ||
            empty($suggestion) ||
            empty($property) ||
            empty($destinationName)
        ) {
            return $this->response->setJSON([
                'status'  => false,
                'message' => 'rating, comment, suggestion, property and destination name are required'
            ]);
        }
    
        $email = \Config\Services::email();
        $email->setFrom('no-reply@delviaholidaysinternational.com', 'Member Feedback');
        $email->setTo('info@delviaholidaysinternational.com');
        $email->setSubject('New Member Feedback');
        $email->setMailType('html');
    
        if (!empty($user['email'])) {
            $email->setReplyTo($user['email'], $user['name'] ?? 'Member');
        }
    
        $email->setMessage("
            <h3>Member Holiday Feedback</h3>
            <p><b>Member No:</b> {$user['ms_num']}</p>
            <p><b>Member Name:</b> {$user['name']}</p>
            <hr>
            <p><b>Property:</b> {$property}</p>
            <p><b>Destination:</b> {$destinationName}</p>
            <p><b>Rating:</b> {$rating}</p>
            <p><b>Comment:</b> {$comment}</p>
            <p><b>Suggestion:</b> {$suggestion}</p>
        ");
    
        /* STEP 2: ATTACH IMAGES (single + multiple) */
        $files = $this->request->getFiles();
    
        if (!empty($files['image'])) {
    
            $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/webp'];
    
            $images = is_array($files['image'])
                ? $files['image']
                : [$files['image']];
    
            foreach ($images as $img) {
                if (
                    $img->isValid() &&
                    !$img->hasMoved() &&
                    in_array($img->getMimeType(), $allowedTypes)
                ) {
                    $email->attach(
                        $img->getTempName(),
                        'attachment',
                        $img->getClientName()
                    );
                }
            }
        }
    
        if (!$email->send()) {
            return $this->response->setJSON([
                'status'  => false,
                'message' => 'Email sending failed'
            ]);
        }
    
        $email->clear(true);
    
        return $this->response->setJSON([
            'status'  => true,
            'message' => 'Feedback sent successfully'
        ]);
    }


}
