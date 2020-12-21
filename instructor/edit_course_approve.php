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
        $audience_limit = $row['audience_limit'];
        $duration = $row['duration'];
        $price = $row['price'];
        $dates = $row['dates'];
        $instructor_name = $row['instructor_name'];
        $status = $row['status'];
    }
}


 ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Course Update</h1>
    <form method="post" action="update_course.php">
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

            <label for="audience"><b>Audience Limit</b></label>
            <input type="integer" placeholder="Audience Limit" name="audience_limit" id="audience_limit" required value="<?php echo $audience_limit ?>">

            <label for="price"><b>Price Suggestion</b></label>
            <input type="integer" placeholder="Suggest a price for this course" name="pricelul" id="price" required value="<?php echo $price ?>"
            <?php if($status=='Approve'){echo 'Disabled';}else{echo "";}?>>

            <label for="duration"><b>Duration</b></label>
            <input type="integer" placeholder="Days" name="duration" id="duration" required value="<?php echo $duration ?>">

            <label for="status"><b>Status</b></label>
            <input type="text" placeholder="Status" name="status" id="status" required value="<?php echo $status ?>">



            <label for="dates"><b>Dates</b></label>
            <input type="date" placeholder="dd/mm/yyyy" name="dates" id="dates" required value="<?php echo $dates ?>">
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


<?php
require('footer.php');
?>