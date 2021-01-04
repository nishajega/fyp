<?php
require('top.php');
$coupon_code='';
$coupon_type='';
$coupon_value='';
$cart_min_value='';

$msg='';
if(isset($_GET['id']) && $_GET['id']!=''){
	$id=get_safe_value($con,$_GET['id']);
	$res=mysqli_query($con,"select * from coupon where id='$id'");
	$check=mysqli_num_rows($res);
	if($check>0){
		$row=mysqli_fetch_assoc($res);
		$coupon_code=$row['coupon_code'];
		$coupon_type=$row['coupon_type'];
		$coupon_value=$row['coupon_value'];
		$cart_min_value=$row['cart_min_value'];
	}else{
		?>
		<script type="text/javascript">
			window.location.href = 'coupon_manage.php';
		</script>
<?php
	}
}

if(isset($_POST['submit'])){
	$coupon_code=get_safe_value($con,$_POST['coupon_code']);
	$coupon_type=get_safe_value($con,$_POST['coupon_type']);
	$coupon_value=get_safe_value($con,$_POST['coupon_value']);
	$cart_min_value=get_safe_value($con,$_POST['cart_min_value']);
	
	$res=mysqli_query($con,"select * from coupon where name='$coupon_code'");
	$check=mysqli_num_rows($res);
	if($check>0){
		if(isset($_GET['id']) && $_GET['id']!=''){
			$getData=mysqli_fetch_assoc($res);
			if($id-$getData['id']){
			
			}else{
				$msg="Coupon code already exists";
			}
		}else{
			$msg="Coupon code already exists";
		}
	}
	if($msg==''){
		if(isset($_GET['id']) && $_GET['id']!=''){
			mysqli_query($con,"update coupon set coupon_code='$coupon_code', coupon_type='$coupon_type',
			coupon_value='$coupon_value', cart_min_value='$cart_min_value'where id='$id'");
		}else{
			mysqli_query($con,"insert into coupon(coupon_code,coupon_type,coupon_value,cart_min_value, status) 
			values('$coupon_code','$coupon_type','$coupon_value','$cart_min_value','1')");
		}
		?>
		<script type="text/javascript">
			window.location.href = 'coupon_manage.php';
		</script>
<?php
	
	}
}


?>
<!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Add Coupon</h1>
		  <form method="post">
	      <hr>
	      <div class="instr">	
    	    
    		<label for="name"><b>Coupon Code</b></label>
    		<input type="text" placeholder="Enter Code" name="coupon_code" id="name" required value="<?php echo $coupon_code?>">
			
			<label for="name"><b>Coupon Type</b></label>
    		<select class="form-control" name="coupon_type" required>
				<option value=''>Select</option>
				<?php
					if($coupon_type=='Percentage'){
						echo '<option value="Percentage" selected>Percentage</option>
						<option value="MYR">MYR</option>';
					}elseif($coupon_type=='MYR'){
						echo '<option value="Percentage">Percentage</option>
						<option value="MYR" selected>MYR</option>';
					}else{
						echo '<option value="Percentage">Percentage</option>
						<option value="MYR">MYR</option>';
					}
				?>
				</select>
				
			<label for="name"><b>Coupon Value</b></label>
    		<input type="text" placeholder="Enter Value" name="coupon_value" id="name" required value="<?php echo $coupon_value?>">
			
			<label for="name"><b>Min Value</b></label>
    		<input type="text" placeholder="Cart Minimum Value" name="cart_min_value" id="name" required value="<?php echo $cart_min_value ?>">
			
			<button type="submit" name="submit" style="text-align: center;"class="btn btn-success btn-icon-split">               	
				<span class="text">Submit</span> 
			</button>
			<div style="color:red; margin: 5px;"><?php echo $msg ?></div>
		</div>
		</form>
		<br><br><br><br><br><br>
       
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->


<?php
	require('footer.php');
?>