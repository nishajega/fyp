<?php
function pr($arr){
	echo '<pre>';
	print_r($arr);
}

function prx($arr){
	echo'<pre>';
	print_r($arr);
	die();
}

function get_safe_value($con,$str){
	if($str!=''){
		$str=trim($str);
		return mysqli_real_escape_string($con,$str);
	}
}

function get_product($con,$limit='',$cat_id='',$id=''){
	$sql="select * from courses where status='Approve' ";
	if($cat_id!=''){
		$sql.=" and categories_id=$cat_id";
	}
	if($id!=''){
		$sql.=" and id=$id";
	}
	$sql.=" order by id desc";
	if($limit!=''){
		$sql.=" limit $limit";
	}
	
	$res=mysqli_query($con,$sql);
	$data=array();
	if($res){
		while($row=mysqli_fetch_assoc($res)){
			$data[]=$row;
		}
		return $data;
	}
}

?>