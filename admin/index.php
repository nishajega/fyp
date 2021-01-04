<?php
require('top.php');

$res_new = mysqli_query($con, "SELECT count(*) as total FROM courses LIMIT 3");
$total_new = mysqli_fetch_assoc($res_new);
$data_new = $total_new['total'];

$res_total = mysqli_query($con, "SELECT count(*) as total FROM courses ");
$total_courses = mysqli_fetch_assoc($res_total);
$data_total = $total_courses['total'];

$res_pending = mysqli_query($con, "SELECT count(*) as total FROM courses WHERE status LIKE 'Pending' ");
$pending_courses = mysqli_fetch_assoc($res_pending);
$data_pending = $pending_courses['total'];

$course_res = mysqli_query($con, "SELECT * from courses WHERE status='Approve'");
$course_arr = array();
while ($course_row = mysqli_fetch_assoc($course_res)) {
  $course_arr[] = $course_row;
}

$order_res=mysqli_query($con, "SELECT count(*) as total FROM ordered where order_status='1'");
$total_order = mysqli_fetch_assoc($order_res);
$data_order = $total_order['total'];

$cert_res=mysqli_query($con, "SELECT count(*) as total, order_detail.order_id, ordered.order_status FROM cert,order_detail, ordered where cert.order_detail_id=order_detail.id and ordered.id=order_detail.order_id and ordered.order_status='3' and cert.status='0'");
$total_cert = mysqli_fetch_assoc($cert_res);
$data_cert = $total_cert['total'];
?>

<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">DASHBOARD</h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
  </div>

  <!-- Content Row -->
  <div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">newly registered</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $data_new ?> </div>
            </div>
            <div class="col-auto">
              <i class="far fa-user fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total courses</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $data_total ?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-laptop-code fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pending Courses</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $data_pending ?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-comments fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
	
	<div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pending Orders</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $data_order ?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-comments fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
	
	<div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pending e-Cert</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $data_cert ?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-comments fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Content Row -->
<h5> Courses Order Detail </h5>
  <div class="row">

    <!-- Area Chart -->
	<?php
	$sql = "SELECT * FROM courses WHERE status LIKE 'Approve'";
	$res = mysqli_query($con, $sql);
	while ($row = mysqli_fetch_assoc($res)) {
		$id=$row['id'];
	?>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
					<div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                         <a href="courses_order_detail.php?id=<?=$row['id'] ?>"><?php echo $row['name']; ?></a></div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php $det=mysqli_query($con, "select sum(order_detail.quantity) as quantity,order_detail.*,courses.name,ordered.order_status from order_detail, courses, ordered where order_detail.product_id=courses.id and ordered.id=order_detail.order_id and order_detail.product_id='$id' and ordered.order_status='3' ");
              while ($order = mysqli_fetch_array($det)) {
				  $quantity=$order[0];
				   ?>
				   
			   <?php echo $quantity ?>
			   <?php } ?></div>
                </div>
			<div class="col-auto">
			RM<?php
			echo $row['price'];
			?>
            </div>
        </div>
	</div>
   </div>
   </div>
	<?php } ?>

    <!-- Content Column -->
    <div class="col-xl-4 col-lg-5">

      <!-- Project Card Example -->
      <div class="card shadow mb-4">
        
      </div>

    </div>

    <div class="col-lg-6 mb-4">

    </div>
  </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<br><br><br><br><br><br><br><br><br>
<?php
require('footer.php');
?>