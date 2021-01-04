<?php
require('top.php');

$order_id=get_safe_value($con, $_GET['id']);

if(isset($_POST['update_order_status'])){
	$update_order_status=$_POST['update_order_status'];
	mysqli_query($con, "update ordered set order_status='$update_order_status' where id='$order_id'");
	if($update_order_status==3){
		sentInvoice($con, $order_id);
	}
	if($update_order_status==2){
		$user_order=mysqli_fetch_assoc(mysqli_query($con, "select ordered.*, users_front.name, users_front.email
		from ordered, users_front where users_front.name=ordered.user_name and ordered.id='$order_id'"));
		$html='Your recent order with UNITEN Executive Education Programmes
		has been <strong>cancelled</strong>. Please contact our team for more information.
		You can also check in the website for <strong>My Order</strong> for more information regarding your order.';
		include('smtp/PHPMailerAutoload.php');
		$mail=new PHPMailer(true);
		$mail->isSMTP();
		$mail->SMTPDebug = 1;
		$mail->Host="smtp.gmail.com";
		$mail->Port=587;
		$mail->CharSet ='UTF-8';
		$mail->SMTPSecure="tls";
		$mail->SMTPAuth=true;
		$mail->Username="vesha2797@gmail.com";
		$mail->Password="Veshadoll2712";
		$mail->SetFrom("vesha2797@gmail.com");
		$mail->addAddress($user_order['email']);
		$mail->IsHTML(true);
		$mail->Subject="Invoice Details";
		$mail->Body=$html;
		$mail->SMTPOptions=array('ssl'=>array(
			'verify_peer'=>false,
			'verify_peer_name'=>false,
			'allow_self_signed'=>false
		));
		if($mail->send()){
			echo "Sent";
		}else{
			//echo "Error occur";
		}
}
}
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">ORDERS</h1>


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">List of Instructor</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
							<th>Course Name</th>
							<th>Quantity</th>
							<th>Price</th>
							<th>Subtotal</th>
						</tr>
                    </thead>
                   
                    <tbody>
					<?php
                        $res=mysqli_query($con, "select distinct(order_detail.id),order_detail.*, 
						courses.name from order_detail, courses, ordered where 
						order_detail.order_id='$order_id' and order_detail.product_id=courses.id");
						$total_price=0;
						while($row=mysqli_fetch_assoc($res)){
							$total_price=$total_price+($row['quantity']*$row['price']);
							
					?>
                            <tr>
								<th scope="row"><?php echo $row['name'] ?></th>
								<td><?php echo $row['quantity'] ?></td>
								<td>RM <?php echo $row['price'] ?></td>
								<td>RM <?php echo $row['quantity']*$row['price']?></td>
                            </tr>
                        <?php } ?>
						<tr>
                            <td colspan="2"></td>
                            <td style="font-weight: bold;">Total Price</td>
                            <td>RM <?php echo $total_price?></td>
                        </tr>


                    </tbody>
                </table>
				<div>
					<strong>Order Status: </strong>
					<?php
					$order_status_arr=mysqli_fetch_assoc(mysqli_query($con, "select order_status.name
					from order_status, ordered where ordered.id='$order_id' and ordered.order_status=order_status.id"));
					echo $order_status_arr['name'];
					?>
					
					<div>
						<form method="post">
							<select class="form-control" name="update_order_status"> 
							<?php
							$res=mysqli_query($con, "select * from order_status");
							while($row=mysqli_fetch_assoc($res)){
								if($row['id']==$id){
									echo "<option selected value=".$row['id'].">".$row['name']."</option>";
								}else{
									echo "<option value=".$row['id'].">".$row['name']."</option>";
								}
							}
							
							?>
							</select>
							<input type="submit" class="btn btn-success"/>
						</form>
					</div>
				</div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<script type="text/javascript">
function confirm_delete(){
	return confirm('Are you sure you want to disable this instructor?');
}

function confirm_active(){
	return confirm('Are you sure you want to activate this instructor?');
}
</script>

<?php
require('footer.php');
?>