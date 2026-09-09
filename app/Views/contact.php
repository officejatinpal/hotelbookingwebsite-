<?php include "header.php" ?>



<!-- Contact Start -->
<div class="container-fluid contact bg-light py-5">
    <div class="container py-5">
        <div class="mx-auto text-center mb-5" style="max-width: 900px;">
            <h5 class="section-title px-3">Contact Us</h5>


            
            <h1 class="mb-0">Contact For Any Query</h1>
        </div>
        <div class="row g-5 align-items-center">
            <div class="col-lg-4">
                <!-- Contact Info -->
                <div class="contact-info-card bg-white rounded">
                    <div class="text-center mb-4">
                        <i class="fa fa-map-marker-alt fa-3x"></i>
                        <h4>Address</h4>
                        <p class="mb-0">Building No. 5, Third Floor Raja Dhirsain Marg, Main Rd <br>  Sant Nagar, East of Kailash, New Delhi, Delhi 110065</p>
                    </div>
                    <div class="text-center mb-4">
                        <i class="fa fa-phone-alt fa-3x mb-3"></i>
                        <h4>Mobile</h4>
                        <a class="mb-0" href="tel:01135236123">011 3523 6123</a><br>
                        <a class="mb-0" href="tel:01141633722">011 4163 3722</a>
                    </div>
                    <div class="text-center">
                        <i class="fa fa-envelope-open fa-3x mb-3"></i>
                        <h4>Email</h4>
                        <a class="mb-0" href="mailto:info@delviaholidaysinternational.com">info@delviaholidaysinternational.com</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <h3 class="mb-2">Send us a message</h3>
                <p class="mb-4 text-muted">We are here to ensure that you have the best travel experience by planning for you. If you have questions about your holiday planning, a query about the services we offer or help required with a booking or for creating your perfect holiday, don’t hesitate to reach out to us. Please feel free to contact us at any time, and your questions will be answered as soon as possible.</p>

                <!-- Feedback message area -->
                <div id="formFeedback" style="display:none;"></div>

                <!-- Contact Form -->
                <form id="contactForm" method="post">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Your Name *" required>
                                <label for="name">Your Name</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="email" class="form-control" id="email" name="email" placeholder="Your Email *" required>
                                <label for="email">Your Email</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject" required>
                                <label for="subject">Subject</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <textarea class="form-control" placeholder="Leave a message here" name="message" id="message" style="height: 160px" required></textarea>
                                <label for="message">Message</label>
                            </div>
                        </div>
                        <div class="g-recaptcha" data-sitekey="6Ld_tS8rAAAAAF1ZvL8jfFiIvhknzKG39Xe2mzaM"></div>
                        <div id="captchaError" style="color: red; margin-top: 5px;"></div>
                        
                        <div class="col-12">
                            <button class="btn btn-primary w-100 py-3" type="submit">Send Message</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<br>
<!-- Contact End -->

<!-- jQuery for AJAX -->
<script>
    $(document).ready(function() {
        $('#contactForm').submit(function(e) {
            e.preventDefault();
            $('#formFeedback').removeClass('alert-success alert-danger').hide();
            $('#captchaError').text('');
            var recaptchaResponse = grecaptcha.getResponse();

            $.ajax({
                type: 'POST',
                url: '<?= base_url('/add-contact'); ?>',
                data: $(this).serialize() + '&g-recaptcha-response=' + recaptchaResponse,
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'captcha_error') {
                        $('#captchaError').text(response.message);
                    } else if (response.status === 'success') {
                        $('#formFeedback')
                            .addClass('alert alert-success')
                            .text(response.message)
                            .fadeIn();
                        $('#contactForm')[0].reset();
                        grecaptcha.reset();
                        $('#captchaError').text('');
                        setTimeout(function() {
                            $('#formFeedback').fadeOut();
                        }, 5000);
                    } else if (response.status === 'error') {
                        $('#formFeedback')
                            .addClass('alert alert-danger')
                            .text(response.message)
                            .fadeIn();
                        setTimeout(function() {
                            $('#formFeedback').fadeOut();
                        }, 5000);
                    }
                },
                error: function() {
                    $('#formFeedback')
                        .addClass('alert alert-danger')
                        .text('An error occurred. Please try again.')
                        .fadeIn();
                    setTimeout(function() {
                        $('#formFeedback').fadeOut();
                    }, 5000);
                }
            });
        });
    });
</script>

<?php include "footer.php" ?>