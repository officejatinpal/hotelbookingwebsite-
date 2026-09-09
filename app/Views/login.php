<?php
$title = "Login | Delvia Holidays International Bangalore";
$description = "Member Login for Delvia Holidays International Bangalore. Access your holiday memberships, bookings, and personalized travel plans securely online..";
include 'header.php';
?>


<br>
<br>
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-12 col-sm-8 col-md-6 col-lg-4">
            <div class="card login-card">
                <div class="card-body">
                    <h5 class="card-title mb-4 text-center">Sign In</h5>

                    <?php if(session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger">
                            <?= session()->getFlashdata('error') ?>
                        </div>
                    <?php endif; ?>

                    <form action="<?= base_url('/login'); ?>" method="post">
                        <div class="mb-3">
                            <label for="ms_num" class="form-label">Membership No.</label>
                            <input type="text" class="form-control" id="ms_num" name="ms_num" placeholder="Enter Membership No.">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password">
                        </div>
                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-login">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<br>
<?php include "footer.php"; ?>