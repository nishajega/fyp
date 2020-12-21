<?php
require('header.php');
error_reporting(0);

if (isset($_POST['submit'])) {
    if (isset($_GET['page_no']) && $_GET['page_no'] != "") {
        $page_no = $_GET['page_no'];
    } else {
        $page_no = 1;
    }

    $course_name_search = $_POST['name'];
    $total_records_per_page = 6;
    $offset = ($page_no - 1) * $total_records_per_page;
    $previous_page = $page_no - 1;
    $next_page = $page_no + 1;
    $adjacents = "2";

    $result_count = mysqli_query(
        $con,
        "SELECT COUNT(*) As total_records FROM courses WHERE name LIKE '%$course_name_search%' AND status='Approve'"
    );
    $total_records = mysqli_fetch_array($result_count);
    $total_records = $total_records['total_records'];
    $total_no_of_pages = ceil($total_records / $total_records_per_page);
    $second_last = $total_no_of_pages - 1; // total pages minus 1

    $cat_res = mysqli_query($con, "SELECT * FROM categories WHERE status=1");

    $cat_arr = array();
    while ($row = mysqli_fetch_assoc($cat_res)) {
        $cat_arr[] = $row;
    }
    $course_res = mysqli_query($con, "SELECT * from courses WHERE name LIKE '%$course_name_search%' AND status='Approve' LIMIT $offset, $total_records_per_page");
      
        while ($course_row = mysqli_fetch_assoc($course_res)) {
            $course_arr[] = $course_row;
        }
}
?>



<div class="sidebar">
    <h3>COURSE CATEGORIES</h3>
    <?php
    foreach ($cat_arr as $list) {
    ?>
        <a href="categories.php?id=<?php echo $list['id'] ?>"><?php echo $list['categories'] ?></a>
    <?php
    }
    ?>
</div>

<section class="page-section">
    <div class="container text-center">
        <form method="post" action="">
            <div class="enquiry">
                <input type="text" placeholder="Enter Course Name" name="name" id="name" required><br>
                <?php if($course_arr==null): ?>
                <h2 class="mb-4">COURSE NOT FOUND</h2>
                <?php endif; ?>
                <button type="submit" name="submit">Submit</button>
            </div>
    </div>
    <div class="wire">
        <h4>ALL COURSES</h4>
    </div>
    <div class="cup">
		<?php
		foreach ($course_arr as $courselst):
		?>
			<div class="box">
				<div class="icon"><?php echo $courselst['id'] ?></div>
				<div class="content">
					<h3><?php echo $courselst['name'] ?></h3>
					<p><?php echo $courselst['overview'] ?></p>
					<a href="course_details.php?id=<?php echo $courselst['id'] ?>">Details</a>
				</div>


			</div>
		<?php
		endforeach;
		?>
</section>

<section class='page-section'>
    <div class='container'>
        <div class='row'>
            <?php


            if ($total_no_of_pages <= 10) {
                for ($counter = 1; $counter <= $total_no_of_pages; $counter++) {
                    if ($counter == $page_no) {
                        echo "<div class='col-lg-4 text-center'><button type='button' class='btn btn-success'><a>$counter</a></button></div>";
                    } else {
                        echo "<div class='col-lg-4 text-center'><button type='button' class='btn btn-secondary'><a href='course.php?page_no=$counter'>$counter</a></button></div>";
                    }
                }
            }
            ?>
        </div>
    </div>
</section>
</body>