<?php
require dirname(__DIR__) . DIRECTORY_SEPARATOR . "eepms\invoicr\invoicr.php";

require('connection.php');
$id = $_GET['id'];
// $stmt = "SELECT a.name as username, a.email as useremail, a.phonenum as phonenum, b.idinvoice as invoiceid, b.item as itemname,";
// $stmt .= "b.totalprice as totalprice, b.quantity as quantity FROM users_front a INNER JOIN invoice b ON a.id=b.userID WHERE a.id=$id";

$stmt = "SELECT * FROM invoice WHERE idinvoice=$id";
$qry = mysqli_query($con, $stmt);
$row = mysqli_fetch_assoc($qry);

//$username = $row['username'];
//$usermail = $row['useremail'];
//$phonenum = $row['phonenum'];
$invoiceid = $row['idinvoice'];
$itemname = $row['item'];
$totalprice = $row['totalprice'];
$quantity = $row['quantity'];
$address1 = $row['address_1'];
$address2 = $row['address_2'];
$city = $row['city'];
$state = $row['state'];
$postcode = $row['postcode'];

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
     
    ["Invoice #", "$invoiceid"]
      
    
  ]);
  // 2C - BILL TO
  $invoice->set("billto", [
    "$address1",
    "$address2", 
    "$city, $postcode"
  ]);
  
  // 2D - SHIP TO
  $invoice->set("shipto", [
    "Universiti Tenaga Nasional",
    "Jalan Ikram-Uniten", 
    "Kajang, 43000",
	"Putrajaya."
  ]);
  
  // 2E - ITEMS
  // YOU CAN JUST DUMP THE ENTIRE ARRAY IN USING SET, BUT HERE IS HOW TO ADD ONE AT A TIME... 
  $items = [
    ["$itemname", " ", $quantity, "-", "RM $totalprice"]
  ];
  foreach ($items as $i) { $invoice->add("items", $i); }
  
  // 2F - TOTALS
  $invoice->set("totals", [
    ["GRAND TOTAL", "RM $totalprice"]
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