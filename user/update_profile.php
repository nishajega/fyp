<?php
require('connection.php');
require('../functions.php');
if(!isset($_SESSION['user_login'])){
	?>
	<script>
	window.location.href='index.php';
	</script>
	<?php
}

$name=get_safe_value($con,$_POST['name']);
$uid=$_SESSION['user_id'];
mysqli_query($con,"update users_front set name='$name' where id='$uid'");
$_SESSION['name']=$name;
echo "Your name is updated";
?>