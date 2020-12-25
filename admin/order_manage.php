<?php
require('top.php');


$sql = "SELECT * FROM instructor";
$res = mysqli_query($con, $sql);
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">ORDERS</h1>


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">List of Instructor</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
							<th>Order ID</th>
							<th>Order Date</th>
							<th>Address</th>
							<th>Payment Type</th>
							<th>Payment Status</th>
							<th>Order Status</th>
							<th>Action</th>
						</tr>
                    </thead>
                   
                    <tbody>
					<?php
                        $res=mysqli_query($con, "select ordered.*, order_status.name as order_status
						from ordered, order_status where order_status.id=ordered.order_status");
						while($row=mysqli_fetch_assoc($res)){
					?>
                            <tr>
								<th scope="row"><?php echo $row['id'] ?></th>
								<td><?php echo $row['added_on'] ?></td>
								<td><?php echo $row['address'] ?><br/><?php echo $row['city'] ?><br/><?php echo $row['postcode'] ?></td>
								<td><?php echo $row['payment_type'] ?></td>
								<td><?php echo $row['payment_status'] ?></td>
								<td><?php echo $row['order_status'] ?></td>
                                <td><a class="btn btn-primary" href="ordermanage_detail.php?id=<?php echo $row['id']  ?>" role="button">Order Detail</a></td>
                            </tr>
                        <?php } ?>


                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<script type="text/javascript">
function confirm_delete(){
	return confirm('Are you sure you want to disable this instructor?');
}

function confirm_active(){
	return confirm('Are you sure you want to activate this instructor?');
}
</script>

<?php
require('footer.php');
?>