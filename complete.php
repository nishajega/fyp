<?php
require_once('config.php');
require('connection.php');
require('functions.php');

if(isset($_POST['stripeToken'])){

// $userid=$_SESSION['user_id'];
// echo $userid;
// $qry= 
// echo $qry;
// $res=mysqli_query($con, $qry);
// $stmt="SELECT * FROM users_front WHERE name='$userid'";
// $sql = mysqli_query($con, $stmt);
// while($row = mysqli_fetch_assoc($sql)){;

// 	$email=$row['email'];
// 	$id=$_SESSION['user_id'];
// }
$token  = $_POST['stripeToken'];
$email  = $_POST['stripeEmail'];
$pay = $_POST['stripe-amount'];
$desc = $_POST['stripe-desc'];

$qry = "SELECT * FROM ordered order BY id DESC LIMIT 1";
$go = mysqli_query($con, $qry);
$row_order = mysqli_fetch_array($go);
	if ($row_order[0] > 0){
		$id = $row_order[0];
		$qry_update = "UPDATE ordered SET payment_status='Success', token='$token' WHERE id=$id";
		mysqli_query($con, $qry_update);

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
		?>
		<script>
			window.location.href='thank_you.php';
		</script>
		<?php
		
	}
}

//echo '<h1>Successfully charged $50.00!</h1>';
?>


