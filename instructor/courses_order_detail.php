<?php
require('top.php');
$id=get_safe_value($con, $_GET['id']);
$res=mysqli_query($con, "select sum(order_detail.quantity) as quantity,order_detail.*,
courses.name,ordered.order_status from order_detail, courses, ordered where order_detail.product_id=courses.id 
and ordered.id=order_detail.order_id and order_detail.product_id='$id' and ordered.order_status='3' group by order_detail.date");

?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Course</h1>


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">List of Registered Users</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Course Name</th>
							<th>Date</th>
                            <th>Total Registered (Success)</th>
                        </tr>
                    </thead>
                   
                    <tbody> 
					<?php
					while($row=mysqli_fetch_array($res)){
						?>
                            <tr>
                                <td><?php echo $row[7] ?></td>
                                <td><?php echo $row[4] ?></a></td>
                                <td><?php echo $row[0] ?></td>
                                
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

<?php
	require('footer.php');
?>