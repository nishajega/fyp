<?php
require('config.php');
if(isset($_POST['stripeToken'])){
	\Stripe\Stripe::setVerifySslCerts(false);

	$token=$_POST['stripeToken'];

	$data=\Stripe\Charge::create(array(
		"amount"=>$total_price,
		"currency"=>"myr",
		"description"=>"",
		"source"=>$token,
	));

	echo "<pre>";
	print_r($data);
}
?>