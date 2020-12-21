<?php
require('top.php');

$user_id = $_SESSION['ADMIN_USERNAME'];
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
        $update_status = "update courses set status='$status' where id='$id'";
        mysqli_query($con, $update_status);
    }

    if ($type == 'delete') {
        $id = get_safe_value($con, $_GET['id']);
        $delete_sql = "delete from courses where id='$id'";
        mysqli_query($con, $delete_sql);
    }
}
$sql = "SELECT * FROM instructor";
$res = mysqli_query($con, $sql);
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">INSTRUCTOR</h1>


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
                            <th>#</th>
                            <th>ID</th>
                            <th>Name</th>
                            <th>EMAIL</th>
                            <th>IC no.</th>
                            <th>Phone no.</th>
                            <th>Status</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                   
                    <tbody>
                        <?php
                        $i = 1;
                        while ($row = mysqli_fetch_assoc($res)) {
                        ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo $row['email']; ?></td>
                                <td><?php echo $row['icnum']; ?></td>
                                <td><?php echo $row['phonenum']; ?></td>
                                <td><?php echo $row['status']; ?></td>
                                <td>
                                    <?php
                                    echo "<a href='instructor_delete.php?id=" . $row['id'] . "' onclick='return confirm_delete()'><span class='btn btn-primary'>DISABLE</span></a>&nbsp;";
									echo "<a href='instructor_activate.php?id=" . $row['id'] . "' onclick='return confirm_active()'><span class='btn btn-primary'>ABLE</span></a>&nbsp;";
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