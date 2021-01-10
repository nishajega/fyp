<?php
require('connection.php');
require('functions.php');
if (isset($_POST['submit'])) {
	$categories_id = get_safe_value($con, $_POST['categories_id']);
    $name = get_safe_value($con, $_POST['name']);
    $description = get_safe_value($con, $_POST['description']);
    $overview = get_safe_value($con, $_POST['overview']);
    $audience_limit = get_safe_value($con, $_POST['audience_target']);
    $duration = get_safe_value($con, $_POST['duration']);
    $price = get_safe_value($con, $_POST['price']);
    $dates = get_safe_value($con, $_POST['dates']);
	$dates2 = get_safe_value($con, $_POST['dates2']);
	$dates3 = get_safe_value($con, $_POST['dates3']);
	$dates4 = get_safe_value($con, $_POST['dates4']);
	
	if (isset($_GET['id']) && $_GET['id'] != '') {
		$query =  "UPDATE courses SET categories_id='$categories_id',name='$name',description='$description',
		overview='$overview',audience_target='$audience_target',duration='$duration',price='$price',dates='$dates',dates2='$dates2',dates3='$dates3',
		dates4='$dates4' WHERE id='$id'";
		mysqli_query($con, $query);
		?>
		<script>
			window.location.href='approved_course.php';
		</script>
		<?php
	}
}
?>