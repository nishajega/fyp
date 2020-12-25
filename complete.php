<?php
require_once('config.php');
require('connection.php');

if(isset($_POST['stripeToken'])){
	
$userid=$_SESSION['user_id'];
$res=mysqli_query($con, "update ordered set payment_status='Success' where user_name='$userid'");
$stmt="SELECT * FROM users_front WHERE name='$userid'";
$sql = mysqli_query($con, $stmt);
while($row = mysqli_fetch_assoc($sql)){;

	$email=$row['email'];
	$id=$_SESSION['user_id'];
}

$token  = $_POST['stripeToken'];
$email  = $_POST['stripeEmail'];
$pay = $_POST['stripe-amount'];
$desc = $_POST['stripe-desc'];

$customer = \Stripe\Customer::create([
    'email' => $email,
    'source'  => $token,
]);

$charge = \Stripe\Charge::create([
    'customer' => $customer->id,
    'amount'   => $pay,
    'currency' => 'myr',
    'description' => $desc
]);
}else{
	?>
	<script>
		window.location.href='thank_you.php';
	</script>
	<?php
}

//echo '<h1>Successfully charged $50.00!</h1>';
?>


