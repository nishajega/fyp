<?php
require_once('vendor/autoload.php');

$stripe = [
  $secret_key = "stripe secret_key",
  $publishable_key = "pk_test_51Hj5MzB8kJYNGv8XYWUopeRBNqYgbgglAvKs5uUcK7mUCFbhEDDouR1Dja4BhZnR5nvBIObrS5l7VhVKNwcWrROg00WUFYgVPW",
];

\Stripe\Stripe::setApiKey($secret_key);
?>
