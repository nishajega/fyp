<?php
require('top.php');
require('functions.php');
?>

<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Cart || Asbab - eCommerce HTML5 Template</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Place favicon.ico in the root directory -->
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    

    <!-- All css files are included here. -->
    <!-- Bootstrap fremwork main css -->
    
    <!-- Owl Carousel min css -->
    <link rel="stylesheet" href="user/css/owl.carousel.min.css">
    <link rel="stylesheet" href="user/css/owl.theme.default.min.css">
    <!-- This core.css file contents all plugings css file. -->
    
    <!-- Theme shortcodes/elements style -->
    <link rel="stylesheet" href="user/css/shortcode/shortcodes.css">
    <!-- Theme main style -->
    <link rel="stylesheet" href="user/style.css">
    <!-- Responsive css -->
    <link rel="stylesheet" href="user/css/responsive.css">
    <!-- User style -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="user/css/custom.css">
	<style>
	h2{
		margin-left:60px;
		margin-top: 100px;
		margin-bottom: 30px;
		font-size: 40px;
		font-weight: bold;
	}
	.product-name{
		font-weight: bold;
	}
	
	</style>
    <!-- Modernizr JS -->
    <script src="user/js/vendor/modernizr-3.5.0.min.js"></script>
</head>

<body>
    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->  

    <!-- Body main wrapper start -->
    <div class="wrapper">
        <!-- Start Header Style -->
        <!-- cart-main-area start -->
        <div class="cart-main-area ptb--100 bg__white">
		<h2>YOUR CART</h2>
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <form action="#">               
                            <div class="table-content table-responsive">
                                <table>
                                    <thead>
                                        <tr>
                                            <th class="product-name">Course name</th>
                                            <th class="product-price">Price</th>
                                            <th class="product-quantity">Quantity</th>
                                            <th class="product-subtotal">Total</th>
                                            <th class="product-remove">Remove</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
									$cart_total=0;
									if(isset($_SESSION['cart'])){
										foreach($_SESSION['cart'] as $key => $val){
										$productArr=get_product($con,'','',$key);
										$pname=$productArr[0]['name'];
										$price=$productArr[0]['price'];
										$quantity=$val['quantity'];
										$date=$val['date'];
										$cart_total=$cart_total+($price*$quantity);
									
									?>
				
                                        <tr>
                                            <td class="product-name"><?php echo $pname ?><br><?php echo $date ?></td>
                                            <td class="product-price"><span class="amount"> RM <?php echo $price ?></span></td>
                                            <td class="product-quantity"><input type="number" id="<?php echo $key?>quantity" value="<?php echo $quantity ?>" />
											<br/><a href="javascript:void(0)" onclick="manage_cart('<?php echo $key?>','update')">UPDATE</a></td>
                                            <td class="product-subtotal"> RM <?php echo $quantity*$price ?></td>
                                            <td class="product-remove"><a href="javascript:void(0)" onclick="manage_cart('<?php echo $key?>','remove')"><i class="fa fa-times"></i></a></td>
                                        </tr>
									<?php } } ?>
									
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="buttons-cart--inner">
                                        <div class="buttons-cart">
                                            <a href="course2.php">Continue Shopping</a>
                                        </div>
                                        <div class="buttons-cart checkout--btn">
                                            <a href="check.php">checkout</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form> 
                    </div>
                </div>
            </div>
        </div>
        <!-- cart-main-area end -->
<!-- Footer-->
        <footer class="bg-light py-5">
            <div class="container"><div class="small text-center text-muted">Copyright © 2020 - Start Bootstrap</div></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
        <!-- Third party plugin JS-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/cart.js"></script>
		

</body>
</html>