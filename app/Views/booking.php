   <?php
$description = "Book your next holiday with Delvia Holidays International. Easy reservations, premium resorts, and stress-free travel experiences at your fingertips.";
include 'header.php';
?>
<!-- Tour Booking Start -->
<div class="container-fluid booking py-5">
    <div class="container py-5">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6">
                <h5 class="section-booking-title pe-3">Booking</h5>
                <h1 class="text-white mb-4">Online Booking</h1>
                <p class="text-white mb-4">Delvia Holidays International makes online booking effortless and convenient. Whether you're planning a relaxing getaway, an adventurous tour, or a luxurious stay, our platform offers a seamless experience. Explore worldwide destinations, choose from top-rated hotels, and customize your travel packages to suit your needs. With just a few clicks, secure your reservations hassle-free and enjoy exclusive deals.</p>
                <p class="text-white mb-4">From hotel reservations to transportation and event management, we handle every detail to ensure a stress-free journey. Our user-friendly system provides instant confirmations, reliable customer support, and flexible options. Book now with Delvia Holidays International and embark on unforgettable travel experiences!</p>
            </div>

            <div class="col-lg-6">
                <h1 class="text-white mb-3">Book Tour Deals or Hotels</h1>
                <p class="text-white mb-4">Get <span class="text-warning">20% Off</span> On Your First Adventure Trip With Us. Get More Deal Offers Here.</p>
                
                <!-- Feedback area -->
               <div id="formFeedback" style="display:none;"></div>

                <!-- Booking Form -->
                <form id="bookingForm" method="post" data-action="<?= base_url('/add-booking'); ?>">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control bg-white border-0" id="name" name="name" placeholder="Your Name *" required>
                                <label for="name">Your Name</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="email" class="form-control bg-white border-0" id="email" name="email" placeholder="Your Email" required>
                                <label for="email">Your Email</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating date" id="date3" data-target-input="nearest">
                                <input type="date" class="form-control bg-white border-0" id="datetime" name="datetime" placeholder="Date & Time" data-target="#date3" data-toggle="datetimepicker" required />
                                <label for="datetime">Date & Time</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control bg-white border-0" id="destination" name="destination" placeholder="Destination" required>
                                <label for="destination">Destination</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-select bg-white border-0" id="SelectPerson" name="persons" required>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="8">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="above 9">Above 9</option>
                                </select>
                                <label for="SelectPerson">Persons</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <select class="form-select bg-white border-0" id="CategoriesSelect" name="kids" required>
                                    <option value="nokids">optional</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="above 5">Above 5</option>
                                </select>
                                <label for="CategoriesSelect">Kids</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <textarea class="form-control bg-white border-0" placeholder="Special Request" id="message" name="message" style="height: 100px"></textarea>
                                <label for="message">Special Request</label>
                            </div>
                        </div>

                        <div class="g-recaptcha" data-sitekey="6Ld_tS8rAAAAAF1ZvL8jfFiIvhknzKG39Xe2mzaM"></div>

                        <div id="captchaError" style="color: red; margin-top: 5px;"></div>

                        <div class="col-12">
                            <button class="btn btn-primary text-white w-100 py-3" type="submit">Book Now</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Tour Booking End -->


<?php include "footer.php" ?>
