<?php
require('top.php');
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
					<p><?php echo $courselst['overview'] ?></p>
					<a href="course_details.php?id=<?php echo $courselst['id'] ?>">Details</a>
				</div>


			</div>
		<?php
		endforeach;
		?>
		</div>
		</div>
    <!-- /.row -->
	<ul class="pagination justify-content-center">
      <?php
			if ($total_no_of_pages <= 10) {
				for ($counter = 1; $counter <= $total_no_of_pages; $counter++) {
					if ($counter == $page_no) {
						echo " <li class='page-item'><a class='page-link' href='course2.php?page_no=$counter'>$counter</a></li>";
					}else{
						echo "<li class='page-item'><a class='page-link' href='course2.php?page_no=$counter'>$counter</a></li>";
					}
				}
			}				
	  ?>
	  </li>
    </ul>
  </div>
