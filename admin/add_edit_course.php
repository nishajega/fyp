<?php
require('top.php');

if(isset($_GET['id']) && $_GET['id']!=''){
	$id=get_safe_value($con,$_GET['id']);
	$res=mysqli_query($con,"select * from courses where id='$id'");
	$check=mysqli_num_rows($res);
	if($check>0){
		$row=mysqli_fetch_assoc($res);;
        $categories_id = $row['categories_id'];
        $name = $row['name'];
        $description = $row['description'];
        $overview = $row['overview'];
        $audience_target = $row['audience_target'];
        $duration = $row['duration'];
        $price = $row['price'];
        $dates = $row['dates'];
		$dates2 = $row['dates2'];
		$dates3 = $row['dates3'];
		$dates4 = $row['dates4'];
        $instructor_name = $row['instructor_name'];
        $status = $row['status'];
		$filename = $row['filename'];
	}else{
		?>
		<script type="text/javascript">
			window.location.href = 'approved_course.php';
		</script>
<?php
	}
}

if(isset($_POST['submit'])){
	$id=get_safe_value($con,$_GET['id']);
    $categories_id = $_POST['categories_id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $overview = $_POST['overview'];
    $audience_target = $_POST['audience_target'];
    $duration = $_POST['duration'];
    $price = $_POST['price'];
    $dates = $_POST['dates'];
    $dates2 = $_POST['dates2'];
	$dates3= $_POST['dates3'];
	$dates4 = $_POST['dates4'];
	$filename = $_POST['filename'];
	
	$query =  "UPDATE courses SET categories_id=$categories_id,name='$name',description='$description',
	overview='$overview',audience_target='$audience_target',duration='$duration',price=$price,dates='$dates',dates2='$dates2',dates3='$dates3',
    dates4='$dates4',filename='$filename' WHERE id='$id'";
	
	mysqli_query($con, $query);
	
	}


?>
<!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Edit Courses</h1>
		  <form method="post">
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
            <input type="text" placeholder="Enter Course Name" name="name" id="name" required value="<?php echo $name ?>">

            <label for="description"><b>Description</b></label>
            <textarea placeholder="Description about the course..." rows="5" name="description" id="description" required><?php echo $description ?></textarea>

            <label for="overview"><b>Overview</b></label>
            <textarea placeholder="Course Overview" name="overview" rows="5" id="overview" required><?php echo $overview ?></textarea>

            <label for="audience"><b>Target Audience</b></label>
            <input type="text" placeholder="Target Audience" name="audience_target" id="audience_target" required value="<?php echo $audience_target ?>">

            <label for="price"><b>Price Suggestion</b></label>
            <input type="integer" placeholder="Suggest a price for this course" name="price" id="price" required value="<?php echo $price ?>">

            <label for="duration"><b>Duration</b></label>
            <input type="integer" placeholder="Days" name="duration" id="duration" required value="<?php echo $duration ?>">

			<label for="file"><b>Upload file here</b></label>
			<input type="file" name="filename" size="50" value="<?php echo $filename ?>"/><br><br>
			
			<label for="duration"><b>Date</b></label>
            <input type="date" placeholder="dd/mm/yyyy" name="dates" id="dates" required value="<?php echo $dates ?>"><br>
			
			<label for="duration"><b>Date</b></label>
            <input type="date" placeholder="dd/mm/yyyy" name="dates2" id="dates2" value="<?php echo $dates2 ?>"><br>
			
			<label for="duration"><b>Date</b></label>
            <input type="date" placeholder="dd/mm/yyyy" name="dates3" id="dates2" value="<?php echo $dates3 ?>"><br>
			
			<label for="duration"><b>Date</b></label>
            <input type="date" placeholder="dd/mm/yyyy" name="dates4" id="dates3" value="<?php echo $dates4 ?>"><br>
			
			<button type="submit" name="submit" style="text-align: center;"class="btn btn-success btn-icon-split">               	
				<span class="text">Submit</span> 
			</button>
			<div style="color:red; margin: 5px;"></div>
		</div>
		</form>
		<br><br><br><br><br><br>
       
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->


<?php
	require('footer.php');
?>