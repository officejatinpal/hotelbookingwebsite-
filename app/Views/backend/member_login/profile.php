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
                    <table class="responsive-table">
							<tbody>
								<tr>
									<td>MEMBERSHIP CARD NO</td>
									<td>:</td>
									<td> <?=$user['ms_num']?></td>
								</tr>
								<tr>
									<td>EMAIL</td>
									<td>:</td>
									<td><?=$user['email']?></td>
								</tr>
								<tr>
									<td>Name</td>
									<td>:</td>
									<td><?=$user['name']?></td>
								</tr>
								
								<tr>
									<td>Date of birth</td>
									<td>:</td>
									<td><?=date("d M, Y",strtotime($user['dob']))?></td>
								</tr>
                                <tr>
                                    <td>Membership Joining Date </td>
                                    <td>:</td>
                                    <td><?=date("d M, Y",strtotime($user['join_date']))?></td>
                                </tr>
                                <tr>
                                    <td>Marriage Anniversary</td>
                                    <td>:</td>
                                    <td>
                                <?php if(!empty($user['marriage_anniversary'])){
                                            echo date("d M, Y",strtotime($user['marriage_anniversary']));
                                        }?>
                                    </td>
                                </tr>
								<tr>
									<td>Spouse Name</td>
									<td>:</td>
									<td><?=$user['spouse']?></td>
								</tr>
                                <tr>
                                    <td>First Children Name</td>
                                    <td>:</td>
                                    <td><?=$user['f_child_name']?></td>
                                </tr>
                                <tr>
                                    <td>First Children Age</td>
                                    <td>:</td>
                                    <td><?=$user['f_child_age']?> Yr(s)</td>
                                </tr>
                                <tr>
                                    <td>Second Children Name</td>
                                    <td>:</td>
                                    <td><?=$user['s_child_name']?></td>
                                </tr>
                                <tr>
                                    <td>Second Children Age</td>
                                    <td>:</td>
                                    <td><?=$user['s_child_age']?> Yr(s)</td>
                                </tr>
								<tr>
									<td>Last Holiday Used</td>
									<td>:</td>
									<td><?=$user['last_holiday']?></td>
								</tr>
                                <tr>
                                    <td>MEMBERSHIP CATEGORY </td>
                                    <td>:</td>
                                    <td><?=$user['ms_category']?></td>
                                </tr>
                                <tr>
                                    <td>Mobile No.</td>
                                    <td>:</td>
                                    <td>+91-<?=$user['mobile']?></td>
                                </tr>
                                <tr>
                                    <td>Alternative Mobile No.</td>
                                    <td>:</td>
                                    <td>+91-<?=$user['alt_mobile']?></td>
                                </tr>
                                <tr>
                                    <td>Address</td>
                                    <td>:</td>
                                    <td><?=$user['address']?></td>
                                </tr>
                                <tr>
                                    <td>Membership Amount</td>
                                    <td>:</td>
                                    <td><?=$user['ms_amount']?> INR</td>
                                </tr>
                                <tr>
                                    <td>Advance Amount</td>
                                    <td>:</td>
                                    <td><?=$user['ms_advance']?> INR</td>
                                </tr>
                                <tr>
                                    <td>Due Amount</td>
                                    <td>:</td>
                                    <td><?=$user['ms_due']?> INR</td>
                                </tr>
                                <tr>
                                    <td>AMC Amount</td>
                                    <td>:</td>
                                    <td><?=$user['ms_amc']?> INR</td>
                                </tr>
							</tbody>
						</table>
						
					</div>
				</div>
			</div>
			
		</div>
	</section>
</body>

</html>