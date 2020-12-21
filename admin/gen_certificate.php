<?php
require('top.php');

$user_id = $_SESSION['ADMIN_USERNAME'];
$sql = "SELECT * FROM cert";
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
                            <th>ID</th>
                            <th>Name</th>
                            <th>EMAIL</th>
                            <th>Course</th>
                            <th>Instructor</th> 
                            <th>Action</th>                      
                        </tr>
                    </thead>
                   
                    <tbody>
                        <?php
                        $i = 1;
                        while ($row = mysqli_fetch_assoc($res)) {
                        ?>
                            <tr>                           
                                <td><?php echo $row['idcert']; ?></td>
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo $row['email']; ?></td>
                                <td><?php echo $row['course']; ?></td>
                                <td><?php echo $row['instructor']; ?></td>
                                <td>
                                    <?php
                                    echo "<a href='testcert/gen_cert.php?id=".$row['idcert']."'><span class='btn btn-primary'>GEN CERT</span></a>&nbsp;";
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