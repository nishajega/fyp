<?php
require('connection.php');
require('addcart_inc.php');
require('functions.php');

$pid=get_safe_value($con,$_POST['pid']);
$quantity=get_safe_value($con,$_POST['quantity']);
$type=get_safe_value($con,$_POST['type']);

$obj=new add_to_cart();

if($type=='add'){
	$obj->addProduct($pid, $quantity);
}

if($type=='remove'){
	$obj->removeProduct($pid);
}

if($type=='update'){
	$obj->updateProduct($pid, $quantity);
}

echo $obj->totalProduct();
?>