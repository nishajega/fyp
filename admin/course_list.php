<?php
require('top.php');
$id=get_safe_value($con, $_GET['id']);
$res=mysqli_query($con, "select distinct(cert.order_detail_id),cert.*,courses.name,ordered.order_status, order_detail.order_id from 
cert, courses, ordered, order_detail where cert.course='$id' and cert.course=courses.id and cert.order_detail_id=order_detail.id 
and order_detail.order_id=ordered.id and ordered.order_status='3' order by cert.date desc");

?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Course</h1>


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">List of Registered Users (Only the people filled out the certification form)</h6>
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

                        </tr>
                    </thead>
                   
                    <tbody> 
					<?php
					while($row=mysqli_fetch_array($res)){
						?>
                            <tr>
                                <td><?php echo $row[1] ?></td>
                                <td><?php echo $row[3] ?></a></td>
                                <td><?php echo $row[4] ?></td>
                                <td><?php echo $row[9] ?></td>
                                <td><?php echo $row[7] ?></td>
                                <td><?php echo $row[6] ?></td>
                                
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