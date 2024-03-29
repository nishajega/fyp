<?php
require('top.php');

$msg='';
if (isset($_POST['submit'])) {

	$categories_id = get_safe_value($con, $_POST['categories_id']);
	$name = get_safe_value($con, $_POST['name']);
	$description = get_safe_value($con, $_POST['description']);
	$overview = get_safe_value($con, $_POST['overview']);
	$audience_target = get_safe_value($con, $_POST['audience_target']);
	$duration = get_safe_value($con, $_POST['duration']);
	$price = get_safe_value($con, $_POST['price']);
	$dates = get_safe_value($con, $_POST['dates']);
	$dates2 = get_safe_value($con, $_POST['dates2']);
	$dates3 = get_safe_value($con, $_POST['dates3']);
	$dates4 = get_safe_value($con, $_POST['dates4']);
	$instructor_name = get_safe_value($con, $_POST['instructor_name']);
	
	$check= mysqli_num_rows(mysqli_query($con, "select * from courses where name='$name'"));
	if($check>0){
		$msg= "Course name already exists";
	}else{
		$query_insert =  "INSERT INTO courses(categories_id,name,description,overview,audience_target,duration,price,dates,dates2,dates3,dates4,instructor_name,status,active)" ;
		$query_insert .="VALUES('$categories_id','$name','$description','$overview','$audience_target','$duration','$price','$dates','$dates2','$dates3','$dates4','$instructor_name','Pending','1')";

		$query_res = mysqli_query($con, $query_insert);

		echo "<h1> COURSE ADDED! </h1>";
		
		?>
		<script>
		window.location.href='course.php';
		</script>
		<?php
	}
}
?>
<style>
.error{
	color: red;
	font-style:italic;
}
</style>
<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<div class="error"><?php echo $msg ?></div>
	<h1 class="h3 mb-4 text-gray-800">Add Course</h1>
	<form method="post" action="" enctype="multipart/form-data" name="myForm" id="myForm">
		<div style="color:red; margin: 5px;"></div>
		<input type="hidden" name="instructor_name" value="<?php echo $_SESSION['instructor_name']; ?>">
		<hr>
		<div class="instr">
		
			<label for="categories"><b>Category</b></label>
			<select class="form-control" name="categories_id" id="categories_id" required>
				<option value="">Select Category</option>
				<?php
				$res = mysqli_query($con, "select id,categories from categories order by categories asc");
				while ($row = mysqli_fetch_assoc($res)) {
					if ($row['id'] == $categories_id) {
						echo "<option selected value=" . $row['id'] . ">" . $row['categories'] . "</option>";
					} else {
						echo "<option value=" . $row['id'] . ">" . $row['categories'] . "</option>";
					}
				}
				?>
			</select><br>

			<label for="name"><b>Course Name</b></label>
			<input type="text" placeholder="Enter Course Name" name="name" id="name"><br>

			<label for="description"><b>Description</b></label>
			<textarea placeholder="Description about the course..." rows="3" name="description" id="description"></textarea><br>

			<label for="overview"><b>Overview</b></label>
			<textarea placeholder="Course Overview" name="overview" rows="5" id="overview" ></textarea><br>

			<label for="audience"><b>Target Audience</b></label>
			<input type="text" placeholder="Target Audience" name="audience_target" id="audience_target"><br>

			<label for="price"><b>Fee</b></label>
			<input type="integer" placeholder="Suggest a fee for this course" name="price" id="price" required><br>

			<label for="duration"><b>Duration</b></label>
			<input type="integer" placeholder="Days" name="duration" id="duration" required><br>

			<label for="dates"><b>Choices of Date</b></label><br>
			
			<label for="dates"><b>Date</b></label>
			<input type="date" placeholder="dd/mm/yyyy" name="dates" id="dates" required><br><br>

			<label for="dates"><b>Date</b></label>
			<input type="date" placeholder="dd/mm/yyyy" name="dates2" id="dates2" ><br><br>

			<label for="dates"><b>Date</b></label>
			<input type="date" placeholder="dd/mm/yyyy" name="dates3" id="dates3" ><br><br>

			<label for="dates"><b>Date</b></label>
			<input type="date" placeholder="dd/mm/yyyy" name="dates4" id="dates4" ><br><br>

			<button type="submit" name="submit" style="text-align: center;" class="btn btn-success btn-icon-split">
				<span class="text">Submit</span>
			</button>

		</div>
	</form>
	<br><br><br><br><br><br>

</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/jquery.validate.js"></script>
<script src="multiselect/jquery.multiselect.js"></script>
<script type="text/javascript">
	$.validator.addMethod("notNone", function(value, element){
		return(value != "");
	}, "Please select an option");
	// Wait for the DOM to be ready
    // Initialize form validation on the registration form.
    // It has the name attribute "registration"
    $("#myForm").validate({
        // Specify validation rules
        rules: {
            // The key name on the left side is the name attribute
            // of an input field. Validation rules are defined
            // on the right side
            categories_id:{
				notNone: true
			},
			name: {
                required: true
            },
            description: {
                required: true
            },
            overview: {
                required: true
            },
            audience_target: {
                required: true
            },
            price: {
                required: true,
                number: true
            },
            duration: {
                required: true,
                number: true,
				min:1,
				max:10
            },
			dates:{
                required: true
			}

        },
        // Specify validation error messages
        messages: {
            name: {
                required: "Please enter course name"
            },
            description: {
                required: "Description can't be blank"
            },
            overview: {
                required: "Overview can't be blank"
            },
            audience_target: {
                required: "Target audience info is required",
            },
            price: {
                required: "Please Enter Price",
                number: "Enter numeric value only"
            },
            duration: {
                required: "Please Enter Duration",
                number: "Enter numeric value only",
				min:"Enter valid numeric value only",
				max:"Enter valid numeric value only"
            },
			dates: {
                required: "Please choose a date"
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


<?php
require('footer.php');
?>