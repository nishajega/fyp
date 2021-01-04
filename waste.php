<?php
require_once('vendor/autoload.php');

$stripe = [
  $secret_key = "sk_test_51Hj5MzB8kJYNGv8XHRsaFwKs5qeftEKZ8yDu9S9tPZ35CD8LrxfrO1urJP0fF1zgZhtqY0b0yUgsnnB7TGFXLKHC00cgLMo8GG",
  $publishable_key = "pk_test_51Hj5MzB8kJYNGv8XYWUopeRBNqYgbgglAvKs5uUcK7mUCFbhEDDouR1Dja4BhZnR5nvBIObrS5l7VhVKNwcWrROg00WUFYgVPW",
];

\Stripe\Stripe::setApiKey($stripe['secret_key']);
?>


if(isset($_POST['submit'])){
	$address=get_safe_value($con,$_POST['address']);
	$city=get_safe_value($con,$_POST['city']); 
	$postcode=get_safe_value($con,$_POST['postcode']); 
	$payment_type=get_safe_value($con,$_POST['payment_type']);
	$user_name=$_SESSION['name'];
	foreach($_SESSION['cart'] as $key => $val){
		$productArr=get_product($con,'','',$key);
		$price=$productArr[0]['price'];
		$quantity=$val['quantity'];
		$cart_total=$cart_total+($price*$quantity);
	}
	$total_price= $cart_total;
	$payment_status='pending';
	if($payment_type=='Bank-In'){
		$payment_status='Success';
	}
	$order_status='1';
	$added_on=date('Y-m-d h:i:s');
	
	mysqli_query($con, "insert into `ordered`(user_name, address, city, postcode, payment_type, total_price, payment_status, order_status, added_on) values
	('$user_name', '$address', '$city', '$postcode', '$payment_type', '$total_price', '$payment_status', '$order_status', '$added_on')");

	$order_id=mysqli_insert_id($con);
	
	foreach($_SESSION['cart'] as $key => $val){
		$productArr=get_product($con,'','',$key);
		$price=$productArr[0]['price'];
		$quantity=$val['quantity'];
	
		mysqli_query($con, "insert into order_detail(order_id, product_id, quantity, price) values
		('$order_id', '$key', '$quantity', '$price')");
	}
	
	unset($_SESSION['cart'])
	?>
	<script>
		window.location.href='thank_you.php';
	</script>
	<?php
	
	
}

<?php
require dirname(__DIR__) . DIRECTORY_SEPARATOR . "eepms\invoicr\invoicr.php";

require('connection.php');
require('functions.php');
$order_id=get_safe_value($con, $_GET['id']);
// $stmt = "SELECT a.name as username, a.email as useremail, a.phonenum as phonenum, b.idinvoice as invoiceid, b.item as itemname,";
// $stmt .= "b.totalprice as totalprice, b.quantity as quantity FROM users_front a INNER JOIN invoice b ON a.id=b.userID WHERE a.id=$id";
$username=$_SESSION['name'];
$res=mysqli_query($con, "select distinct(order_detail.id),order_detail.*, 
courses.name,ordered.address,ordered.city,ordered.postcode, ordered.total_price from order_detail, courses, ordered where 
order_detail.order_id='$order_id' and ordered.user_name='$username' and order_detail.product_id=courses.id");
$total_price=0;
while($row=mysqli_fetch_assoc($res)){;
	$total_price=$row['total_price'];
	$address = $row['address'];
	$city = $row['city'];
	$postcode = $row['postcode'];
	$name= $row['name'];
	$quantity= $row['quantity'];
	$price= $row['price'];
	$subtotal=$row['quantity']*$row['price'];
}

$invoice = new Invoicr();

/* [STEP 2 - FEED ALL THE INFORMATION] */
// 2A - COMPANY INFORMATION
// OR YOU CAN PERMANENTLY CODE THIS INTO THE LIBRARY ITSELF
$invoice->set("company", [
    "download.jpg", 
    "UNITEN", 
    " ",
    " ",
    " ",
    " "
  ]);
  
  // 2B - INVOICE INFO
  $invoice->set("invoice", [
     
    ["Invoice #", ""]
      
    
  ]);
  // 2C - BILL TO
  $invoice->set("billto", [
    "$username",
	"$address", 
    "$city, $postcode"
  ]);
  
  // 2D - SHIP TO
  $invoice->set("shipfrom", [
    "Universiti Tenaga Nasional",
    "Jalan Ikram-Uniten", 
    "Kajang, 43000",
	"Putrajaya."
  ]);
  
  // 2E - ITEMS
  // YOU CAN JUST DUMP THE ENTIRE ARRAY IN USING SET, BUT HERE IS HOW TO ADD ONE AT A TIME... 
  $items = [
    ["$name", " ", $quantity, "RM $price", "RM $subtotal"]
  ];
  
  foreach ($items as $i) { $invoice->add("items", $i); }
  // 2F - TOTALS
  $invoice->set("totals", [
    ["GRAND TOTAL", "RM $total_price"]
  ]);
  
  // 2G - NOTES, IF ANY
  $invoice->set("notes", [
    "",
    ""
  ]);

  /* [STEP 3 - OUTPUT] */
// 3A - CHOOSE TEMPLATE, DEFAULTS TO SIMPLE IF NOT SPECIFIED
$invoice->template("apple");

// 3B - OUTPUT IN HTML
// DEFAULT DISPLAY IN BROWSER | 1 DISPLAY IN BROWSER | 2 FORCE DOWNLOAD | 3 SAVE ON SERVER
// $invoice->outputHTML();
$invoice->outputHTML(1);
// $invoice->outputHTML(2, "invoice.html");
// $invoice->outputHTML(3, __DIR__ . DIRECTORY_SEPARATOR . "invoice.html");

// 3C - PDF OUTPUT
// DEFAULT DISPLAY IN BROWSER | 1 DISPLAY IN BROWSER | 2 FORCE DOWNLOAD | 3 SAVE ON SERVER
// $invoice->outputPDF();
// $invoice->outputPDF(1);
// $invoice->outputPDF(2, "invoice.pdf");
// $invoice->outputPDF(3, __DIR__ . DIRECTORY_SEPARATOR . "invoice.pdf");

// 3D - DOCX OUTPUT
// DEFAULT FORCE DOWNLOAD| 1 FORCE DOWNLOAD | 2 SAVE ON SERVER
// $invoice->outputDOCX();
// $invoice->outputDOCX(1, "invoice.docx");
// $invoice->outputDOCX(2, __DIR__ . DIRECTORY_SEPARATOR . "invoice.docx");



<script type="text/javascript">
    $(function () {
        $("#type").change(function () {
            if ($(this).val() == "physical") {
                $("#date").show();
            } else {
                $("#date").hide();
            }
        });
    });
</script>


$dates=$productArr[0]['dates'];
$date1=$productArr[0]['dates2'];
$date2=$productArr[0]['dates2'];
$date3=$productArr[0]['dates3'];

<script>
function updateState(context){
 context.setAttribute('disabled',true)

}
</script>
 onclick="updateState(this)"

echo $names[$key] . "<br /> " . $email[$key] . "<br />";

select order_detail.*,sum(order_detail.quantity) as total, sum(order_detail.price) as totalprice, courses.name,ordered.order_status, month(ordered.added_on) as month from order_detail, courses, ordered where order_detail.product_id=courses.id and ordered.id=order_detail.order_id and ordered.order_status='3' group by order_detail.product_id and month and order_detail.date