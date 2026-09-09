<?php

namespace App\Controllers;

use App\Models\BookingModel;

class Booking extends BaseController
{
    public function booking(): string
    {
        return view('booking');
    }

    public function addbooking()
    {
        $bookingModel = new BookingModel();

        $name        = $this->request->getPost('name');
        $email       = $this->request->getPost('email');
        $datetime    = $this->request->getPost('datetime');
        $destination = $this->request->getPost('destination');
        $persons     = $this->request->getPost('persons');
        $category    = $this->request->getPost('kids');
        $message     = $this->request->getPost('message');
        $ipaddress   = $this->request->getIPAddress();
        $recaptchaResponse = $this->request->getPost('g-recaptcha-response');

        // Check reCAPTCHA
        if (empty($recaptchaResponse)) {
            return $this->response->setJSON([
                'status' => 'captcha_error',
                'message' => 'Please complete the captcha.'
            ]);
        }

        $secretKey = '6Ld_tS8rAAAAAGO0GZNQvAW4Zpt5j-t9lVW7jWjZ'; // Your reCAPTCHA secret

        $client = \Config\Services::curlrequest();
        $response = $client->post('https://www.google.com/recaptcha/api/siteverify', [
            'form_params' => [
                'secret'   => $secretKey,
                'response' => $recaptchaResponse,
                'remoteip' => $ipaddress,
            ],
        ]);

        $result = json_decode($response->getBody());

        if (!$result->success) {
            return $this->response->setJSON([
                'status' => 'captcha_error',
                'message' => 'Captcha verification failed. Please try again.'
            ]);
        }

        // Validate fields
        if (empty($name) || empty($email) || empty($datetime) || empty($destination) || empty($persons) || empty($category)) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'All fields are required.'
            ]);
        }

        // Insert into DB
        $data = [
            'name'        => $name,
            'email'       => $email,
            'datetime'    => $datetime,
            'destination' => $destination,
            'persons'     => $persons,
            'category'    => $category,
            'message'     => $message,
            'ipaddress'   => $ipaddress,
        ];

        try {
            $bookingModel->insertBooking($data);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Database error: ' . $e->getMessage()
            ]);
        }

        // Prepare and send email
        $emailService = \Config\Services::email();

        $emailService->setFrom('info@delviaholidaysinternational.com', 'Delvia Holidays International');
        $emailService->setTo('reservation@delviaholidaysinternational.com');
        $emailService->setSubject('New Booking : ' . uniqid()); // Add a unique ID to the subject

        $emailContent = "
            <html>
            <head><title>New Booking</title></head>
            <body>
                <h2>New Booking Received</h2>
                <p><strong>Name:</strong> {$name}</p>
                <p><strong>Email:</strong> {$email}</p>
                <p><strong>Date & Time:</strong> {$datetime}</p>
                <p><strong>Destination:</strong> {$destination}</p>
                <p><strong>Persons:</strong> {$persons}</p>
                <p><strong>Kids:</strong> {$category}</p>
                <p><strong>Message:</strong><br>{$message}</p>
                <p><strong>IP Address:</strong> {$ipaddress}</p>
            </body>
            </html>
        ";

        $emailService->setMessage($emailContent);
        $emailService->setMailType('html');

        // Ensure each email has a unique message ID and no threading references
        $uniqueMessageId = '<' . uniqid() . '@delviaholidaysinternational.com>';
        $emailService->setHeader('Message-ID', $uniqueMessageId);
        $emailService->setHeader('References', '');
        $emailService->setHeader('In-Reply-To', '');
        $emailService->setHeader('X-Mailer', 'PHP/' . phpversion());

        if ($emailService->send()) {
            $emailService->clear();

            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Your booking has been submitted successfully.'
            ]);
        } else {
            log_message('error', 'Email Error: ' . $emailService->printDebugger(['headers', 'subject', 'body']));
            $emailService->clear();

            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Failed to send the booking email. Please try again later.'
            ]);
        }
    }
}
