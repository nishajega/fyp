<?php
class add_to_cart{
	function addProduct($pid, $quantity, $date){
		$_SESSION['cart'][$pid]['quantity']=$quantity;
		$_SESSION['cart'][$pid]['date']=$date;
	}
	function updateProduct($pid,$quantity){
		if(isset($_SESSION['cart'][$pid])){
			$_SESSION['cart'][$pid]['quantity']=$quantity;
		}
	}
	function removeProduct($pid){
		if(isset($_SESSION['cart'][$pid])){
			unset($_SESSION['cart'][$pid]);
		}
	}
	function emptyProduct(){
		unset($_SESSION['cart']);
	}
	function totalProduct(){
		if(isset($_SESSION['cart'])){
			return count($_SESSION['cart']);
		}else{
			return 0;
		}
	}
}


?>