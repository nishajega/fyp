<?php
require('connection.php');
if (isset($_POST['submit'])) {
	$id = $_POST['id'];
    $categories_id = $_POST['categories_id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $overview = $_POST['overview'];
    $audience_target = $_POST['audience_target'];
    $duration = $_POST['duration'];
    $price = $_POST['price'];
    $dates = $_POST['dates'];
	$dates2 = $_POST['dates2'];
	$dates3 = $_POST['dates3'];
	$dates4 = $_POST['dates4'];
    $instructor_name = $_POST['instructor_name'];

	echo "UPDATE courses SET categories_id=$categories_id,name='$name',description='$description',",
	"overview='$overview',audience_target='$audience_target',duration='$duration',price=$price,dates='$dates', dates2='$dates2',
	dates3='$dates3', dates4='$dates4' WHERE id='$id'";
	
	$query =  "UPDATE courses SET categories_id=$categories_id,name='$name',description='$description',";
	$query.=  "overview='$overview',audience_target='$audience_target',duration='$duration',price=$price,dates='$dates', dates2='$dates2',
	dates3='$dates3', dates4='$dates4' WHERE id='$id'";

	echo $query;
	mysqli_query($con, $query);
	header('Location:edit_course.php?id='.$id);

}