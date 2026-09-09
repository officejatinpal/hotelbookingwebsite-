<!DOCTYPE html>
<html lang="en">

<head>
    <title>Member Login</title>
    <!--== META TAGS ==-->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
</head>

<body>

   <?php include 'profile_header.php' ?>
	
	<!--DASHBOARD-->
	<section>
		<div class="db">
		    <!--LEFT SECTION-->
			<?php include 'profile_sidebar.php' ?>
			<!--CENTER SECTION-->

            
			<div class="db-2">
				<div class="db-2-com db-2-main">
					<h4>Personal Details</h4>
					<div class="db-2-main-com db-2-main-com-table">
					    
					     <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>
            
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
            <?php endif; ?>
            
                    <table class="responsive-table">
							<tbody>
							<h3>Change Password</h3>
                            <form method="post" action="<?= base_url('member/change-password') ?>">
                                <tr>
                                    <td><div>
                                <label class="lb">Current Password</label>
                                    <input type="password" name="current_password" required>
                                    </div>
                                </td>
                                <td>
                                <div>
                                    <label class="lb">New Password</label>
                                    <input type="password" name="new_password" required>
                                </div>
                                </td>
                                <td>
                                <div>
                                    <label class="lb">Confirm New Password</label>
                                    <input type="password" name="confirm_password" required>
                                </div></td></tr>
                                <tr><td>
                                <button type="submit">Update Password</button></td></tr>
                            </form>
							</tbody>
						</table>
	
					</div>
				</div>
			</div>
			
		</div>
	</section>

</body>

</html>