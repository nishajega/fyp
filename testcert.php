<?php
require('top.php');
require('functions.php');
$names='';
$email='';
if(isset($_GET['id'])){
	$id=get_safe_value($con,$_GET['id']);
	$sql="select order_detail.*, courses.name, courses.instructor_name
	from order_detail, courses  where order_detail.product_id=courses.id and order_detail.id='$id'";
	$res=mysqli_query($con,$sql);
	$row=mysqli_fetch_array($res);
		$courseid=$row[2];
		$date=$row[3];
		$instructor=$row[7];
		$value=$row[4];
}

if(isset($_POST['submit'])){
	$names=$_POST['name'];
	$email=$_POST['email'];
	$id=get_safe_value($con,$_GET['id']);
	
	$test=mysqli_query($con,"select * from cert where order_detail_id='$id'");
	$check=mysqli_num_rows($test);
	if($check>0){
		if(isset($_GET['id']) && $_GET['id']!=''){
			$getData=mysqli_fetch_assoc($test);
			if($id-$getData['id']){
			foreach ($names as $key => $name) {	
				mysqli_query($con,"update cert set name='$names[$key]', email='$email[$key]' where order_detail_id='$id'");
				echo'<script>alert("Your details updated")</script>';
				?>
				<script>
					window.location.href='my_order.php';
				</script>
				<?php
			}
			}
		}
	}else{
			foreach ($names as $key => $name) {	
				
				$qry = "INSERT INTO cert(order_detail_id, name, email, course, date, instructor) VALUES('$id','$names[$key]', '$email[$key]','$courseid', '$date', '$instructor')";
				$go = mysqli_query($con, $qry);
				echo '<script>alert("Thank You!")</script>';
				?>
				<script>
					window.location.href='my_order.php';
				</script>
				<?php
			}
	}
	
}
?>
<style>
.error{
	color: red;
	font-style:italic;
}
</style>
<body>
    <div class="d-flex p-2 justify-content-center">
        <h1>Certificate form</h1><br>
		
    </div>
	<h6 style="text-align:center";> Fill in the name(s) and email(s) for e-certification</h6><br>
    <div class="container">
	<div class="field_error"></div>
	
        <form action="" method="post" name="certForm" id="certForm">
            <?php 
			for ($i =1; $i <= $value; $i++) : ?>
                <div class="form-group">
                    <label >Name On Certificate <?= $i ?></label>
                    <input type="text" class="form-control" id="name" name="name[]" required value="">
                </div>
                <div class="form-group">
                    <label >Email <?= $i ?></label>
                    <input type="email" pattern="^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$" class="form-control" id="email" name="email[]" required value="">
                </div>
            
            <div class="form-group">
                    <input type="hidden" class="form-control" name="coursename" value="<?php echo $courseid ?>">
                </div> <div class="form-group">
            
                    <input type="hidden" class="form-control" name="instructorname" value="<?php echo $instructor ?>">
                </div>
					<input type="hidden" class="form-control" name="date" value="<?php echo $date ?>">
				<?php endfor; ?>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>

    </div>
</body>

</html>