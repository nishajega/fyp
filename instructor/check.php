<?php
require('connection.php');

$id=mysqli_real_escape_string($con, $_GET['id']);

$query=mysqli_query($con, "update instructor set verification='1' where verification_id='$id'");

?>
<script>
	alert("Account has been verified!");
	window.location.href='login.php';
</script>