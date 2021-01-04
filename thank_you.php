<?php
require('connection.php');
unset($_SESSION['cart']);
?>

<!doctype html>
<html class="no-js" lang="en">
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/js/bootstrap.min.js">
</head>

<div class="jumbotron text-center">
  <h1 class="display-3">Payment Succesful!</h1>
  <p class="lead">Thank you! Please check your order details in the purchase history.</p>
  <hr>
  <p>
    Having trouble? <a href="mailto: nishajeg27@gmail.com">Contact us</a>
  </p>
  <p class="lead">
    <a class="btn btn-primary btn-sm" href="my_order.php" role="button">Continue to order page</a>
  </p>
</div>