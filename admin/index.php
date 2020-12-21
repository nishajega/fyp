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
  </div>

  <!-- Content Row -->

  <div class="row">

    <!-- Area Chart -->
    <div class="col-xl-8 col-lg-7">
      <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Revenue Overview</h6>
          <div class="dropdown no-arrow">
            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
              <div class="dropdown-header">Dropdown Header:</div>
              <a class="dropdown-item" href="#">Action</a>
              <a class="dropdown-item" href="#">Another action</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">Something else here</a>
            </div>
          </div>
        </div>
        <!-- Card Body -->
        <div class="card-body">
          <div class="chart-area">
            <canvas id="myAreaChart"></canvas>
          </div>
        </div>
      </div>
    </div>



    <!-- Content Column -->
    <div class="col-xl-4 col-lg-5">

      <!-- Project Card Example -->
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Courses</h6>
        </div>
        <?php
        foreach ($course_arr as $courselst) {
        ?>
          <div class="card-body">
            <h4 class="small font-weight-bold"><?php echo $courselst['name'] ?><span class="float-right"><?php echo $courselst['audience_limit'] ?>0%</span></h4>
            <div class="progress mb-4">
              <div class="progress-bar bg-danger" role="progressbar" style="width:<?php echo $courselst['audience_limit'] ?>0%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
          </div>
        <?php
        }
        ?>
      </div>

    </div>

    <div class="col-lg-6 mb-4">

    </div>
  </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<?php
require('footer.php');
?>