<?php
require('top.php');
$id=get_safe_value($con, $_GET['id']);
$res=mysqli_query($con, "select cert.*,courses.name from cert, courses where cert.course=courses.id and cert.course='$id' order by date");

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
                                <td><?php echo $row[0] ?></td>
                                <td><?php echo $row[2] ?></a></td>
                                <td><?php echo $row[3] ?></td>
                                <td><?php echo $row[8] ?></td>
                                <td><?php echo $row[6] ?></td>
                                <td><?php echo $row[5] ?></td>
                                
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