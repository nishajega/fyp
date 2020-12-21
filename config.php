<?php
require_once('vendor/autoload.php');

$stripe = [
  "secret_key"      => "sk_test_51Hj5MzB8kJYNGv8XHRsaFwKs5qeftEKZ8yDu9S9tPZ35CD8LrxfrO1urJP0fF1zgZhtqY0b0yUgsnnB7TGFXLKHC00cgLMo8GG",
  "publishable_key" => "pk_test_51Hj5MzB8kJYNGv8XYWUopeRBNqYgbgglAvKs5uUcK7mUCFbhEDDouR1Dja4BhZnR5nvBIObrS5l7VhVKNwcWrROg00WUFYgVPW",
];

\Stripe\Stripe::setApiKey($stripe['secret_key']);
?>