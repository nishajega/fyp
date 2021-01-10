<?php
require('top.php');

$user_id = $_SESSION['instructor_name'];
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

	if ($type == 'clear') {
		$id = get_safe_value($con, $_GET['id']);
		$delete_sql = "delete from courses where id='$id'";
		mysqli_query($con, $delete_sql);
	}
}
$sql = "select courses.*, categories.categories from courses, categories where courses.categories_id=categories.id and courses.instructor_name='$user_id' and courses.status='Approve' order by courses.id desc";
$res = mysqli_query($con, $sql);
?>

<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<h1 class="h3 mb-2 text-gray-800">APPROVED COURSES</h1>


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
							<th>ID</th>
							<th>Categories</th>
							<th>Name</th>
							<th>Price</th>
							<th>Duration</th>
							<th>Status</th>
							<th>Action</th>

						</tr>
					</thead>
					<tfoot>
						<tr>
							<th>ID</th>
							<th>Categories</th>
							<th>Name</th>
							<th>Price</th>
							<th>Duration</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</tfoot>
					<tbody>
						<?php
						while ($row = mysqli_fetch_assoc($res)) :
						?>
							<tr>
								<td><?php echo $row['id']; ?></td>
								<td><?php echo $row['categories']; ?></td>
								<td><a href="course_list.php?id=<?=$row['id'] ?>"><?php echo $row['name']; ?></td>
								<td><?php echo $row['price']; ?></td>
								<td><?php echo $row['duration']; ?></td>
								<td><?php echo $row['status']; ?></td>
								<td>
									<?php if ($row['status'] == 'Pending') : ?>
										<a href='edit_course.php?id=<?= $row["id"] ?>' ><span class='btn btn-primary'>Edit</span></a>
									<?php elseif ($row['status'] == 'Approve') : ?>
										<a href='edit_course_approve.php?id=<?= $row["id"] ?>' ><span class='btn btn-primary'>Edit</span></a>
									<?php else : ?>
										<a href='course.php?id=<?=$row['id'] ?>"&type=clear' onclick="return confirm('Are you sure you want to delete this item?');"><span class='btn btn-primary'>Clear</span></a>
									<?php endif; ?>
								</td>
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