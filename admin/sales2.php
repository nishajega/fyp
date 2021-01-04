<?php
require('connection.php');
require('../vendor/autoload.php');
$month_select=$_POST['month'];
$sql="select DISTINCT(order_detail.product_id),sum(order_detail.quantity) as total, sum(order_detail.price) as 
	totalprice, courses.name,ordered.order_status, month(ordered.added_on) as month from order_detail, courses, ordered 
	where order_detail.product_id=courses.id and ordered.id=order_detail.order_id and ordered.order_status='3' 
	and month(ordered.added_on)='$month_select' group by order_detail.product_id";
	$res = mysqli_query($con, $sql);
		if($month_select=='1'){
			$months ="January";
		}
		if($month_select=='2'){
			$months ="February";
		}
		if($month_select=='3'){
			$months ="March";
		}
		if($month_select=='4'){
			$months ="April";
		}
		if($month_select=='5'){
			$months = "May";
		}
		if($month_select=='6'){
			$months ="June";
		}
		if($month_select=='7'){
			$months ="July";
		}
		if($month_select=='8'){
			$months ="August";
		}
		if($month_select=='9'){
			$months ="September";
		}
		if($month_select=='10'){
			$months ="October";
		}
		if($month_select=='11'){
			$months = "November";
		}
		if($month_select=='12'){
			$months ="December";
		}
		
$sql1="select DISTINCT(order_detail.product_id),sum(order_detail.quantity) as total, sum(order_detail.price) as totalprice, courses.name,
ordered.order_status, month(ordered.added_on) as month from order_detail, courses, ordered where order_detail.product_id=courses.id and 
ordered.id=order_detail.order_id and ordered.order_status='3' and month(ordered.added_on)='$month_select' group by month(ordered.added_on)";
$res2 = mysqli_query($con, $sql1);
$row1 = mysqli_fetch_assoc($res2);
	$totalamount=$row1['totalprice'];

		
$best="select DISTINCT(order_detail.product_id),sum(order_detail.quantity) as total, sum(order_detail.price) as 
	totalprice, courses.name,ordered.order_status, month(ordered.added_on) as month from order_detail, courses, ordered 
	where order_detail.product_id=courses.id and ordered.id=order_detail.order_id and ordered.order_status='3' 
	and month(ordered.added_on)='$month_select' group by product_id order by totalprice DESC limit 1";
	$best_seller=mysqli_query($con, $best);
	while($best_row = mysqli_fetch_assoc($best_seller)){
	$bestname=$best_row['name'];
	$besttotal=$best_row['total'];
	$bestprice=$best_row['totalprice'];
	}

$bestqty="select DISTINCT(order_detail.product_id),sum(order_detail.quantity) as total, sum(order_detail.price) as 
	totalprice, courses.name,ordered.order_status, month(ordered.added_on) as month from order_detail, courses, ordered 
	where order_detail.product_id=courses.id and ordered.id=order_detail.order_id and ordered.order_status='3' 
	and month(ordered.added_on)='$month_select' group by product_id order by total DESC limit 1";
	$best_seller_qty=mysqli_query($con, $bestqty);
	while($best_row_qty = mysqli_fetch_assoc($best_seller_qty)){
	$bestnameqty=$best_row_qty['name'];
    $besttotalqty=$best_row_qty['total'];
	$bestpriceqty=$best_row_qty['totalprice'];
	}
	
$leastqty="select DISTINCT(order_detail.product_id),sum(order_detail.quantity) as total, sum(order_detail.price) as 
	totalprice, courses.name,ordered.order_status, month(ordered.added_on) as month from order_detail, courses, ordered 
	where order_detail.product_id=courses.id and ordered.id=order_detail.order_id and ordered.order_status='3' 
	and month(ordered.added_on)='$month_select' group by product_id order by total ASC limit 1";
	$least_seller_qty=mysqli_query($con, $leastqty);
	while($least_row_qty = mysqli_fetch_assoc($least_seller_qty)){
	$leastnameqty=$least_row_qty['name'];
    $leasttotalqty=$least_row_qty['total'];
	$leastpriceqty=$least_row_qty['totalprice'];
	}
	
$least="select DISTINCT(order_detail.product_id),sum(order_detail.quantity) as total, sum(order_detail.price) as 
	totalprice, courses.name,ordered.order_status, month(ordered.added_on) as month from order_detail, courses, ordered 
	where order_detail.product_id=courses.id and ordered.id=order_detail.order_id and ordered.order_status='3' 
	and month(ordered.added_on)='$month_select' group by product_id order by totalprice ASC limit 1";
	$least_seller=mysqli_query($con, $least);
	while($least_row = mysqli_fetch_assoc($least_seller)){
	$leastname=$least_row['name'];
    $leasttotal=$least_row['total'];
	$leastprice=$least_row['totalprice'];
	}
	
$html='<html>
<head>
<style>
body {font-family: sans-serif;
	font-size: 10pt;
}
p {	margin: 0pt; }
table.items {
	border: 0.1mm solid #000000;
}
td { vertical-align: top; }
.items td {
	border-left: 0.1mm solid #000000;
	border-right: 0.1mm solid #000000;
}
table thead td { background-color: #EEEEEE;
	text-align: center;
	border: 0.1mm solid #000000;
	font-variant: small-caps;
}
.items td.blanktotal {
	background-color: #EEEEEE;
	border: 0.1mm solid #000000;
	background-color: #FFFFFF;
	border: 0mm none #000000;
	border-top: 0.1mm solid #000000;
	border-right: 0.1mm solid #000000;
}
.items td.totals {
	text-align: right;
	border: 0.1mm solid #000000;
}
.items td.cost {
	text-align: "." center;
}
</style>
</head>
<body>
<!--mpdf
<htmlpageheader name="myheader">
<table width="100%"><tr>
<td width="50%" style="color:#0000BB; "><span style="font-weight: bold; font-size: 25pt;">Sales Report of Executive Education Programme</span></td>
</tr></table>
</htmlpageheader>
<htmlpagefooter name="myfooter">
<div style="border-top: 1px solid #000000; font-size: 9pt; text-align: center; padding-top: 3mm; ">
Page {PAGENO} of {nb}
</div>
</htmlpagefooter>
<sethtmlpageheader name="myheader" value="on" show-this-page="1" />
<sethtmlpagefooter name="myfooter" value="on" />
mpdf-->
<div style="text-align: right"> Date: ' . date("Y-m-d") .'</div>
<br />
<table class="items" width="100%" style="font-size: 9pt; border-collapse: collapse; " cellpadding="8">
<thead>
<tr>
<td width="10%">Month</td>
<td width="10%">Total sales</td>
</tr>
</thead>
<tbody>
<!-- ITEMS HERE -->
<tr>
<td align="center">'. $months .'</td>
<td align="center">RM ' . $totalamount .'</td>
</tr>
<!-- END ITEMS HERE -->
<tr>
</tbody>
</table>
<div style="text-align: center; font-style: italic;">Total sales</div>
<br />
<br />
<table class="items" width="100%" style="font-size: 9pt; border-collapse: collapse; " cellpadding="8">
<thead>
<tr>
<td width="45%">Course name</td>
<td width="10%">Quantity</td>
<td width="10">Total sales of this course</td>
</tr>
</thead>
<tbody>
<!-- ITEMS HERE -->';
while($row = mysqli_fetch_assoc($res)){
	$name=$row['name'];
    $totalqty= $row['total'];
	$totalprice=$row['totalprice'];
$html='<tr>
<td align="center">'. $name .'</td>
<td align="center">' . $totalqty .'</td>
<td align="center"> RM ' . $totalprice .'</td>
</tr>
<!-- END ITEMS HERE -->
<tr>';
}
$html='</tbody>
</table>
<div style="text-align: center; font-style: italic;">List of courses sold this month</div>
<br />
<br />
<table class="items" width="100%" style="font-size: 9pt; border-collapse: collapse; " cellpadding="8">
<thead>
<tr>
<td width="45%">Course name</td>
<td width="10%">Quantity</td>
<td width="10">Total sales of this course</td>
</tr>
</thead>
<tbody>
<!-- ITEMS HERE -->
<tr>
<td align="center">'.$bestname.'</td>
<td align="center">' . $besttotal .'</td>
<td align="center"> RM ' . $bestprice .'</td>
</tr>
<!-- END ITEMS HERE -->
<tr>
</tbody>
</table>
<div style="text-align: center; font-style: italic;">Best Seller by Price</div>
<br />
<br />
<table class="items" width="100%" style="font-size: 9pt; border-collapse: collapse; " cellpadding="8">
<thead>
<tr>
<td width="45%">Course name</td>
<td width="10%">Quantity</td>
<td width="10">Total sales of this course</td>
</tr>
</thead>
<tbody>
<!-- ITEMS HERE -->
<tr>
<td align="center">'. $bestnameqty .'</td>
<td align="center">' . $besttotalqty .'</td>
<td align="center"> RM ' . $bestpriceqty .'</td>
</tr>
<!-- END ITEMS HERE -->
<tr>
</tbody>
</table>
<div style="text-align: center; font-style: italic;">Best Seller by Quantity</div>
<br />
<br />
<table class="items" width="100%" style="font-size: 9pt; border-collapse: collapse; " cellpadding="8">
<thead>
<tr>
<td width="45%">Course name</td>
<td width="10%">Quantity</td>
<td width="10">Total sales of this course</td>
</tr>
</thead>
<tbody>
<!-- ITEMS HERE -->
<tr>
<td align="center">'. $leastnameqty .'</td>
<td align="center">' . $leasttotalqty .'</td>
<td align="center"> RM ' . $leastpriceqty .'</td>
</tr>
<!-- END ITEMS HERE -->
<tr>
</tbody>
</table>
<div style="text-align: center; font-style: italic;">Least Sold by Quantity</div>
<br />
<br />
<table class="items" width="100%" style="font-size: 9pt; border-collapse: collapse; " cellpadding="8">
<thead>
<tr>
<td width="45%">Course name</td>
<td width="10%">Quantity</td>
<td width="10">Total sales of this course</td>
</tr>
</thead>
<tbody>
<!-- ITEMS HERE -->
<tr>
<td align="center">'. $leastname .'</td>
<td align="center">' . $leasttotal .'</td>
<td align="center"> RM ' . $leastprice .'</td>
</tr>
<!-- END ITEMS HERE -->
<tr>
</tbody>
</table>
<div style="text-align: center; font-style: italic;">Least Sold by Price</div>
</body>
</html>';



$mpdf = new \Mpdf\Mpdf();

$mpdf->WriteHTML($html);

$mpdf->Output();
?>
	