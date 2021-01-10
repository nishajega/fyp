<?php
require('top.php');
error_reporting(0);

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
		"SELECT COUNT(*) As total_records FROM `courses` WHERE name LIKE '%$course_name_search%' AND status='Approve'"
	);
	$total_records = mysqli_fetch_array($result_count);
	$total_records = $total_records['total_records'];
	$total_no_of_pages = ceil($total_records / $total_records_per_page);
	$second_last = $total_no_of_pages - 1; 
$categories_id=mysqli_real_escape_string($con,$_GET['id']);

$cat_res = mysqli_query($con, "SELECT * FROM categories WHERE status=1");

	$cat_arr = array();
	while ($row = mysqli_fetch_assoc($cat_res)) {
		$cat_arr[] = $row;
	}
	
if($categories_id != ''){
	$sql="select * from courses where status='Approve' and categories_id=$categories_id ";

	$course_res = mysqli_query($con, $sql);
	$course_arr=array();
	while ($course_row = mysqli_fetch_assoc($course_res)) {
		$course_arr[] = $course_row;
	}
}

?>
<head>
<style>
.cup
{
	display: flex;
	flex-wrap: wrap;
	border-collapse: separate;
	border-spacing: 20px;
}
.cup .box
{
	position: relative;
	bottom:250px;
	left:280px;
	width: 390px;
	padding: 40px;
	background: #fff;
	box-shadow: 0 5px 15px rgba(0,0,0,.1);
	border-radius: 4px;
	margin: 15px;
	margin-left: 20px;
	box-sizing: border-box;
	overflow: hidden;
}	
</style>
</head>
 <!-- Page Content -->
  <div class="container">

    <!-- Page Heading/Breadcrumbs -->
    <h1 class="mt-4 mb-3">Courses
    </h1>

    <ol class="breadcrumb">
      <form class="form-inline mt-2 mt-md-0" method="post" action="show_courses.php">
            <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" name="submit" type="submit">Search</button>
			
      </form>
    </ol>

    <!-- Content Row -->
    <div class="row">
      <!-- Sidebar Column -->
      <div class="col-lg-3 mb-4">
        <div class="list-group">
		<a class="list-group-item" href="course2.php">ALL COURSES</a>
		<?php
			foreach ($cat_arr as $list) {
		?>
			<a class="list-group-item" href="categories.php?id=<?php echo $list['id'] ?>"><?php echo $list['categories'] ?></a>
        <?php
		}
		?>
        </div>
      </div>
	  
      <!-- Content Column -->
	
	<div class="cup">
	<?php
		foreach ($course_arr as $courselst):
		?>
			<div class="box">
				<div class="icon text-uppercase"><?php echo $courselst['id'] ?></div>
				<div class="content">
					<h3><?php echo $courselst['name'] ?></h3>
					<p><?php echo $courselst['description'] ?></p>
					<a href="course_details.php?id=<?php echo $courselst['id'] ?>">Details</a>
				</div>


			</div>
		<?php
		endforeach;
		?>
		</div>
		</div>
    <!-- /.row -->
	
  </div>
