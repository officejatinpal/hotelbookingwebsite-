<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\CarouselModel;
use App\Models\GenerategiftvoucherModel;
use App\Models\BranchModel;
use App\Models\TestimonialModel;

class HomeApi extends BaseController
{
    protected $carouselModel;
        protected $generategiftvoucherModel;
    protected $branchModel;
    

    public function __construct()
    {
        $this->carouselModel = new CarouselModel();
        $this->generategiftvoucherModel = new GenerategiftvoucherModel();
        $this->branchModel = new BranchModel();
    }

    public function index()
    {
        
        $data = [
            [
                "sequence" => 0,
                "title" => "Let's Travel The World With Us Explore The World with Delvia Holidays International",
                "list" => [
                    ["image" => "slide1.jpg"],
                    ["image" => "slide2.jpg"],
                    ["image" => "slide3.jpg"],
                ],
                "path" => base_url('uploads/api/slideimg/')
            ],
            [
                "sequence" => 1,
                "title" => "Services",
                "list" => null,
                "path" => null
            ],
            [
                "sequence" => 2,
                "title" => "My Membership",
                "list" => null,
                "path" => null
            ],
            [
                "sequence" => 3,
                "title" => "Travel Associate",
                "list" => [
                    ["name" => "Make My Trip", "image_url" => base_url('asset/img/travelPartners/2.jpeg')],
                    ["name" => "Trivago",     "image_url" => base_url('asset/img/travelPartners/4.jpeg')],
                    ["name" => "Goibibo",     "image_url" => base_url('asset/img/travelPartners/1.jpeg')],
                    ["name" => "Booking.com", "image_url" => base_url('asset/img/travelPartners/5.jpeg')],
                    ["name" => "Agoda",       "image_url" => base_url('asset/img/travelPartners/3.jpeg')],
                ],
                "path" => null
            ],
            [
                "sequence" => 4,
                "title" => "What We Offer",
                "list" => [
                    ["name" => "Activities",   "image_url" => base_url('uploads/api/what_we_offer/ic_activites.svg')],
                    ["name" => "Flights",      "image_url" => base_url('uploads/api/what_we_offer/ic_flights.svg')],
                    ["name" => "Passport",     "image_url" => base_url('uploads/api/what_we_offer/ic_passport.svg')],
                    ["name" => "Sightseeing",  "image_url" => base_url('uploads/api/what_we_offer/ic_sightseeing.svg')],
                    ["name" => "Stay",         "image_url" => base_url('uploads/api/what_we_offer/ic_stay.svg')],
                ],
                "path" => null
            ],
            [
                "sequence" => 5,
                "title" => "Preferred Associate",
                "list" => [
                    ["name" => "Book My Show",        "image_url" => base_url('asset/img/preferredPartners/1.jpeg')],
                    ["name" => "Sarovar Hotels",     "image_url" => base_url('asset/img/preferredPartners/2.jpeg')],
                    ["name" => "Royal Orchid Hotels","image_url" => base_url('asset/img/preferredPartners/3.jpeg')],
                    ["name" => "Regenta Hotel",      "image_url" => base_url('asset/img/preferredPartners/4.jpeg')],
                    ["name" => "Park Inn",           "image_url" => base_url('asset/img/preferredPartners/5.jpeg')],
                ],
                "path" => null
            ],
            [
                "sequence" => 6,
                "title" => "Experience our Expertise",
                "list" => null,
                "path" => null
            ],
            [
                "sequence" => 7,
                "title" => "Media Associate",
                "list" => [
                    ["name" => "Hindustan Times",  "image_url" => base_url('asset/img/mediapartaner/1.jpg')],
                    ["name" => "Daily Hunt",       "image_url" => base_url('asset/img/mediapartaner/2.jpg')],
                    ["name" => "ANI News",         "image_url" => base_url('asset/img/mediapartaner/7.jpg')],
                    ["name" => "ABP News",         "image_url" => base_url('asset/img/mediapartaner/5.jpg')],
                    ["name" => "The Prints",       "image_url" => base_url('asset/img/mediapartaner/8.jpg')],
                    ["name" => "Zee News",          "image_url" => base_url('asset/img/mediapartaner/9.jpg')],
                ],
                "path" => null
            ],
            [
                "sequence" => 8,
                "title" => "Social Media",
                "list" => [
                    [
                        "name" => "Facebook",
                        "image_url" => base_url('uploads/api/socialmedia/ic_facebook.svg'),
                        "link" => "https://www.facebook.com/delviaholidays"
                    ],
                    [
                        "name" => "Twitter",
                        "image_url" => base_url('uploads/api/socialmedia/ic_instagram.svg'),
                        "link" => "https://www.instagram.com/delviaholidays/"
                    ],
                    [
                        "name" => "Instagram",
                        "image_url" => base_url('uploads/api/socialmedia/ic_linkedin.svg'),
                        "link" => "https://www.linkedin.com/company/delviaholidays"
                    ],
                    [
                        "name" => "Linkedin",
                        "image_url" => base_url('uploads/api/socialmedia/ic_twitter.svg'),
                        "link" => "https://x.com/delviaholidays"
                    ],
                    [
                        "name" => "Youtube",
                        "image_url" => base_url('uploads/api/socialmedia/ic_youtube.svg'),
                        "link" => "https://www.youtube.com/@delviaholidays"
                    ],
                ],
                "path" => null
            ]
        ];

        return $this->response->setJSON([
            "status" => true,
            "data"   => $data
        ]);
    }
    
        public function supportInfo()
    {
        return $this->response->setJSON([
            'status' => true,
            'data' => [
    
                'logo' => base_url('asset/img/delviaholiday-logo.svg'),
                
                'timings' => [
                    'open' => '10:30 AM',
                    'close' => '6:00 PM',
                    'holidays' => 'Monday and National Holidays'
                ],
                'office' => [
                    'title' => 'Corporate Office',
                    'address' => 'Building No. 5, Third Floor Raja Dhirsain Marg (Main Rd), Sant Nagar, East of Kailash, New Delhi, Delhi 110065'
                ],
                'call_us' => [
                    'label' => 'Customer Care (Phone)',
                    'phone' => '01135236123'
                ],
                'mail_us' => [
                    [
                        'label' => 'Customer Care',
                        'email' => 'customercare@delviaholidaysinternational.com'
                    ],
                    [
                        'label' => 'Reservation',
                        'email' => 'reservation@delviaholidaysinternational.com'
                    ],
                    
                    [
                        'label' => 'voucher',
                        'email' => 'voucher@delviaholidaysinternational.com'
                    ]
                    
                ]
            ]
        ]);
    }
    
    public function viewGiftVoucherPdf($v_num = null)
    {
        if (empty($v_num)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Voucher number is required.'
            ]);
        }
    
        $voucher = $this->generategiftvoucherModel
            ->where('v_num', $v_num)
            ->first();
    
        if (!$voucher) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Voucher not found.'
            ]);
        }
    
        if ((int)$voucher['status'] === 0) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'This voucher has already been redeemed.'
            ]);
        }
    
        $branch = $this->branchModel->find($voucher['branch_id']);
        $voucher['branch_name'] = $branch['name'] ?? 'Unknown Branch';
    
        $voucher['status_text'] = 'Active';
    
        $dompdf = new \Dompdf\Dompdf();
        $options = $dompdf->getOptions();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);
        $dompdf->setOptions($options);
    
        $html = view('backend/member_admin/voucher_pdf_template', [
            'vouchers' => [$voucher]
        ]);
    
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
    
        return $this->response
            ->setHeader('Content-Type', 'application/pdf')
            ->setHeader('Content-Disposition', 'inline; filename="voucher_' . $v_num . '.pdf"')
            ->setBody($dompdf->output());
    }

        public function ReviewsApi()
        {
            $testimonialModel = new TestimonialModel();
        
            $testimonials = $testimonialModel
                ->orderBy('id', 'DESC')
                ->findAll();
        
            foreach ($testimonials as &$row) {
            if (!empty($row['image'])) {
                    $row['image'] = base_url('uploads/review_img/' . $row['image']);
                } else {
                    $row['image'] = base_url('uploads/default.png');
                }
            }
        
            return $this->response->setJSON([
                'status' => true,
                'message' => 'Testimonials fetched successfully',
                'data' => $testimonials
            ]);
        }

    public function AboutApi()
    {
        return $this->response->setJSON([
            'status' => true,
            'message' => 'About content fetched successfully',
            'data' => [
                'about' => [
                    'heading' => 'Welcome to Delvia Holidays International',
                    'paragraphs' => [
                        'At Delvia Holidays International, we turn your travel dreams into reality. We are one of India’s most trusted travel and holiday membership companies, offering luxurious and well-planned vacation experiences at top destinations worldwide.',
                        'Our goal is simple — to make every trip memorable, comfortable, and full of joy. Whether it’s a romantic getaway, a family vacation, or a solo adventure, our expert team ensures everything is perfectly arranged for you.',
                        'With years of experience and a passion for excellence, we believe that travel is not just about reaching a destination — it’s about creating stories, discovering new cultures, and enjoying every moment with complete peace of mind.'
                    ]
                ],
                'why_us' => [
                    'title' => 'Why Delvia Holidays International?',
                    'description' => 'Delvia Holidays International is the best travel partner for an extraordinary vacation on a premium destination. With our mission set in being a first-class travel and tour firm, we pride ourselves in providing unique travel experiences to suit every member’s taste.',
                    'points' => [
                        'First-Class Flights',
                        'Handpicked Hotels',
                        '4 to 5-Star Accommodations',
                        'Latest Model Vehicles',
                        '150 Premium City Tours',
                        '24/7 Assistance'
                    ]
                ],
                'memberships' => 'Our holiday membership gives you access to handpicked hotels, premium resorts, and personalized travel assistance — anytime, anywhere.',
                'mission' => 'To redefine luxury travel by offering personalized services, global destinations, and unmatched comfort for every traveler.',
                'vision' => 'To become the leading holiday membership company in India, making luxury travel accessible and enjoyable for everyone.',
                'cta' => 'Start your journey with us and turn your travel dreams into reality.'
            ]
        ]);
    }
    
      public function BenefitMembership()
    {
        return $this->response->setJSON([
            'status' => true,
            'message' => 'Membership content fetched successfully',
            'data' => [
                'heading' => 'Delvia Holidays International Membership',
                'paragraph' => 'Our membership gives you access to luxury resorts, personalized holiday planning, guaranteed stays, and exclusive member-only benefits to make every vacation memorable.',

                'cards' => [
                    [
                        'front' => base_url('asset/img/membershipcard/purple-card-front.png'),
                        'back'  => base_url('asset/img/membershipcard/purple-card-back.png'),
                    ],
                    [
                        'front' => base_url('asset/img/membershipcard/red-card-front.png'),
                        'back'  => base_url('asset/img/membershipcard/red-card-back.png'),
                    ],
                    [
                        'front' => base_url('asset/img/membershipcard/white-card-front.png'),
                        'back'  => base_url('asset/img/membershipcard/white-card-back.png'),
                    ],
                    [
                        'front' => base_url('asset/img/membershipcard/blue-card-front.png'),
                        'back'  => base_url('asset/img/membershipcard/blue-card-back.png'),
                    ],
                ],

                'faqs' => [
                    [
                        'question' => "What is Delvia Holidays International's Membership?",
                        'answer'   => "It is a unique travel program that lets you enjoy luxury vacations every year without paying high hotel prices."
                    ],
                    [
                        'question' => "What benefits do members get?",
                        'answer'   => "Members enjoy exclusive access to luxury resorts, personalized holiday planning, guaranteed stays, and member-only deals."
                    ],
                    [
                        'question' => "Can my family or friends use my membership?",
                        'answer'   => "Yes, you can allow your family or friends to use your membership anytime."
                    ],
                    [
                        'question' => "Are there any hidden fees?",
                        'answer'   => "No. All charges are transparently shared before booking."
                    ],
                    [
                        'question' => "Can I cancel my membership?",
                        'answer'   => "Yes, you may cancel anytime as per our cancellation policy."
                    ],
                    [
                        'question' => "How to sign up?",
                        'answer'   => "You can join by visiting our website or contacting support."
                    ],
                    [
                        'question' => "What is the AMC Charges?",
                        'answer'   => "T1 Standard Room: Rs. 10500, T2 Suite Room: Rs. 14500"
                    ]
                ]
            ]
        ]);
    }
    
    public function enquiryApi()
    {
        $data = $this->request->getJSON(true);

        if (
            empty($data['name']) ||
            empty($data['mobile']) ||
            empty($data['email']) ||
            empty($data['location']) ||
            empty($data['terms'])
        ) {
            return $this->response->setJSON([
                'status' => false,
                'message' => 'All fields are required'
            ]);
        }

        $email = \Config\Services::email();
        $email->setFrom('no-reply@delviaholidaysinternational.com', 'Delvia Holidays International');
        $email->setTo('info@delviaholidaysinternational.com'); 
        
        $email->setSubject('New Offer Enquiry');
        $email->setMailType('html');

        $message = "
             Dear DHI Team,
        
            <p>I {$data['name']} looking for membership and my details are given below :</p>
            
            <p><strong>Name:</strong> {$data['name']}</p>
            <p><strong>Mobile:</strong> {$data['mobile']}</p>
            <p><strong>Email:</strong> {$data['email']}</p>
            <p><strong>Location:</strong> {$data['location']}</p>
            
          Regards
          {$data['name']}

        ";

        $email->setMessage($message);

        if ($email->send()) {
            return $this->response->setJSON([
                'status' => true,
                'message' => 'Submitted successfully'
            ]);
        } else {
            return $this->response->setJSON([
                'status' => false,
                'message' => 'Email not sent'
            ]);
        }
    }

}
