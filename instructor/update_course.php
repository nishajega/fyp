<?php
require('connection.php');
if (isset($_POST['submit'])) {
	$id = $_POST['id'];
    $categories_id = $_POST['categories_id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $overview = $_POST['overview'];
    $audience_limit = $_POST['audience_limit'];
    $duration = $_POST['duration'];
    $price = $_POST['price'];
    $dates = $_POST['dates'];
    $instructor_name = $_POST['instructor_name'];

	$query =  "UPDATE courses SET categories_id=$categories_id,name='$name',description='$description',";
	$query.=  "overview='$overview',audience_limit='$audience_limit',duration='$duration',price=$price,dates='$dates' WHERE id='$id'";

	echo $query;
	mysqli_query($con, $query);
	header('Location:edit_course.php?id='.$id);

}