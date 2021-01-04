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
    $update_status = "update courses set active='$status' where id='$id'";
    mysqli_query($con, $update_status);
  }

  if ($type == 'delete') {
    $id = get_safe_value($con, $_GET['id']);
    $delete_sql = "delete from courses where id='$id'";
    mysqli_query($con, $delete_sql);
  }
}
$sql = "SELECT * FROM courses WHERE status LIKE 'Approve'";
$res = mysqli_query($con, $sql);
?>

<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">Approved COURSES</h1>


  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">List of Approved Courses</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>#</th>
              <th>ID</th>
              <th>Categories</th>
              <th>Name</th>
              <th>Price</th>
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
                <td><?php echo $i; ?></td>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['categories_id']; ?></td>
                <td><a href="course_list.php?id=<?=$row['id'] ?>"><?php echo $row['name']; ?></a></td>
                <td><?php echo $row['price']; ?></td>
                <td><?php echo $row['instructor_name']; ?></td>
                
				<td>
				<?php
					  if($row['active']==1){
						  echo "<a href='?type=status&operation=deactive&id=".$row['id']."'><span class='btn btn-info'>Active</span></a>&nbsp;";
					  }else{
						  echo "<a href='?type=status&operation=active&id=".$row['id']."'><span class='btn btn-warning'>Deactive</span></a>&nbsp;";
					  }
					  echo "<a href='add_edit_course.php?id=".$row['id']."'><span class='btn btn-primary'>Edit</span></a>&nbsp;";
					  echo "<a href='?type=delete&id=".$row['id']."' onclick='return confirm_delete()'><span class='btn btn-danger'>Delete</span></a>";
					  
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
		return confirm('Are you sure you want to delete this category?');
		}
</script>

<?php
require('footer.php');
?>