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
			echo "update cert set name='$names[$key]', email='$email[$key]' where order_detail_id='$id'";
				mysqli_query($con,"update cert set name='$names[$key]', email='$email[$key]' where order_detail_id='$id'");
				echo'<script>alert("Your details updated")</script>';
			}
			}
		}
	}else{
			foreach ($names as $key => $name) {	
				echo "INSERT INTO cert(order_detail_id, name, email, course,date, instructor) VALUES('$id','$names[$key]', '$email[$key]', '$courseid', '$date', '$instructor')";
				$qry = "INSERT INTO cert(order_detail_id, name, email, course, date, instructor) VALUES('$id','$names[$key]', '$email[$key]','$courseid', '$date', '$instructor')";
				$go = mysqli_query($con, $qry);
				echo '<script>alert("Thank You!")</script>';
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
                    <label >Name On Cert<?= $i ?></label>
                    <input type="text" class="form-control" id="name" name="name[]" placeholder="" width="50%" required value="">
                </div>
                <div class="form-group">
                    <label >Email <?= $i ?></label>
                    <input type="text" class="form-control" id="email" name="email[]" placeholder="" required value="">
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
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/jquery.validate.js"></script>
<script type="text/javascript">
	$.validator.addMethod("noSpace", function(value, element){
		return value == '' || value.trim().length != 0
	}, "Space are not allowed");
	$.validator.addMethod("noNumeric", function(value, element){
		return this.optional(element) || value.match(/.*[a-zA-Z].*/);
	}, "Only alphabetic characters allowed");
	$.validator.addMethod("noEmail", function(value, element){
		return this.optional(element) || value.match(/^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/);
	}, "Please enter a valid email address");
	// Wait for the DOM to be ready
    // Initialize form validation on the registration form.
    // It has the name attribute "registration"
    $("#certForm").validate({
        // Specify validation rules
        rules: {
            // The key name on the left side is the name attribute
            // of an input field. Validation rules are defined
            // on the right side
            name: {
                required: true,
				noNumeric: true,
				minlength:3,
				noSpace: true
            },
            email: {
				required:true,
				noSpace: true,
				noEmail: true
            }

        },
        // Specify validation error messages
        messages: {
            name: {
                required: "Please enter name",
				noNumeric: "No numeric is allowed",
				minlength: "Please enter your full name for e-certficate"
            },
			name: {
                required: "Please enter email address",
				noEmail: "Enter valid email address"
            }
			
		},
		errorPlacement: function (error, element) {
            error.insertAfter(element);
        },
        // Make sure the form is submitted to the destination defined
        // in the "action" attribute of the form when valid
        submitHandler: function (form) {
            form.submit();
        }
	});

</script>
</body>

</html>