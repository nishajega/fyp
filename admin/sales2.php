<?php
include('../vendor/autoload.php');
require('connection.php');
require('functions.php');

$month_select=$_POST['month'];
$year_select=$_POST['year'];
	$sql="select DISTINCT(order_detail.product_id),sum(order_detail.quantity) as total, sum(order_detail.price*order_detail.quantity) as 
	totalprice, courses.name,ordered.order_status, month(ordered.added_on) as month from order_detail, courses, ordered 
	where order_detail.product_id=courses.id and ordered.id=order_detail.order_id and ordered.order_status='3' 
	and month(ordered.added_on)='$month_select' and year(ordered.added_on)='$year_select' group by order_detail.product_id";
	$res = mysqli_query($con, $sql);
	if($month_select=='1'){
		$months="January";
	}
	if($month_select=='2'){
		$months="February";
	}
	if($month_select=='3'){
		$months="March";
	}
	if($month_select=='4'){
		$months="April";;
	}
	if($month_select=='5'){
		$months="May";
	}
	if($month_select=='6'){
		$months="June";
	}
	if($month_select=='7'){
		$months="July";
	}
	if($month_select=='8'){
		$months="August";;
	}
	if($month_select=='9'){
		$months="September";;
	}
	if($month_select=='10'){
		$months="October";
	}
	if($month_select=='11'){
		$months="November";
	}
	if($month_select=='12'){
		$months="December";
	}

$css=file_get_contents('../css/bootstrap.min.css');
$css.=file_get_contents('../style.css');
$css.=file_get_contents('../print.css');

$html='<div id="img1"><img src="image/uniten.png" width="180px" height="120px" alt=""/></div>
<p><strong> Universiti Tenaga Nasional (UNITEN)</strong><br/>
Putrajaya Campus<br/>
Jalan IKRAM-UNITEN<br/>
43000 Kajang, Selangor<br/>
MALAYSIA.</p>';

$html.='<div id="invoice">
<h2 style="margin-top:60px; margin-bottom:20px;font-weight:bold;">SALES REPORT</h2>
<p style= "margin-left:520px;">Month:<strong>'.$months.'</strong></p>
<p style= "margin-left:520px;">Year:<strong>'.$year_select.'</strong></p>
</div>

<div class="wishlist-table table-responsive">
   <table>
      <thead>
         <tr>
            <th class="product-name"><b>Course Name</b></th>
            <th class="product-thumbnail"><b>No.of Pax</b></th>
            <th class="product-price"><b><b>Price</b></b></th>
         </tr>
      </thead>
      <tbody>';
		$sql="select DISTINCT(order_detail.product_id),sum(order_detail.quantity) as total, sum(order_detail.price*order_detail.quantity) as 
		totalprice, courses.name,ordered.order_status, month(ordered.added_on) as month from order_detail, courses, ordered 
		where order_detail.product_id=courses.id and ordered.id=order_detail.order_id and ordered.order_status='3' 
		and month(ordered.added_on)='$month_select' group by order_detail.product_id";
		$res = mysqli_query($con, $sql);
		 while ($row = mysqli_fetch_assoc($res)):
         $html.='<tr>
            <td class="product-name">'.$row['name'].'</td>
            <td class="product-name">'.$row['total'].'</td>
            <td class="product-name">'.$row['totalprice'].'</td>
         </tr>';
		 endwhile;
		 $html.= '<tr>
                 <td colspan="3" style="font-weight: bold;">Sales of the Month</td>
                 </tr>';
      $html.='</tbody>
   </table>
</div><br><br>
<div class="wishlist-table table-responsive">
   <table>
      <thead>
         <tr>
            <th class="product-name"><b>Course Name</b></th>
            <th class="product-thumbnail"><b>No.of Pax</b></th>
            <th class="product-price"><b>Price</b></th>
         </tr>
      </thead>
      <tbody>';
		$bestqty="select DISTINCT(order_detail.product_id),sum(order_detail.quantity) as total, sum(order_detail.price*order_detail.quantity) as 
				totalprice, courses.name,ordered.order_status, month(ordered.added_on) as month from order_detail, courses, ordered 
				where order_detail.product_id=courses.id and ordered.id=order_detail.order_id and ordered.order_status='3' 
				and month(ordered.added_on)='$month_select' and year(ordered.added_on)='$year_select' group by product_id order by total, totalprice DESC limit 1";
		$best_seller_qty=mysqli_query($con, $bestqty);
		 while ($best_row_qty = mysqli_fetch_assoc($best_seller_qty)) :
         $html.='<tr>
            <td class="product-name">'.$best_row_qty['name'].'</td>
            <td class="product-name">'.$best_row_qty['total'].'</td>
            <td class="product-name">'.$best_row_qty['totalprice'].'</td>
         </tr>';
		 endwhile;
		 $html.= '<tr>
                 <td colspan="3" style="font-weight: bold;">Most Demanding Course (by Quantity)</td>
                 </tr>';
      $html.='</tbody>
   </table>
</div><br><br>
<div class="wishlist-table table-responsive">
   <table>
      <thead>
         <tr>
            <th class="product-name"><b>Course Name</b></th>
            <th class="product-thumbnail"><b>No.of Pax</b></th>
            <th class="product-price"><b>Price</b></th>
         </tr>
      </thead>
      <tbody>';
		$best="select DISTINCT(order_detail.product_id),sum(order_detail.quantity) as total, sum(order_detail.price*order_detail.quantity) as 
			totalprice, courses.name,ordered.order_status, month(ordered.added_on) as month from order_detail, courses, ordered 
			where order_detail.product_id=courses.id and ordered.id=order_detail.order_id and ordered.order_status='3' 
			and month(ordered.added_on)='$month_select' and year(ordered.added_on)='$year_select' group by product_id order by totalprice DESC limit 1";
		$best_seller=mysqli_query($con, $best);
		 while ($best_row = mysqli_fetch_assoc($best_seller)) :
         $html.='<tr>
            <td class="product-name">'.$best_row['name'].'</td>
            <td class="product-name">'.$best_row['total'].'</td>
            <td class="product-name">'.$best_row['totalprice'].'</td>
         </tr>';
		 endwhile;
		 $html.= '<tr>
                 <td colspan="3" style="font-weight: bold;">Most Demanding Course (by Price)</td>
                 </tr>';
      $html.='</tbody>
   </table>
</div><br><br><br><br>
<div class="wishlist-table table-responsive">
   <table>
      <thead>
         <tr>
            <th class="product-name"><b>Course Name</b></th>
            <th class="product-thumbnail"><b>No.of Pax</b></th>
            <th class="product-price"><b>Price</b></th>
         </tr>
      </thead>
      <tbody>';
		$least="select DISTINCT(order_detail.product_id),sum(order_detail.quantity) as total, sum(order_detail.price*order_detail.quantity) as 
				totalprice, courses.name,ordered.order_status, month(ordered.added_on) as month from order_detail, courses, ordered 
				where order_detail.product_id=courses.id and ordered.id=order_detail.order_id and ordered.order_status='3' 
				and month(ordered.added_on)='$month_select' and year(ordered.added_on)='$year_select' group by product_id order by total,totalprice ASC limit 1";
			$least_seller=mysqli_query($con, $least);
		 while ($least_row = mysqli_fetch_assoc($least_seller)) :
         $html.='<tr>
            <td class="product-name">'.$least_row['name'].'</td>
            <td class="product-name">'.$least_row['total'].'</td>
            <td class="product-name">'.$least_row['totalprice'].'</td>
         </tr>';
		 endwhile;
		 $html.= '<tr>
                 <td colspan="3" style="font-weight: bold;">Least Demanding Course of the Month</td>
                 </tr>';
      $html.='</tbody>
   </table>
</div><br><br>';

$mpdf=new \Mpdf\Mpdf();
$mpdf->WriteHTML($css,1);
$mpdf->WriteHTML($html,2);
$mpdf->Output();
?>
?>
	