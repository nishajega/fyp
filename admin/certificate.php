<?php
require('top.php');
$res=mysqli_query($con, "select cert.*,courses.name,ordered.order_status, order_detail.order_id from cert, courses, ordered, order_detail where cert.course=courses.id and cert.order_detail_id=order_detail.id 
and order_detail.order_id=ordered.id and ordered.order_status='3' order by cert.id desc");

?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Course</h1>


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">List of Registered Users</h6>
			<a href="add_categories.php" style= "float: right;" class="btn btn-success">               	
                <span class="text">+ Generate e-Cert</span>
			  </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Course</th>
                            <th>Instructor</th>
							<th>Date</th>
                            <th>Status</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                   
                    <tbody> 
					<?php
					while($row=mysqli_fetch_array($res)){
					?>
                            <tr>
                                <td><?php echo $row[0] ?></td>
								<td><?php echo $row[2] ?></td>
                                <td><?php echo $row[3] ?></a></td>
                                <td><?php echo $row[8] ?></td>
                                <td><?php echo $row[6] ?></td>
                                <td><?php echo $row[5] ?></td>
                                <td><?php echo $row[7] ?></td>
                                <td>
								<?php
								if($row[7]==1){
									echo "Certificate already sent";
								}else{
									?>
									<a class="btn btn-info" href="testcert/gen_cert2.php?id=<?= $row[0] ?>"> Send e-Cert</a>
                                <?php
								}
								?>
								</td>
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