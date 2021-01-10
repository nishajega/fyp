<?php
require('top.php');
if (isset($_GET['id']) && $_GET['id'] != '') {
    $id = get_safe_value($con, $_GET['id']);
    $query = mysqli_query($con, "select * from courses where id='$id'");
    $check = mysqli_num_rows($query);
    if ($check > 0) {
        $row = mysqli_fetch_assoc($query);
        $categories_id = $row['categories_id'];
        $name = $row['name'];
        $description = $row['description'];
        $overview = $row['overview'];
        $audience_target = $row['audience_target'];
        $duration = $row['duration'];
        $price = $row['price'];
        $dates = $row['dates'];
		$dates2 = $row['dates2'];
		$dates3= $row['dates3'];
		$dates4 = $row['dates4'];
        $instructor_name = $row['instructor_name'];
        $status = $row['status'];
    }
}

if (isset($_POST['submit'])) {
	$categories_id = get_safe_value($con, $_POST['categories_id']);
    $name = get_safe_value($con, $_POST['name']);
    $description = get_safe_value($con, $_POST['description']);
    $overview = get_safe_value($con, $_POST['overview']);
    $audience_limit = get_safe_value($con, $_POST['audience_target']);
    $duration = get_safe_value($con, $_POST['duration']);
    $price = get_safe_value($con, $_POST['price']);
    $dates = get_safe_value($con, $_POST['dates']);
	$dates2 = get_safe_value($con, $_POST['dates2']);
	$dates3 = get_safe_value($con, $_POST['dates3']);
	$dates4 = get_safe_value($con, $_POST['dates4']);
	
	if (isset($_GET['id']) && $_GET['id'] != '') {
		$query =  "UPDATE courses SET categories_id='$categories_id',name='$name',description='$description',
		overview='$overview',audience_target='$audience_target',duration='$duration',price='$price',dates='$dates',dates2='$dates2',dates3='$dates3',
		dates4='$dates4' WHERE id='$id'";
		mysqli_query($con, $query);
		?>
		<script>
			window.location.href='approved_course.php';
		</script>
		<?php
	}
}



 ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Course Update</h1>
    <form method="post" action="" name="myForm" id="myForm">
        <div style="color:red; margin: 5px;"></div>
        <input type="hidden" name="instructor_name" value="<?php echo $_SESSION['instructor_name']; ?>">
        <hr>
        <div class="instr">

            <label for="categories"><b>Category</b></label>
            <select class="form-control" name="categories_id">
                <option>Select Category</option>
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
            </select>

            <label for="name"><b>Course Name</b></label>
            <input type="text" placeholder="Enter Course Name" name="namelul" value="<?php echo $name ?>"
             <?php if($status=='Approve'){echo 'Disabled';}else{echo "";}?>>

            <label for="description"><b>Description</b></label>
            <textarea placeholder="Description about the course..." rows="5" name="description" id="description" required><?php echo $description ?></textarea>

            <label for="overview"><b>Overview</b></label>
            <textarea placeholder="Course Overview" name="overview" rows="5" id="overview" required><?php echo $overview ?></textarea>

            <label for="audience"><b>Target Audience</b></label>
            <input type="text" placeholder="Audience Target" name="audience_target" id="audience_target" required value="<?php echo $audience_target ?>">

            <label for="price"><b>Fee Suggestion</b></label>
            <input type="integer" placeholder="Suggest a price for this course" name="pricelul" id="price" required value="<?php echo $price ?>"
            <?php if($status=='Approve'){echo 'Disabled';}else{echo "";}?>>

            <label for="duration"><b>Duration</b></label>
            <input type="integer" placeholder="Days" name="duration" id="duration" required value="<?php echo $duration ?>"><br>
			
			<label for="duration"><b>Date</b></label>
            <input type="date" placeholder="dd/mm/yyyy" name="dates" id="dates" required value="<?php echo $dates ?>"><br>
			
			<label for="duration"><b>Date</b></label>
            <input type="date" placeholder="dd/mm/yyyy" name="dates2" id="dates2" value="<?php echo $dates2 ?>"><br>
			
			<label for="duration"><b>Date</b></label>
            <input type="date" placeholder="dd/mm/yyyy" name="dates3" id="dates2" value="<?php echo $dates3 ?>"><br>
			
			<label for="duration"><b>Date</b></label>
            <input type="date" placeholder="dd/mm/yyyy" name="dates4" id="dates3" value="<?php echo $dates4 ?>"><br>
            <input type="hidden" value="<?= $id ?>" name="id">
            <input type="hidden" value="<?= $name ?>" name="name">
            <input type="hidden" value="<?= $price ?>" name="price">

            <br><br>

            <button type="submit" name="submit" style="text-align: center;" value="submit" class="btn btn-success btn-icon-split">
                <span class="text">Submit</span>
            </button>

        </div>
    </form>
    <br><br><br><br><br><br>

    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
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