<?php
require('top.php');
$categories_id = '';
$name = '';
$description = '';
$overview = '';
$audience_limit = '';
$duration = '';
$price = '';
$dates = '';
$instructor_name = '';
$msg = '';
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
        $audience_limit = $row['audience_limit'];
        $duration = $row['duration'];
        $price = $row['price'];
        $dates = $row['dates'];
        $instructor_name = $row['instructor_name'];
        $status = $row['status'];
    } else {
?>
        <script type="text/javascript">
            window.location.href = 'course.php';
        </script>
    <?php
    }
}

if (isset($_POST['submit'])) {
    $categories_id = get_safe_value($con, $_POST['categories_id']);
    $name = get_safe_value($con, $_POST['name']);
    $description = get_safe_value($con, $_POST['description']);
    $overview = get_safe_value($con, $_POST['overview']);
    $audience_limit = get_safe_value($con, $_POST['audience_limit']);
    $duration = get_safe_value($con, $_POST['duration']);
    $price = get_safe_value($con, $_POST['price']);
    $dates = get_safe_value($con, $_POST['dates']);
    $instructor_name = get_safe_value($con, $_POST['instructor_name']);
    

   
        if (isset($_GET['id']) && $_GET['id'] != '') {
            mysqli_query($con, "update courses set categories_id='$categories_id',name='$name',description='$description',
			overview='$overview',audience_limit='$audience_limit',duration='$duration',price='$price',dates='$dates',status='Reject'
			where id='$id'");
	?>
        <script type="text/javascript">
            window.location.href = 'course_approval.php';
        </script>
        <?php
        } else {
            mysqli_query($con, "insert into courses(categories_id,name,description,overview,audience_limit,duration,price,dates,instructor_name,status) 
			values('$categories_id','$name','$description','$overview','$audience_limit','$duration','$price','$dates','$instructor_name','Pending')");
        }
    ?>

<?php

    
}



?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Course Approve</h1>
    <form method="post" action="">
        <div style="color:red; margin: 5px;"><?php echo $msg ?></div>
        <input type="hidden" name="instructor_name" value="<?php echo $_SESSION['name']; ?>">
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

            <label for="audience"><b>Audience Limit</b></label>
            <input type="integer" placeholder="Audience Limit" name="audience_limit" id="audience_limit" required value="<?php echo $audience_limit ?>">

            <label for="price"><b>Price Suggestion</b></label>
            <input type="integer" placeholder="Suggest a price for this course" name="price" id="price" required value="<?php echo $price ?>">

            <label for="duration"><b>Duration</b></label>
            <input type="integer" placeholder="Days" name="duration" id="duration" required value="<?php echo $duration ?>">

            <label for="status"><b>Status</b></label>
            <input type="text" placeholder="Status" name="status" id="status" required value="<?php echo $status ?>">

            

            <label for="dates"><b>Dates</b></label>
            <input type="date" placeholder="dd/mm/yyyy" name="dates" id="dates" required value="<?php echo $dates ?>">

            <br><br>

            <button type="submit" name="submit" style="text-align: center;" value="submit" class="btn btn-success btn-icon-split">
                <span class="text">Reject</span>
            </button>

        </div>
    </form>
    <br><br><br><br><br><br>

    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->


<?php
require('footer.php');
?>