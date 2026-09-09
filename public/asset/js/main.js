(function ($) {
    "use strict";

    $(document).ready(function () {

        // ===== Spinner =====
        if ($('#spinner').length > 0) {
            setTimeout(() => $('#spinner').removeClass('show'), 1);
        }

        // ===== Back to Top Click =====
        $('.back-to-top').click(function () {
            $('html, body').animate({scrollTop: 0}, 1500, 'easeInOutExpo');
            return false;
        });

        // ===== Owl Carousel Helper =====
        function initOwlCarousel(selector, options, prevBtn, nextBtn) {
            var carousel = $(selector).owlCarousel(options);
            if (prevBtn) $(prevBtn).click(() => carousel.trigger('prev.owl.carousel'));
            if (nextBtn) $(nextBtn).click(() => carousel.trigger('next.owl.carousel'));
        }

        // ===== All Carousels =====
        initOwlCarousel('.Domestic-carousel', {
            autoplay: true, smartSpeed: 1000, dots: false, loop: true, margin: 25,
            responsive: {0:{items:1},768:{items:2},992:{items:2},1200:{items:3}}
        }, '.domestic-prev', '.domestic-next');

        initOwlCarousel('.international-carousel', {
            autoplay: true, smartSpeed: 1000, dots: false, loop: true, margin: 25,
            responsive: {0:{items:1},768:{items:2},992:{items:2},1200:{items:3}}
        }, '.international-prev', '.international-next');

        initOwlCarousel('.packages-carousel', {
            autoplay: true, smartSpeed: 1000, dots: false, loop: true, margin: 25,
            nav: true, navText: ['<i class="bi bi-arrow-left"></i>','<i class="bi bi-arrow-right"></i>'],
            responsive: {0:{items:1},768:{items:2},992:{items:2},1200:{items:4}}
        });

        initOwlCarousel('.testimonial-review', {
            autoplay: true, smartSpeed: 1000, dots: true, loop: true, margin: 25, center: true,
            nav: true, navText: ['<i class="bi bi-arrow-left"></i>','<i class="bi bi-arrow-right"></i>'],
            responsive: {0:{items:1},768:{items:2},992:{items:2},1200:{items:3}}
        });

        initOwlCarousel('.testimonial-carousel', {
            autoplay: true, loop: true, margin: 20, smartSpeed: 1000,
            responsive: {0:{items:1},576:{items:2},768:{items:3},992:{items:4}}
        });

        // ===== Popup =====
        const starterPopup = document.getElementById('starterPopup');
        const starterCloseBtn = document.getElementById('starterCloseBtn');
        if (starterPopup && starterCloseBtn) {
            starterCloseBtn.addEventListener('click', () => starterPopup.style.display = 'none');
            starterPopup.addEventListener('click', (e) => {
                if (e.target === starterPopup) starterPopup.style.display = 'none';
            });
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape') starterPopup.style.display = 'none';
            });
        }

        // ===== Booking Form with reCAPTCHA =====
        $('#bookingForm').submit(function(e) {
            e.preventDefault();
            $('#formFeedback').removeClass('alert-success alert-danger').hide();
            $('#captchaError').text('');

            const recaptchaResponse = grecaptcha.getResponse();
            if (!recaptchaResponse) {
                $('#captchaError').text('Please complete the CAPTCHA.');
                return;
            }

            const actionUrl = $(this).data('action');

            $.ajax({
                type: 'POST',
                url: actionUrl,
                data: $(this).serialize() + '&g-recaptcha-response=' + recaptchaResponse,
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'captcha_error') {
                        $('#captchaError').text(response.message);
                    } else if (response.status === 'success') {
                        $('#formFeedback').addClass('alert alert-success').text(response.message).fadeIn();
                        $('#bookingForm')[0].reset();
                        grecaptcha.reset();
                        setTimeout(() => $('#formFeedback').fadeOut(), 5000);
                    } else if (response.status === 'error') {
                        $('#formFeedback').addClass('alert alert-danger').text(response.message).fadeIn();
                        setTimeout(() => $('#formFeedback').fadeOut(), 5000);
                    }
                },
                error: function() {
                    $('#formFeedback').addClass('alert alert-danger').text('An error occurred. Please try again.').fadeIn();
                    setTimeout(() => $('#formFeedback').fadeOut(), 5000);
                }
            });
        });

        // ===== Scroll Listener for Sticky, Fixed Navbar & Back-to-Top =====
        $(window).scroll(function () {
            const scrollTop = $(this).scrollTop();
            const navbar = $('.navbar');

            // Sticky navbar shadow
            if (scrollTop > 45) navbar.addClass('sticky-top shadow-sm');
            else navbar.removeClass('sticky-top shadow-sm');

            // Fixed navbar
            if (scrollTop > 100) navbar.addClass('navbar-fixed');
            else navbar.removeClass('navbar-fixed');

            // Back-to-top button
            if (scrollTop > 300) $('.back-to-top').fadeIn('slow');
            else $('.back-to-top').fadeOut('slow');
        });

    }); // end document ready

})(jQuery);
