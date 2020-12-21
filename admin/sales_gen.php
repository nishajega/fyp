<?php
require('connection.php');
$qry ="SELECT * FROM invoice order by totalprice DESC limit 1";
$go = mysqli_query($con, $qry);
$row = mysqli_fetch_array($go);

$item = $row[2];
$qty = $row[3];
$pricetot = $row[4];
$dates = $row[6];



$choose_date = $_POST['date'];
$qry_month = "SELECT month('$choose_date'), sum(totalprice) from invoice";
$gos = mysqli_query($con, $qry_month);
$rows = mysqli_fetch_array($gos);
//echo $qry_month;
$monthz = $rows[0];
$ttl = $rows[1];

$qry_kos = "SELECT * FROM invoice ORDER BY quantity DESC LIMIT 1";
$gon = mysqli_query($con, $qry_kos);
$rowing = mysqli_fetch_array($gon);

$items = $rowing[2];
$qtys = $rowing[3];
$pricetots = $rowing[4];
$datess = $rowing[6];

$html = '
<html>
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
<td width="50%" style="color:#0000BB; "><span style="font-weight: bold; font-size: 25pt;">Sales Report</span></td>
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
<td align="center">'. $monthz .'</td>
<td align="center">RM ' . $ttl .'</td>
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
<td width="15%">Date</td>
</tr>
</thead>
<tbody>
<!-- ITEMS HERE -->
<tr>
<td align="center">'. $items .'</td>
<td align="center">' . $qtys .'</td>
<td align="center"> RM ' . $pricetots .'</td>
<td class="center">' . $datess .'</td>
</tr>
<!-- END ITEMS HERE -->
<tr>
</tbody>
</table>
<div style="text-align: center; font-style: italic;">Highest selling course by quantity</div>
<br />
<br />
<table class="items" width="100%" style="font-size: 9pt; border-collapse: collapse; " cellpadding="8">
<thead>
<tr>
<td width="45%">Course name</td>
<td width="10%">Quantity</td>
<td width="10">Total sales of this course</td>
<td width="15%">Date</td>
</tr>
</thead>
<tbody>
<!-- ITEMS HERE -->
<tr>
<td align="center">'. $item .'</td>
<td align="center">' . $qty .'</td>
<td align="center"> RM ' . $pricetot .'</td>
<td class="center">' . $dates .'</td>
</tr>
<!-- END ITEMS HERE -->
<tr>
</tbody>
</table>
<div style="text-align: center; font-style: italic;">Highest selling course</div>
</body>
</html>
';

require('../vendor/autoload.php');

$mpdf = new \Mpdf\Mpdf([
	'margin_left' => 20,
	'margin_right' => 15,
	'margin_top' => 48,
	'margin_bottom' => 25,
	'margin_header' => 10,
	'margin_footer' => 10
]);

$mpdf->SetProtection(array('print'));
$mpdf->SetTitle("Sales Report");
$mpdf->SetDisplayMode('fullpage');

$mpdf->WriteHTML($html);

$mpdf->Output();