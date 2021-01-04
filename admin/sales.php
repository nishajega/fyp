<?php
require('top.php');


?>

<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">SALES REPORT</h1>
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary"></h6>
    <form action="sales2.php" method="POST">
      <label for="">Select month:</label>
      <select class="form-control" name="month" id="month">
        <option value="1">January</option>
        <option value="2">February</option>
        <option value="3">March</option>
        <option value="4">April</option>
        <option value="5">May</option>
        <option value="6">June</option>
        <option value="7">July</option>
        <option value="8">August</option>
        <option value="9">September</option>
        <option value="10">October</option>
        <option value="11">November</option>
        <option value="12">December</option>
      </select>
      <button type="submit" style="float: right;" class="btn btn-success">Generate PDF Report</button>
        </form>
		</div>

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary"></h6>
    <form action="" method="POST">
      <label for="">Select month:</label>
      <select class="form-control" name="month" id="month">
        <option value="1">January</option>
        <option value="2">February</option>
        <option value="3">March</option>
        <option value="4">April</option>
        <option value="5">May</option>
        <option value="6">June</option>
        <option value="7">July</option>
        <option value="8">August</option>
        <option value="9">September</option>
        <option value="10">October</option>
        <option value="11">November</option>
        <option value="12">December</option>
      </select>
      <button type="submit" name="submit" style="float: right;" class="btn btn-success">Submit </button>
        </form>
	
	</div>
    <div class="card-body">
      <div class="table-responsive">
	  
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <?php
			if(isset($_POST['submit'])){
				$month_select=$_POST['month'];
				$sql="select DISTINCT(order_detail.product_id),sum(order_detail.quantity) as total, sum(order_detail.price) as 
				totalprice, courses.name,ordered.order_status, month(ordered.added_on) as month from order_detail, courses, ordered 
				where order_detail.product_id=courses.id and ordered.id=order_detail.order_id and ordered.order_status='3' 
				and month(ordered.added_on)='$month_select' group by order_detail.product_id";
				$res = mysqli_query($con, $sql);
				if($month_select=='1'){
					echo '<b>January</b>';
				}
				if($month_select=='2'){
					echo '<b>February</b>';
				}
				if($month_select=='3'){
					echo '<b>March</b>';
				}
				if($month_select=='4'){
					echo '<b>April</b>';
				}
				if($month_select=='5'){
					echo '<b>May</b>';
				}
				if($month_select=='6'){
					echo '<b>June</b>';
				}
				if($month_select=='7'){
					echo '<b>July</b>';
				}
				if($month_select=='8'){
					echo '<b>August</b>';
				}
				if($month_select=='9'){
					echo '<b>September</b>';
				}
				if($month_select=='10'){
					echo '<b>October</b>';
				}
				if($month_select=='11'){
					echo '<b>November</b>';
				}
				if($month_select=='12'){
					echo '<b>December</b>';
				}
				?>
		  <thead>
            <tr>

              <th>Course</th>
              <th>Total Quantity Sold</th>
              <th>Total Price</th>
            </tr>
          </thead>
          <tbody>
		  <?php
            while ($row = mysqli_fetch_assoc($res)) :
            ?>
              <tr>
                <td><?= $row['name'] ?></td>
                <td><?= $row['total'] ?></td>
				<td>RM <?= $row['totalprice'] ?></td>
              </tr>
            <?php endwhile; ?>

          </tbody>
        </table>
		<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
			<thead>
			<b>Best Seller of the Month (by Price)</b>
			</thead>
			<?php
			$best="select DISTINCT(order_detail.product_id),sum(order_detail.quantity) as total, sum(order_detail.price) as 
				totalprice, courses.name,ordered.order_status, month(ordered.added_on) as month from order_detail, courses, ordered 
				where order_detail.product_id=courses.id and ordered.id=order_detail.order_id and ordered.order_status='3' 
				and month(ordered.added_on)='$month_select' group by product_id order by totalprice DESC limit 1";
			$best_seller=mysqli_query($con, $best);
			?>
			<tr>
				<th>Course</th>
				<th>Total Quantity Sold</th>
				<th>Total Price</th>
			</tr>
			</thead>
			<tbody>
		  <?php
            while ($best_row = mysqli_fetch_assoc($best_seller)) :
            ?>
              <tr>
                <td><?= $best_row['name'] ?></td>
                <td><?= $best_row['total'] ?></td>
				<td>RM <?= $best_row['totalprice'] ?></td>
              </tr>
            <?php endwhile; ?>

          </tbody>
		</table>
		
		<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
			<thead>
			<b>High Sale (by Quantity)</b>
			</thead>
			<?php
			$bestqty="select DISTINCT(order_detail.product_id),sum(order_detail.quantity) as total, sum(order_detail.price) as 
				totalprice, courses.name,ordered.order_status, month(ordered.added_on) as month from order_detail, courses, ordered 
				where order_detail.product_id=courses.id and ordered.id=order_detail.order_id and ordered.order_status='3' 
				and month(ordered.added_on)='$month_select' group by product_id order by total DESC limit 1";
			$best_seller_qty=mysqli_query($con, $bestqty);
			?>
			<tr>
				<th>Course</th>
				<th>Total Quantity Sold</th>
				<th>Total Price</th>
			</tr>
			</thead>
			<tbody>
		  <?php
            while ($best_row_qty = mysqli_fetch_assoc($best_seller_qty)) :
            ?>
              <tr>
                <td><?= $best_row_qty['name'] ?></td>
                <td><?= $best_row_qty['total'] ?></td>
				<td>RM <?= $best_row_qty['totalprice'] ?></td>
              </tr>
            <?php endwhile; ?>

          </tbody>
		</table>
		
		<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
			<thead>
			<b>Least Sold (by Quantity)</b>
			</thead>
			<?php
			$leastqty="select DISTINCT(order_detail.product_id),sum(order_detail.quantity) as total, sum(order_detail.price) as 
				totalprice, courses.name,ordered.order_status, month(ordered.added_on) as month from order_detail, courses, ordered 
				where order_detail.product_id=courses.id and ordered.id=order_detail.order_id and ordered.order_status='3' 
				and month(ordered.added_on)='$month_select' group by product_id order by total ASC limit 1";
			$least_seller_qty=mysqli_query($con, $leastqty);
			?>
			<tr>
				<th>Course</th>
				<th>Total Quantity Sold</th>
				<th>Total Price</th>
			</tr>
			</thead>
			<tbody>
		  <?php
            while ($least_row_qty = mysqli_fetch_assoc($least_seller_qty)) :
            ?>
              <tr>
                <td><?= $least_row_qty['name'] ?></td>
                <td><?= $least_row_qty['total'] ?></td>
				<td>RM <?= $least_row_qty['totalprice'] ?></td>
              </tr>
            <?php endwhile; ?>

          </tbody>
		</table>
		
		<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
			<thead>
			<b>Least Sold (by Price)</b>
			</thead>
			<?php
			$least="select DISTINCT(order_detail.product_id),sum(order_detail.quantity) as total, sum(order_detail.price) as 
				totalprice, courses.name,ordered.order_status, month(ordered.added_on) as month from order_detail, courses, ordered 
				where order_detail.product_id=courses.id and ordered.id=order_detail.order_id and ordered.order_status='3' 
				and month(ordered.added_on)='$month_select' group by product_id order by totalprice ASC limit 1";
			$least_seller=mysqli_query($con, $least);
			?>
			<tr>
				<th>Course</th>
				<th>Total Quantity Sold</th>
				<th>Total Price</th>
			</tr>
			</thead>
			<tbody>
		  <?php
            while ($least_row = mysqli_fetch_assoc($least_seller)) :
            ?>
              <tr>
                <td><?= $least_row['name'] ?></td>
                <td><?= $least_row['total'] ?></td>
				<td>RM <?= $least_row['totalprice'] ?></td>
              </tr>
            <?php endwhile; ?>

          </tbody>
		</table>
			<?php } ?>
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
