<?php
include 'header.php';
?>





<!-- =========================================================
     PAYMENT PAGE
========================================================= -->

<section class="payment-page">

    <div class="container">

        <div class="payment-container">

            <div class="payment-card">


                <!-- =================================================
                     CARD HEADER
                ================================================== -->

                <div class="payment-card-header">

                    <div class="payment-icon">

                        <i class="fas fa-credit-card"></i>

                    </div>

                    <h2>
                        Make a Payment
                    </h2>

                    <p>
                        Secure payment gateway for Delvia Holidays
                    </p>

                </div>


                <!-- =================================================
                     CARD BODY
                ================================================== -->

                <div class="payment-card-body">


                    <!-- PAYMENT FORM -->

                    <form
                        id="paymentForm"
                        method="POST"
                        action="<?= base_url('payment/process'); ?>"
                    >


                        <!-- =================================================
                             FIRST / LAST NAME
                        ================================================== -->

                        <div class="form-row">

                            <div class="form-group">

                                <label for="firstName">

                                    <i class="fas fa-user"></i>

                                    First Name

                                </label>

                                <input
                                    type="text"
                                    id="firstName"
                                    name="pay_fname"
                                    class="form-control"
                                    placeholder="Enter first name"
                                    autocomplete="given-name"
                                    required
                                >

                            </div>


                            <div class="form-group">

                                <label for="lastName">

                                    <i class="fas fa-user"></i>

                                    Last Name

                                </label>

                                <input
                                    type="text"
                                    id="lastName"
                                    name="pay_lname"
                                    class="form-control"
                                    placeholder="Enter last name"
                                    autocomplete="family-name"
                                    required
                                >

                            </div>

                        </div>


                        <!-- =================================================
                             EMAIL
                        ================================================== -->

                        <div class="form-group">

                            <label for="customerEmail">

                                <i class="fas fa-envelope"></i>

                                Email Address

                            </label>

                            <input
                                type="email"
                                id="customerEmail"
                                name="pay_email"
                                class="form-control"
                                placeholder="you@example.com"
                                autocomplete="email"
                                required
                            >

                        </div>


                        <!-- =================================================
                             PHONE / AMOUNT
                        ================================================== -->

                        <div class="form-row">

                            <div class="form-group">

                                <label for="customerPhone">

                                    <i class="fas fa-phone"></i>

                                    Phone Number

                                </label>

                                <input
                                    type="text"
                                    id="customerPhone"
                                    name="pay_phone"
                                    class="form-control"
                                    placeholder="10-digit mobile"
                                    autocomplete="tel"
                                    inputmode="numeric"
                                    pattern="[0-9]{10}"
                                    maxlength="10"
                                    minlength="10"
                                    required
                                >

                            </div>


                            <div class="form-group">

                                <label for="orderAmount">

                                    <i class="fas fa-money-bill-wave"></i>

                                    Amount (INR)

                                </label>

                                <input
                                    type="number"
                                    id="orderAmount"
                                    name="pay_amount"
                                    class="form-control"
                                    placeholder="Enter amount"
                                    min="1"
                                    step="1"
                                    required
                                >

                            </div>

                        </div>


                        <!-- =================================================
                             PAYMENT TYPE / GATEWAY
                        ================================================== -->

                        <div class="form-row">

                            <div class="form-group">

                                <label for="payType">

                                    <i class="fas fa-receipt"></i>

                                    Payment Type

                                </label>

                                <select
                                    id="payType"
                                    name="pay_type"
                                    class="form-control"
                                    required
                                >

                                    <option value="">
                                        Select Payment Type
                                    </option>

                                    <option value="Holiday Amount">
                                        Holiday Amount
                                    </option>

                                    <option value="Annual Maintenance Cost">
                                        Annual Maintenance Cost
                                    </option>

                                    <option value="Utility Charges">
                                        Utility Charges
                                    </option>

                                </select>

                            </div>


                            <div class="form-group">

                                <label for="paymentGateway">

                                    <i class="fas fa-credit-card"></i>

                                    Payment Gateway

                                </label>

                                <select
                                    id="paymentGateway"
                                    name="pay_gateway"
                                    class="form-control"
                                    required
                                >

                                    <option value="" selected>
                                        Select Gateway
                                    </option>

                                    <option value="cashfree">
                                        Cashfree
                                    </option>

                                    <option value="razorpay">
                                        Razorpay
                                    </option>

                                    <option value="payu">
                                        PayU
                                    </option>

                                    <option value="ccavenue">
                                        CCAvenue
                                    </option>

                                </select>

                            </div>

                        </div>


                        <!-- =================================================
                             PAY BUTTON
                        ================================================== -->

                        <button
                            type="submit"
                            class="btn-pay"
                        >

                            <i class="fas fa-lock"></i>

                            Pay Now

                        </button>


                    </form>


                    <!-- =================================================
                         MESSAGE
                    ================================================== -->

                    <div
                        class="message"
                        id="message"
                    ></div>


                    <!-- =================================================
                         TRUST BADGES
                    ================================================== -->

                    <div class="trust-badges">

                        <div class="trust-item">

                            <i class="fas fa-shield-alt"></i>

                            100% Secure

                        </div>


                        <div class="trust-item">

                            <i class="fas fa-lock"></i>

                            SSL Encrypted

                        </div>


                        <div class="trust-item">

                            <i class="fas fa-headset"></i>

                            24/7 Support

                        </div>

                    </div>


                    <!-- =================================================
                         SECURITY NOTE
                    ================================================== -->

                    <div class="payment-security-note">

                        Your payment information is transmitted securely
                        through the selected payment gateway.

                    </div>


                </div>

            </div>

        </div>

    </div>

</section>


<?php include 'footer.php';?>