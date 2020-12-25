<?php
require('top.php');
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

<!-- Page Content -->
  <div class="container">

    <!-- Page Heading/Breadcrumbs -->
    <h1 class="mt-4 mb-3">Courses
    </h1>

    <ol class="breadcrumb">
      <form class="form-inline mt-2 mt-md-0" method="post" action="show_courses.php">
            <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search" name="name" id="name">
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
	<?php if($course_arr==null): ?>
                <h4 class="mb-4">COURSE NOT FOUND</h4>
                <?php endif; ?>
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
  <!-- /.container -->

  <!-- Footer -->
  <footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; Your Website 2020</p>
    </div>
    <!-- /.container -->
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>