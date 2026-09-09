<?php

namespace App\Controllers;

use App\Models\ContactModel;
use CodeIgniter\HTTP\ResponseInterface;

class Contact extends BaseController
{
    // Show contact page
    public function contact()
    {
        return view('contact');
    }

    // Handle form submission
    public function addContact(): ResponseInterface
    {
        $contactModel = new ContactModel();

        $name     = $this->request->getPost('name');
        $email    = $this->request->getPost('email');
        $subject  = $this->request->getPost('subject');
        $message  = $this->request->getPost('message');
        $ip       = $this->request->getIPAddress();
        $recaptchaResponse = $this->request->getPost('g-recaptcha-response');

        // 1️⃣ Check reCAPTCHA
        if (empty($recaptchaResponse)) {
            return $this->response->setJSON([
                'status' => 'captcha_error',
                'message' => 'Please complete the captcha.'
            ]);
        }

        $secretKey = '6Ld_tS8rAAAAAGO0GZNQvAW4Zpt5j-t9lVW7jWjZ';
        $client = \Config\Services::curlrequest();

        try {
            $response = $client->post('https://www.google.com/recaptcha/api/siteverify', [
                'form_params' => [
                    'secret'   => $secretKey,
                    'response' => $recaptchaResponse,
                ],
            ]);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Captcha verification failed.'
            ]);
        }

        $result = json_decode($response->getBody());
        if (!$result->success) {
            return $this->response->setJSON([
                'status' => 'captcha_error',
                'message' => 'Captcha verification failed.'
            ]);
        }

        // 2️⃣ Validate fields
        if (empty($name) || empty($email) || empty($subject) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'All fields are required and email must be valid.'
            ]);
        }

        // 3️⃣ Insert into database
        try {
            $contactModel->insert([
                'name'      => $name,
                'email'     => $email,
                'subject'   => $subject,
                'message'   => $message,
                'ipaddress' => $ip,
            ]);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Database error: ' . $e->getMessage()
            ]);
        }

        // 4️⃣ Send email using localhost SMTP
        $emailService = \Config\Services::email();
        $emailService->setFrom('info@delviaholidaysinternational.com', 'Delvia Holidays');
        $emailService->setTo('info@delviaholidaysinternational.com');
        $emailService->setSubject($subject . ' - ' . uniqid());
        $emailService->setMessage("
            <html>
            <head><title>New Contact Enquiry</title></head>
            <body>
                <h2>New Contact Enquiry</h2>
                <p><strong>Name:</strong> {$name}</p>
                <p><strong>Email:</strong> {$email}</p>
                <p><strong>Subject:</strong> {$subject}</p>
                <p><strong>Message:</strong><br>{$message}</p>
                <p><strong>IP Address:</strong> {$ip}</p>
            </body>
            </html>
        ");
        $emailService->setMailType('html');

        if ($emailService->send()) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Your message has been sent successfully.'
            ]);
        } else {
            log_message('error', 'Email Error: ' . $emailService->printDebugger(['headers']));
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Failed to send the email. Please try again later.'
            ]);
        }
    }
}
