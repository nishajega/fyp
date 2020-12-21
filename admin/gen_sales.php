<?php
require('top.php');

if (isset($_GET['type']) && $_GET['type'] != '') {
  $type = get_safe_value($con, $_GET['type']);
  if ($type == 'status') {
    $operation = get_safe_value($con, $_GET['operation']);
    $id = get_safe_value($con, $_GET['id']);
    if ($operation == 'active') {
      $status = '1';
    } else {
      $status = '0';
    }
    $update_status = "update categories set status='$status' where id='$id'";
    mysqli_query($con, $update_status);
  }

  if ($type == 'delete') {
    $id = get_safe_value($con, $_GET['id']);
    $delete_sql = "delete from categories where id='$id'";
    mysqli_query($con, $delete_sql);
  }
}

$sql = "select item, sum(quantity) as sumq, sum(totalprice) as totalprice, dates, date from invoice group by item";
$res = mysqli_query($con, $sql);
?>

<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">SALES REPORT</h1>


  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary"></h6>
      <form action="sales_gen.php" method="POST">
      <label for="">Select month:</label>
      <select name="date" id="cars">
        <option value="2020-01-01">January</option>
        <option value="2020-02-01">February</option>
        <option value="2020-03-01">March</option>
        <option value="2020-04-01">April</option>
        <option value="2020-05-01">May</option>
        <option value="2020-06-01">June</option>
        <option value="2020-07-01">July</option>
        <option value="2020-08-01">August</option>
        <option value="2020-09-01">September</option>
        <option value="2020-10-01">October</option>
        <option value="2020-11-01">November</option>
        <option value="2020-12-01">December</option>
      </select>
      <button type="submit" style="float: right;" class="btn btn-success">Generate sales report </button>
        </form>
      </a>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>

              <th>Course</th>
              <th>Total Quantity Sold</th>
              <th>Total Price</th>
			<th>Date</th>
			<th>Purchase Date</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $i = 1;
            while ($row = mysqli_fetch_assoc($res)) :
            ?>
              <tr>
                <td><?= $row['item'] ?></td>
                <td><?= $row['sumq'] ?></td>
				<td>RM <?= $row['totalprice'] ?></td>
				<td><?= $row['dates'] ?></td>
				<td><?= $row['date'] ?></td>
              </tr>
            <?php endwhile; ?>


          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->


<?php
require('footer.php');
?>