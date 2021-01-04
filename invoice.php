<?php
include('vendor/autoload.php');
require('connection.php');
require('functions.php');

if(!isset($_SESSION['name'])){
	die();
}

$order_id=get_safe_value($con,$_GET['id']);

$css=file_get_contents('css/bootstrap.min.css');
$css.=file_get_contents('style.css');
$css.=file_get_contents('print.css');

$html='<div id="img1"><img src="image/uniten.png" width="180px" height="120px" alt=""/></div>
<p><strong> Universiti Tenaga Nasional (UNITEN)</strong><br/>
Putrajaya Campus<br/>
Jalan IKRAM-UNITEN<br/>
43000 Kajang, Selangor<br/>
MALAYSIA.</p>';

$username=$_SESSION['name'];
$html.='<div id="invoice">
<h2 style="margin-top:60px; margin-bottom:20px;font-weight:bold;">INVOICE</h2>
<p style= "margin-left:540px;">Invoice ID: <strong>#'.$order_id.'</strong></p>
<p style= "margin-left:540px;">To: <strong>'.$username.' </strong></p>
</div>


<div class="wishlist-table table-responsive">
   <table>
      <thead>
         <tr>
            <th class="product-thumbnail">Course Name</th>
            <th class="product-name">Qty</th>
            <th class="product-price">Price</th>
            <th class="product-price">Total Price</th>
         </tr>
      </thead>
      <tbody>';
		
		$res=mysqli_query($con, "select distinct(order_detail.id),order_detail.*, 				
		courses.name from order_detail, courses, ordered where 
		order_detail.order_id='$order_id' and ordered.user_name='$username' and order_detail.product_id=courses.id");
		$total_price=0;
		if(mysqli_num_rows($res)==0){
			die();
		}
		while($row=mysqli_fetch_assoc($res)){
			$total_price=$total_price+($row['quantity']*$row['price']);
			$pp=$row['quantity']*$row['price'];
         $html.='<tr>
            <td class="product-name">'.$row['name'].'</td>
            <td class="product-name">'.$row['quantity'].'</td>
            <td class="product-name">'.$row['price'].'</td>
            <td class="product-name">'.$pp.'</td>
         </tr>';
		 }
		 $html.= '<tr>
                 <td colspan="2"></td>
                 <td style="font-weight: bold;">Total Price</td>
                 <td>'.$total_price.'</td>
                 </tr>';
      $html.='</tbody>
   </table>
</div>';
		$html.='<p style="margin-top: 150px;">1. If your payment status is still in <strong>Pending</strong>, this means that you have not paid for the items you purchased.
				<br/>2. If your payment status is <strong>Success</strong>, then you have to wait for your confirmation email from UNITEN BDD.
				<br/>3. If you have paid and the status is still in <strong>Pending</strong>, then enquire through calling or emailing using the contact details given above.
				<br/><strong>Thank you for your cooperation. Register to more courses with us and get benefit!</strong></p>';
$mpdf=new \Mpdf\Mpdf();
$mpdf->WriteHTML($css,1);
$mpdf->WriteHTML($html,2);
$mpdf->Output();
?>
