<?php

use CodeIgniter\Router\RouteCollection;

    $routes->get('/', 'Home::index');
    $routes->get('/about', 'About::about');
    $routes->get('/services', 'Services::services');
    $routes->get('/blogs', 'Blog::index');
    $routes->get('/booking', 'Booking::booking');
    $routes->get('/contact', 'Contact::Contact');
    $routes->post('/add-contact', 'Contact::addContact');
    $routes->post('/add-booking', 'Booking::addbooking');
    $routes->get('/gallery', 'Gallery::index'); 
    $routes->get('/bangalore', 'Bengaluru::Bengaluru');
    $routes->get('/delvia-holidays-international-bangalore-reviews', 'Bengaluru::BengaluruReview');
    $routes->get('/scan', 'Home::scanner');
    $routes->get('chatbot', 'Home::chatbot');
    $routes->post('chatbot/getResponse', 'Chatbot::getResponse');
    $routes->get(
        'destination/(:segment)/(:segment)/([a-z0-9]+(?:-[a-z0-9]+)*)',
        'DestinationController::city/$1/$2/$3'
    );
    
    $routes->get('property/(:any)', 'DestinationController::gallaryimage/$1'); 
    $routes->get('/membership', 'Membership::membership');
    $routes->get('/refund-policy', 'ReturnPolicy::Return');
    $routes->get('/holiday-packages', 'Packages::packages');
    $routes->get('/term-and-condition', 'TermController::Term');
    $routes->get('/privacy-policy', 'PrivacyController::Privacy');
    $routes->get('packages/view/(:segment)', 'Packages::view/$1');
    $routes->get('blog/(:segment)', 'Blog::view/$1');
    $routes->get('/travel-desk', 'TravelDeskController::index');
    $routes->get('desk/(:segment)', 'TravelDeskController::view/$1');
    $routes->get('/vouchers', 'VoucherController::index');
    $routes->get('video-reviews', 'TestimonialController::VideoReview'); 
    $routes->get('/reviews', 'TestimonialController::index'); 
    $routes->get('destination/(:segment)', 'Home::short/$1'); //redirecting
    
    $routes->get('/international', 'International::index');
    $routes->get('/domestic', 'Domestic::Index');
    $routes->post('destination/filterByCity', 'Domestic::filterByCity');
    $routes->post('international-destination/filterByCity', 'International::filterByCity');
    
    $routes->get('payment', 'PaymentController::index');        
    $routes->post('payment/process', 'PaymentController::process');
    $routes->get('payment/ccavenue', 'PaymentCcavenue::checkout');
    
    $routes->get('razorpay/checkout', 'PaymentRazorpay::checkout');
    $routes->get('payment/success', 'PaymentRazorpay::success');
    $routes->get('payment/failure', 'PaymentRazorpay::failure');
    
    $routes->get('cashfree/checkout', 'PaymentCashfree::checkout');
    $routes->match(['get', 'post'], 'cashfree/success', 'PaymentCashfree::success');
    
    $routes->get('payu/checkout', 'PaymentPayu::checkout');
    $routes->match(['get','post'], 'payu/success', 'PaymentPayu::success');
    $routes->match(['get','post'], 'payu/failure', 'PaymentPayu::failure');


    //memberlogin
    $routes->get('/login', 'Login::index');
    $routes->post('/login', 'Login::authenticate');
    
    $routes->group('member', ['filter' => 'memauth'], function ($routes) {
        $routes->get('logout', 'Login::logout');
        $routes->get('profile', 'Login::Datashow');
        $routes->get('holidays', 'Login::holidays');
        $routes->get('amc', 'Login::amcPayments');
        $routes->get('fee', 'Login::holidayPayments');
        $routes->get('offers', 'Login::offermember');
        $routes->get('change_password', 'Login::changePasswordForm');
        $routes->post('change-password', 'Login::updatePassword');
        $routes->get('documents', 'Login::viewMemberDocument');
    
    });

    //employeelogin
        $routes->post('/employeel/data', 'backend\EmployeeLogin::login');
        $routes->get('/employeelogin/logout', 'backend\EmployeeLogin::logout');
        $routes->group('employee', ['filter' => 'employeeauth'], function ($routes) {
        $routes->get('dashboard', 'backend\EmployeeLogin::employeeprofile');
        $routes->get('change_password', 'backend\EmployeeLogin::changepassword');
        $routes->post('update_password', 'backend\EmployeeLogin::update_password');
        $routes->get('mark_attendance_view', 'backend\EmployeeLogin::markAttendance', ['as' => 'mark_attendance_view']);
        $routes->get('attendance', 'backend\EmployeeLogin::attendance');
        $routes->get('salary', 'backend\EmployeeLogin::salaryslip');
    });


    //officialpagelogin
    $routes->get('/official', 'backend\AuthController::index');
    $routes->post('/official', 'backend\AuthController::login');
    $routes->get('/official/logout', 'backend\AuthController::logout');
    
    //Memberadmin
    $routes->get('/add_member', 'backend\MemberadminController::dashboard');
    $routes->get('/all-member', 'backend\MemberadminController::allmember');
    $routes->post('user/updateStatus', 'backend\MemberadminController::updateStatus');
    $routes->post('/user/deleteUser', 'backend\MemberadminController::deleteUser');
    $routes->post('/yourcontroller/store', 'backend\MemberadminController::store'); 
    $routes->get('member-edit/(:any)', 'backend\MemberadminController::edit/$1');
    $routes->post('/yourcontroller/update/(:num)', 'backend\MemberadminController::update/$1'); 
    $routes->get('/yourcontroller/delete/(:num)', 'backend\MemberadminController::delete/$1'); 
    $routes->get('/member/getBranchesBySubsidiary/(:num)', 'backend\MemberadminController::getBranchesBySubsidiary/$1');
    $routes->get('/getBranchesBySub/(:num)', 'backend\MemberadminController::getBranchesBySub/$1');
    $routes->get('/getmembersByBra/(:num)', 'backend\MemberadminController::getmembersByBra/$1');
    
    //searchmember
    $routes->get('/search_member', 'backend\MemberadminController::searchmember');
    $routes->post('user/searchmembervalue', 'backend\MemberadminController::searchmembervalue');
    
    //offer
    $routes->get('/add-offers/(:any)', 'backend\MemberadminController::addoffer/$1');
    $routes->get('/member-offers/(:any)', 'backend\MemberadminController::memberoffers/$1');
    $routes->get('offer/delete/(:any)', 'backend\MemberadminController::deleteMemberOffer/$1');
    $routes->post('storedataoffer', 'backend\MemberadminController::storedataoffer');
    $routes->post('bookoffer', 'backend\MemberadminController::bookOffer');
    $routes->get('generate-voucher/(:any)', 'backend\MemberadminController::generateconformvoucher/$1');
    $routes->get('view-voucher/(:any)', 'backend\MemberadminController::viewvoucher/$1');
    $routes->get('download-voucher/(:any)', 'backend\MemberadminController::downloadVoucher/$1');
    $routes->post('storevoucher', 'backend\MemberadminController::storevoucher');
    $routes->get('edit-voucher/(:any)', 'backend\MemberadminController::editgenerateconformvoucher/$1');
    $routes->post('update-voucher/(:num)', 'backend\MemberadminController::updateVoucher/$1');
    
    //holidays
    $routes->get('/add-holiday/(:any)', 'backend\MemberadminController::addHoliday/$1');
    $routes->get('holiday-delete/(:any)', 'backend\MemberadminController::deleteHoliday/$1');
    $routes->post('/store-holiday', 'backend\MemberadminController::storeholiday');
    $routes->get('view-holiday/(:any)', 'backend\MemberadminController::viewmanageHoliday/$1');
    $routes->post('bookholiday', 'backend\MemberadminController::bookHoliday');
    $routes->get('holiday-generate-voucher/(:any)', 'backend\MemberadminController::holidaygenerateconformvoucher/$1');
    $routes->get('holiday-view-voucher/(:any)', 'backend\MemberadminController::holidayviewVoucher/$1');
    $routes->get('holiday-download-voucher/(:any)', 'backend\MemberadminController::holidaydownloadVoucher/$1');
    $routes->post('holidaystorevoucher', 'backend\MemberadminController::holidaystorevoucher');
    $routes->get('holiday-edit-voucher/(:any)', 'backend\MemberadminController::holidayeditgenerateconformvoucher/$1');
    $routes->post('holidayupdateVoucher', 'backend\MemberadminController::updateHolidayVoucher');
    $routes->post('holiday/voucher/update/(:num)', 'backend\MemberadminController::updateHolidayVoucher/$1');
    $routes->post('hotel/getResortsByDestination', 'backend\MemberadminController::getResortsByDestination');
    
    //gifvoucher
    $routes->get('/generate_voucher', 'backend\MemberadminController::generategiftvoucher');
    $routes->post('/store_generate_voucher', 'backend\MemberadminController::Giftvoucherstore');
    $routes->get('/search-voucher', 'backend\MemberadminController::searchgifvoucher');
    $routes->get('invitation-view-voucher/(:any)', 'backend\MemberadminController::Giftviewvoucher/$1');
    $routes->post('voucher/searchVouchers', 'backend\MemberadminController::searchgiftvouchervalue');
    $routes->post('voucher/changeStatus', 'backend\MemberadminController::changegiftvoucherstatus');
    $routes->post('voucher/sendVoucherEmail', 'backend\MemberadminController::sendgiftvoucheremail');
    $routes->get('edit-gift-voucher/(:any)', 'backend\MemberadminController::editGiftVoucher/$1');
    $routes->post('update_gift_voucher/(:num)', 'backend\MemberadminController::update_gift_voucher/$1');
    $routes->get('getMemberDetails/(:any)', 'backend\MemberadminController::getMemberDetails/$1');
    
    //inoice
    $routes->get('/search_invoice', 'backend\MemberadminController::searchinvoice');
    $routes->post('invoice/search', 'backend\MemberadminController::searchInvoicevalue');
    $routes->post('invoice/search-by-date', 'backend\MemberadminController::searchInvoiceByDate');
    $routes->post('invoiceDataFrom', 'backend\MemberadminController::saveDataFrom');
    $routes->get('view-invoice/(:num)', 'backend\MemberadminController::viewinvoice/$1');
    $routes->get('send-invoice/(:num)', 'backend\MemberadminController::SendInvoiceEmailPdf/$1');
    $routes->get('invoice/editData/(:num)', 'backend\MemberadminController::editDatainvoice/$1');
    $routes->post('invoice/updateData/(:num)', 'backend\MemberadminController::updateDatainvoice/$1');
    $routes->get('generate-invoice/(:any)', 'backend\MemberadminController::generateinvoice/$1');
    $routes->get('/getBranchesSub/(:num)', 'backend\MemberadminController::getBranchesSub/$1');
    $routes->get('/getmembersBrand/(:num)', 'backend\MemberadminController::getmembersBra/$1');
    
    //document
    $routes->get('add-document/(:any)', 'backend\MemberadminController::addmemberdocument/$1');
    $routes->post('member/store-document', 'backend\MemberadminController::storeDocument');
    $routes->get('member/delete-document/(:any)', 'backend\MemberadminController::deleteDocument/$1');
    $routes->get('add-comment/(:any)', 'backend\MemberadminController::addmembercomment/$1');
    $routes->post('member/storecomment', 'backend\MemberadminController::storecomment');
    $routes->get('member/deletecomment/(:any)', 'backend\MemberadminController::deletecomment/$1');


    $routes->group('webmaster', function($routes) {

    // propertyadmin
    $routes->get('add_resort', 'backend\PropertyadminController::addResort');
    $routes->post('property_admin/store', 'backend\PropertyadminController::resortstore');
    $routes->get('edit_resort/(:num)', 'backend\PropertyadminController::editResort/$1');
    $routes->post('update/(:num)', 'backend\PropertyadminController::updateresort/$1');
    $routes->post('getCitiesByCategory', 'backend\PropertyadminController::getCitiesByCategory');

    $routes->get('add_destination', 'backend\PropertyadminController::adddestinations');
    $routes->post('submit/add_destinationt', 'backend\PropertyadminController::storeDestination');
    $routes->get('all_destination', 'backend\PropertyadminController::alldestination');
    $routes->get('destination/edit/(:num)', 'backend\PropertyadminController::editalldestination/$1');
    $routes->post('destination/update', 'backend\PropertyadminController::updatealldestination');
    $routes->post('destination/update/(:num)', 'backend\PropertyadminController::update_destinationdetail/$1');
    $routes->post('destination/insert', 'backend\PropertyadminController::insert_destinationdetails');
    $routes->post('destination/searchDestination', 'backend\PropertyadminController::searchdestination');
    $routes->post('destination/toggleStatus', 'backend\PropertyadminController::toggleStatus');
    $routes->get('destination/details/(:any)', 'backend\PropertyadminController::show/$1');

    $routes->get('all_resort', 'backend\PropertyadminController::AllResorts');
    $routes->post('toggleStatus/(:num)', 'backend\PropertyadminController::AllResortsStatus/$1');

    $routes->get('add-blog', 'backend\PropertyadminController::addblog');
    $routes->post('blogstore', 'backend\PropertyadminController::blogstore');
    $routes->get('view-blog', 'backend\PropertyadminController::viewblog');
    $routes->post('viewstatus', 'backend\PropertyadminController::blogStatus');
    $routes->get('blog/edit/(:num)', 'backend\PropertyadminController::blogEdit/$1');
    $routes->post('blogupdate/(:num)', 'backend\PropertyadminController::blogUpdate/$1');

    $routes->get('add-package', 'backend\PropertyadminController::addpackage');
    $routes->post('packagestore', 'backend\PropertyadminController::packagestore');
    $routes->get('view-package', 'backend\PropertyadminController::viewpackage');
    $routes->post('packagestatus', 'backend\PropertyadminController::packageStatus');

    $routes->get('add-desk', 'backend\PropertyadminController::adddesk');
    $routes->post('deskstore', 'backend\PropertyadminController::deskstore');
    $routes->get('view-desk', 'backend\PropertyadminController::viewdesk');
    $routes->post('viewsdeskstatus', 'backend\PropertyadminController::diskStatus');
    $routes->get('desk/edit/(:num)', 'backend\PropertyadminController::deskEdit/$1');
    $routes->post('deskupdate/(:num)', 'backend\PropertyadminController::deskUpdate/$1');

    $routes->get('pagevoucher', 'backend\PropertyadminController::addpagevoucher');
    $routes->post('pagevoucher', 'backend\PropertyadminController::pagevouchertore');
    
    $routes->post('save-video', 'backend\PropertyadminController::saveVideo');
    $routes->get('add-video', 'backend\PropertyadminController::addvideo');

    $routes->get('add-testimonial', 'backend\PropertyadminController::testadd'); 
    $routes->post('testimonial/store', 'backend\PropertyadminController::teststore');
    $routes->get('view-reviews', 'backend\PropertyadminController::viewReview');
    $routes->get('edit/(:num)', 'backend\PropertyadminController::editReview/$1');
    $routes->post('testimonial/update/(:num)', 'backend\PropertyadminController::updatereview/$1');
    $routes->get('testimonial/delete/(:num)', 'backend\PropertyadminController::deletereview/$1');
    
    $routes->get('add-gallery', 'backend\PropertyadminController::galleryadd');
    $routes->get('gallery', 'backend\PropertyadminController::gallery');
    $routes->post('gallery/store', 'backend\PropertyadminController::galleryStore'); 

    $routes->get('add-slide-img', 'backend\PropertyadminController::addslideimg');
    $routes->post('store', 'backend\PropertyadminController::storeslideimg');
    $routes->get('slideviews', 'backend\PropertyadminController::slideview');
    $routes->get('carousel/delete/(:num)', 'backend\PropertyadminController::deleteslideimg/$1');
    
    $routes->get('chatbot', 'backend\ChatbotAdmin::index');
    $routes->get('chatbot/create', 'backend\ChatbotAdmin::create');
    $routes->post('chatbot/store', 'backend\ChatbotAdmin::store');
    $routes->get('chatbot/edit/(:num)', 'backend\ChatbotAdmin::edit/$1');
    $routes->post('chatbot/update/(:num)', 'backend\ChatbotAdmin::update/$1');
    $routes->get('chatbot/delete/(:num)', 'backend\ChatbotAdmin::delete/$1');


});
    
    //employeeadmin
    $routes->get('/backend/employee_admin/all_employee', 'backend\EmployeeadminController::dashboard');
    $routes->get('/employee/register', 'backend\EmployeeadminController::index');
    $routes->post('/employee/getBranches', 'backend\EmployeeadminController::getBranches');
    $routes->post('/employee/getDepartments', 'backend\EmployeeadminController::getDepartments');
    $routes->post('/employee/getDesignations', 'backend\EmployeeadminController::getDesignations');
    $routes->post('/employee/register', 'backend\EmployeeadminController::registerEmployee');
    $routes->post('/employee/toggleStatus/(:num)', 'backend\EmployeeadminController::toggleStatus/$1');
    $routes->get('employee/edit/(:num)', 'backend\EmployeeadminController::editEmployee/$1'); 
    $routes->post('employee/update/(:num)', 'backend\EmployeeadminController::updateEmployee/$1'); 
    
    $routes->post('employee/attendence_search', 'backend\EmployeeadminController::attendence_search');
    $routes->post('employee/attendance_success', 'backend\EmployeeadminController::attendance_success');
    $routes->get('/employee/employeesAttendance', 'backend\EmployeeadminController::allttendance');
    $routes->get('/employee/attendence_search', 'backend\EmployeeadminController::allattendence_search');
    $routes->post('employee/salary_search', 'backend\EmployeeadminController::salary_search');
    
    $routes->get('employee/generate_emp_salary/(:any)', 'backend\EmployeeadminController::generate_emp_salary/$1');
    $routes->post('employee/generate_emp_salary_process', 'backend\EmployeeadminController::generate_emp_salary_process');
    
    $routes->get('employee/all-generated-salary-slip/(:any)', 'backend\EmployeeadminController::GenerateviewSalaries/$1');
    
    $routes->get('salary/edit/(:num)', 'backend\EmployeeadminController::allsalaryedit/$1');
    
    $routes->post('salary/update/(:num)', 'backend\EmployeeadminController::allsalaryupdate/$1');
    $routes->get('salary/view_pdf/(:segment)', 'backend\EmployeeadminController::view_pdf/$1');
    $routes->get('salary/download_pdf/(:segment)', 'backend\EmployeeadminController::download_pdf/$1');
    $routes->post('employee/add_multiple_branches', 'backend\EmployeeadminController::addMultipleBranches');
    $routes->get('employee/add-branch-name', 'backend\EmployeeadminController::AddBranches');
    $routes->post('employee/add_multiple_department', 'backend\EmployeeadminController::addMultipledepartment');
    $routes->get('employee/add-department-name', 'backend\EmployeeadminController::AddDepartment');
    $routes->post('employee/add_multiple_designation', 'backend\EmployeeadminController::addMultipleDesignation');
    $routes->get('employee/add-designation-name', 'backend\EmployeeadminController::AddDesignation');
    
    
    $routes->set404Override(function () {
        return view('error_404');
    });
    
    
    //api_Start
    $routes->group('api', ['filter' => 'apiauth'], function($routes) {
        
         // Razorpay
        $routes->post('create-order', 'Api\RazorpayApi::createOrder');
        $routes->post('verify-payment', 'Api\RazorpayApi::verify');
        
        // Cashfree
        $routes->post('cashfree/create-order', 'Api\CashfreeApi::createOrder');
        $routes->post('cashfree/verify-payment', 'Api\CashfreeApi::verifyPayment');
    });

    $routes->group('api', function($routes) {
    
    /* ========= MEMBER ========= */
    $routes->post('login', 'Api\LoginApi::login');
    $routes->get('profile', 'Api\LoginApi::profile');
    $routes->get('documents', 'Api\LoginApi::documents');
    $routes->get('holidays', 'Api\LoginApi::holidays');
    $routes->get('offers', 'Api\LoginApi::offers');
    $routes->get('amc-payments', 'Api\LoginApi::amcPayments');
    $routes->get('holiday-payments', 'Api\LoginApi::holidayPayments');
    $routes->post('change-password', 'Api\LoginApi::changePassword');
    $routes->match(['get', 'post'], 'holiday/enquiry', 'Api\LoginApi::booking');
    $routes->post('offer/enquiry', 'Api\LoginApi::offerEnquiry');
    $routes->post('member/feedback', 'Api\LoginApi::memberFeedback');
    $routes->get('member/mytrips/(:segment)', 'Api\LoginApi::myTrips/$1');
    
    /* ========= Destinations ========= */
    $routes->get('destination/search-resorts', 'Api\DestinationApi::searchResorts');
    $routes->get('destination/resort-details/(:num)', 'Api\DestinationApi::resortDetailApi/$1');
    $routes->get('destination/resorts/(:segment)', 'Api\DestinationApi::resortsApi/$1');
    $routes->get('destination/(domestic|international)', 'Api\DestinationApi::category/$1');

    $routes->get('home', 'Api\HomeApi::index');
    $routes->get('supportInfo', 'Api\HomeApi::supportInfo');
    $routes->get('voucher/gift/pdf/(:segment)', 'Api\HomeApi::viewGiftVoucherPdf/$1');
    $routes->get('feedback', 'Api\HomeApi::ReviewsApi');
    $routes->get('about', 'Api\HomeApi::AboutApi');
    $routes->get('benefits', 'Api\HomeApi::BenefitMembership');
    $routes->post('enquiry', 'Api\HomeApi::enquiryApi');
    
});


