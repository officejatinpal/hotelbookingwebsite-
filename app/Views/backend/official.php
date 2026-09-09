<!DOCTYPE html>
<html lang="en">

<head>

    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Official</title>

    <link rel="icon" href="<?= base_url('favicon.ico') ?>" type="image/x-icon">

    <!-- Bootstrap -->
    <link href="<?= base_url('backend/assets/vendors/bootstrap/dist/css/bootstrap.min.css') ?>" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="<?= base_url('backend/assets/vendors/font-awesome/css/font-awesome.min.css') ?>" rel="stylesheet">

    <!-- Custom Theme -->
    <link href="<?= base_url('backend/assets/build/css/custom.min.css') ?>" rel="stylesheet">

    <!-- Existing Custom CSS -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('backend/assets/css/my_style.css') ?>" />

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Font Awesome 6 -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Outfit:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">


    
</head>


<body>

    <?php if(session()->getFlashdata('error')): ?>

        <div class="alert alert-danger official-alert">
            <i class="fa-solid fa-circle-exclamation me-2"></i>
            <?= session()->getFlashdata('error') ?>
        </div>

    <?php endif; ?>


    <!-- =========================================================
         MAIN PAGE
    ========================================================== -->

    <main class="official-page">

        <div class="official-container">


            <!-- =================================================
                 PAGE HEADER
            ================================================= -->

            <div class="official-header">

                <div class="official-badge">

                    <i class="fa-solid fa-shield-halved"></i>

                    Official Employee Portal

                </div>


                <h1 class="official-title">

                    Welcome Back

                </h1>


                <p class="official-subtitle">

                    Access your official dashboard, employee services,
                    celebrations and important company calendar updates.

                </p>

            </div>



            <!-- =================================================
                 THREE CARDS
            ================================================= -->

            <div class="official-grid">


                <!-- =================================================
                     BIRTHDAY CARD
                ================================================= -->

                <section class="official-card">

                    <div class="official-card-header">

                        <div class="official-icon">

                            <i class="fa-solid fa-cake-candles"></i>

                        </div>


                        <h2 class="official-card-title">

                            Today's Birthday

                        </h2>


                        <p class="official-card-description">

                            Celebrate our team members on their special day.

                        </p>

                    </div>


                    <div class="official-card-body">


                        <?php if (!empty($birthdays)): ?>

                            <ul class="birthday-list">

                                <?php foreach ($birthdays as $employee): ?>

                                    <li class="birthday-item">

                                        <div class="birthday-item-icon">

                                            <i class="fa-solid fa-cake-candles"></i>

                                        </div>


                                        <div>

                                            <strong>
                                                <?= esc($employee['name']); ?>
                                            </strong>

                                            <span>
                                                Happy Birthday! 🎉
                                            </span>

                                        </div>

                                    </li>

                                <?php endforeach; ?>

                            </ul>

                        <?php else: ?>

                            <div class="no-birthday">

                                <i class="fa-regular fa-calendar-xmark"></i>

                                <strong>
                                    No Celebration for Today
                                </strong>

                                <div style="margin-top:5px;font-size:12px;">
                                    We hope the next celebration is just around the corner.
                                </div>

                            </div>

                        <?php endif; ?>

                    </div>

                </section>



                <!-- =================================================
                     LOGIN CARD
                ================================================= -->

                <section class="official-card">

                    <div class="official-card-header">

                        <div class="official-icon">

                            <i class="fa-solid fa-right-to-bracket"></i>

                        </div>


                        <h2 class="official-card-title">

                            Employee Login

                        </h2>


                        <p class="official-card-description">

                            Sign in to access your official account.

                        </p>

                    </div>


                    <div class="official-card-body">

                        <form
                            action="/official"
                            method="post"
                            class="official-login-form"
                            id="add_form"
                        >

                            <div class="mainErr"></div>


                            <!-- ROLE -->

                            <div class="form-group-modern">

                                <label
                                    for="ltype"
                                    class="form-label-modern"
                                >
                                    Account Type
                                </label>


                                <div class="input-wrapper">

                                    <i class="fa-solid fa-user-shield"></i>

                                    <select
                                        class="modern-control"
                                        id="ltype"
                                        name="role"
                                        required
                                    >

                                        <option value="">
                                            Select account type
                                        </option>

                                        <option value="admin">
                                            Member_Admin
                                        </option>

                                        <option value="property">
                                            Property_Admin
                                        </option>

                                        <option value="employee">
                                            HR_Admin
                                        </option>

                                        <option
                                            value="employeelogin"
                                            selected
                                        >
                                            Employee_Login
                                        </option>

                                    </select>

                                </div>


                                <div class="typeErr"></div>

                            </div>



                            <!-- USERNAME -->

                            <div class="form-group-modern">

                                <label
                                    for="uname"
                                    class="form-label-modern"
                                >
                                    Username
                                </label>


                                <div class="input-wrapper">

                                    <i class="fa-solid fa-user"></i>

                                    <input
                                        type="text"
                                        id="uname"
                                        name="username"
                                        class="modern-control"
                                        placeholder="Enter your username"
                                        autocomplete="username"
                                        required
                                    />

                                </div>


                                <div class="unameErr"></div>

                            </div>



                            <!-- PASSWORD -->

                            <div class="form-group-modern">

                                <label
                                    for="pass"
                                    class="form-label-modern"
                                >
                                    Password
                                </label>


                                <div class="input-wrapper">

                                    <i class="fa-solid fa-lock"></i>

                                    <input
                                        type="password"
                                        id="pass"
                                        name="password"
                                        class="modern-control"
                                        placeholder="Enter your password"
                                        autocomplete="current-password"
                                        required
                                    />

                                </div>


                                <div class="passErr"></div>

                            </div>



                            <!-- LOGIN BUTTON -->

                            <div>

                                <button
                                    type="submit"
                                    class="official-login-btn"
                                    name="official"
                                >

                                    <i class="fa-solid fa-right-to-bracket me-2"></i>

                                    Login to Account

                                </button>

                            </div>


                            <div class="clearfix"></div>


                        </form>

                    </div>

                </section>



                <!-- =================================================
                     CALENDAR CARD
                ================================================= -->

                <section class="official-card">

                    <div class="official-card-header">

                        <div class="official-icon">

                            <i class="fa-regular fa-calendar-days"></i>

                        </div>


                        <h2 class="official-card-title">

                            Calendar 2026

                        </h2>


                        <p class="official-card-description">

                            Important holidays and company dates.

                        </p>

                    </div>


                    <div class="official-card-body">


                        <ul class="calendar-list">


                            <li class="calendar-item">

                                <div class="calendar-date">
                                    26 JAN
                                </div>

                                <div class="calendar-event">
                                    Republic Day
                                </div>

                            </li>


                            <li class="calendar-item">

                                <div class="calendar-date">
                                    04 MAR
                                </div>

                                <div class="calendar-event">
                                    Holi
                                </div>

                            </li>


                            <li class="calendar-item">

                                <div class="calendar-date">
                                    21 MAR
                                </div>

                                <div class="calendar-event">
                                    Eid al-Fitr
                                </div>

                            </li>


                            <li class="calendar-item">

                                <div class="calendar-date">
                                    27 MAY
                                </div>

                                <div class="calendar-event">
                                    Eid al-Adha
                                </div>

                            </li>


                            <li class="calendar-item">

                                <div class="calendar-date">
                                    15 AUG
                                </div>

                                <div class="calendar-event">
                                    Independence Day
                                </div>

                            </li>


                            <li class="calendar-item">

                                <div class="calendar-date">
                                    28 AUG
                                </div>

                                <div class="calendar-event">
                                    Raksha Bandhan
                                </div>

                            </li>


                            <li class="calendar-item">

                                <div class="calendar-date">
                                    08 NOV
                                </div>

                                <div class="calendar-event">
                                    Diwali
                                </div>

                            </li>


                        </ul>

                    </div>

                </section>

            </div>

        </div>

    </main>



    <!-- =========================================================
         FOOTER
    ========================================================== -->




    <!-- =========================================================
         LOADER
    ========================================================== -->

    <div
        class="loader-cart"
        style="display: none;"
    >

        <img
            src="<?= base_url('backend/assets/images/dark-loader.gif') ?>"
            alt="Loading"
        >

    </div>



    <!-- =========================================================
         AJAX LOGIN
    ========================================================== -->

    <script>

        $(document).ready(function () {

            $('#add_form').on('submit', function (e) {

                e.preventDefault();

                var role = $('#ltype').val();

                var empID = $('#uname').val();

                var password = $('#pass').val();


                /* ---------------------------------------------
                   VALIDATION
                --------------------------------------------- */

                if (role === '') {

                    alert('Please select a role.');

                    $('#ltype').focus();

                    return;
                }


                if (
                    empID.trim() === '' ||
                    password.trim() === ''
                ) {

                    alert(
                        'Both username and password are required.'
                    );

                    return;
                }


                var dataToSend = {

                    empID: empID,

                    password: password

                };


                /* ---------------------------------------------
                   EMPLOYEE LOGIN
                --------------------------------------------- */

                if (role === 'employeelogin') {

                    $('.official-login-btn')
                        .prop('disabled', true)
                        .html(
                            '<i class="fa-solid fa-spinner fa-spin me-2"></i> Logging in...'
                        );


                    $.ajax({

                        url: '/employeel/data',

                        type: 'POST',

                        data: dataToSend,

                        dataType: 'json',

                        success: function (response) {

                            console.log(
                                'Response:',
                                response
                            );


                            if (
                                response.status ===
                                'success'
                            ) {

                                alert(
                                    response.message
                                );


                                if (
                                    response.redirect
                                ) {

                                    window.location.href =
                                        response.redirect;

                                }

                            } else {

                                alert(
                                    response.message
                                );

                                $('.official-login-btn')
                                    .prop(
                                        'disabled',
                                        false
                                    )
                                    .html(
                                        '<i class="fa-solid fa-right-to-bracket me-2"></i> Login to Account'
                                    );
                            }

                        },


                        error: function (xhr) {

                            console.log(
                                'AJAX Error:',
                                xhr.responseText
                            );


                            alert(
                                'Something went wrong. Please try again.'
                            );


                            $('.official-login-btn')
                                .prop(
                                    'disabled',
                                    false
                                )
                                .html(
                                    '<i class="fa-solid fa-right-to-bracket me-2"></i> Login to Account'
                                );
                        }

                    });


                } else {

                    /* -----------------------------------------
                       NORMAL FORM SUBMISSION
                    ----------------------------------------- */

                    this.submit();

                }

            });

        });

    </script>


</body>

</html>