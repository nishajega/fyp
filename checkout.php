<?php
//session_start();
require('header.php');
require("admin/functions.php");
require_once('./config.php');
error_reporting(0);
if (!isset($_SESSION['name'])) {

    header('Location: student_login_checkout.php');
} else {

    $nameuser = $_SESSION['name'];
    $qty = $_POST['quantity'];
    $name = $_POST['name'];
    $id = $_POST['id'];
    $total_price = $_POST['total_price'];
    $qtyitem = $_POST['total_quantity'];
    $dates = $_POST['dates'];

    $stmt = "SELECT * FROM users_front WHERE name LIKE '$nameuser'";
    //echo $stmt;
    $res = mysqli_query($con, $stmt);
    $row = mysqli_fetch_assoc($res);

    $email = $row['email'];
    $id_users = $row['id'];
    $name_1 = $name[0];
    $name_2 = $name[1];

    $stmt_invc = "INSERT INTO invoice (userID, item, quantity, totalprice, dates) VALUES ($id_users, '$name_1', $qtyitem, $total_price, '$dates')";
    $stmt_invc_qr = mysqli_query($con, $stmt_invc);
    //$res = 

    echo $stmt_invc;
   

    //echo $name_1;

    //echo $stmt;
    //     $namenew = json_encode($name);

    //    echo $namenew;

    // foreach ($name as $names) :
    //     echo $names;

    // endforeach;

    // echo $qty;



    //echo $total_price;




    // foreach($id as $ids){
    // echo $ids;
    // }
}

?>

<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Checkout || Asbab - eCommerce HTML5 Template</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Place favicon.ico in the root directory -->
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
    <link rel="apple-touch-icon" href="apple-touch-icon.png">


    <!-- All css files are included here. -->
    <!-- Bootstrap fremwork main css -->
    <link rel="stylesheet" href="user/css/bootstrap.min.css">
    <!-- Owl Carousel min css -->
    <link rel="stylesheet" href="user/css/owl.carousel.min.css">
    <link rel="stylesheet" href="user/css/owl.theme.default.min.css">
    <!-- This core.css file contents all plugings css file. -->
    <link rel="stylesheet" href="user/css/core.css">
    <!-- Theme shortcodes/elements style -->
    <link rel="stylesheet" href="user/css/shortcode/shortcodes.css">
    <!-- Theme main style -->
    <link rel="stylesheet" href="user/style.css">
    <!-- Responsive css -->
    <link rel="stylesheet" href="user/css/responsive.css">
    <!-- User style -->
    <link rel="stylesheet" href="user/css/custom.css">


    <!-- Modernizr JS -->
    <script src="user/js/vendor/modernizr-3.5.0.min.js"></script>
</head>

<div class="wrapper">
    <!-- Start Header Style -->
    <!-- End Header Area -->
    <div class="body__overlay"></div>
    <!-- Start Offset Wrapper -->
    <div class="offset__wrapper">
        <!-- Start Search Popap -->
        <div class="search__area">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="search__inner">
                            <form action="#" method="get">
                                <input placeholder="Search here... " type="text">
                                <button type="submit"></button>
                            </form>
                            <div class="search__close__btn">
                                <span class="search__close__btn_icon"><i class="zmdi zmdi-close"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Search Popap -->

    </div>
    <div class="checkout-wrap ptb--100">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <div class="order-details">
                        <h5 class="order-details__title">Your Order</h5>
                        <?php foreach ($name as $names) : ?>
                            <div class="order-details__item">
                                <div class="single-item">
                                    <div class="single-item__content">
                                        <a href="#"><?= $names ?></a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <div class="order-details__count">
                            <div class="order-details__count__single">
                                <h5>Item quantity</h5>
                                <span class="price">X <?= $qtyitem ?></span>
                            </div>
                        </div>
                        <div class="order-details__count">
                            <div class="order-details__count__single">
                                <h5>sub total</h5>
                                <span class="price">RM<?= $total_price ?></span>
                            </div>
                        </div>
                        <div class="ordre-details__total">
                            <h5>Order total</h5>
                            <span class="price">RM<?= $total_price ?></span>
                        </div>
                        <div class="ordre-details__total">
                            <form action="charge.php" method="post">
                                <script src="https://checkout.stripe.com/checkout.js"
                                  class="stripe-button"
                                  data-key="<?php echo $stripe['publishable_key']; ?>" 
                                  data-description="Buy course" data-amount="<?= $total_price ?>00" 
                                  data-locale="auto"></script>
                                  <input type="hidden" value="<?= $total_price ?>00" name="stripe-amount">
                                  <input type="hidden" value="COURSE NAME: <?= $name_1 ?> QUANTITY: <?= $qtyitem ?>" name="stripe-desc">

                                  <?php if($name_2 > 0): ?>
                                    <input type="hidden" value="COURSE NAME: <?= $name_1 ?>,<?= $name_2 ?> QUANTITY: <?= $qtyitem ?>" name="stripe-desc">
                                  <?php endif; ?>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- cart-main-area end -->
    <!-- Start Footer Area -->
    <footer id="htc__footer">
        <!-- Start Footer Widget -->
        <div class="footer__container bg__cat--1">
            <div class="container">
                <div class="row">
                    <!-- Start Single Footer Widget -->
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="footer">
                            <h2 class="title__line--2">ABOUT US</h2>
                            <div class="ft__details">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim</p>
                                <div class="ft__social__link">
                                    <ul class="social__link">
                                        <li><a href="#"><i class="icon-social-twitter icons"></i></a></li>

                                        <li><a href="#"><i class="icon-social-instagram icons"></i></a></li>

                                        <li><a href="#"><i class="icon-social-facebook icons"></i></a></li>

                                        <li><a href="#"><i class="icon-social-google icons"></i></a></li>

                                        <li><a href="#"><i class="icon-social-linkedin icons"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Footer Widget -->
                    <!-- Start Single Footer Widget -->
                    <div class="col-md-2 col-sm-6 col-xs-12 xmt-40">
                        <div class="footer">
                            <h2 class="title__line--2">information</h2>
                            <div class="ft__inner">
                                <ul class="ft__list">
                                    <li><a href="#">About us</a></li>
                                    <li><a href="#">Delivery Information</a></li>
                                    <li><a href="#">Privacy & Policy</a></li>
                                    <li><a href="#">Terms & Condition</a></li>
                                    <li><a href="#">Manufactures</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Footer Widget -->
                    <!-- Start Single Footer Widget -->
                    <div class="col-md-2 col-sm-6 col-xs-12 xmt-40 smt-40">
                        <div class="footer">
                            <h2 class="title__line--2">my account</h2>
                            <div class="ft__inner">
                                <ul class="ft__list">
                                    <li><a href="#">My Account</a></li>
                                    <li><a href="cart.html">My Cart</a></li>
                                    <li><a href="#">Login</a></li>
                                    <li><a href="wishlist.html">Wishlist</a></li>
                                    <li><a href="checkout.html">Checkout</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Footer Widget -->
                    <!-- Start Single Footer Widget -->
                    <div class="col-md-2 col-sm-6 col-xs-12 xmt-40 smt-40">
                        <div class="footer">
                            <h2 class="title__line--2">Our service</h2>
                            <div class="ft__inner">
                                <ul class="ft__list">
                                    <li><a href="#">My Account</a></li>
                                    <li><a href="cart.html">My Cart</a></li>
                                    <li><a href="#">Login</a></li>
                                    <li><a href="wishlist.html">Wishlist</a></li>
                                    <li><a href="checkout.html">Checkout</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- End Single Footer Widget -->
                    <!-- Start Single Footer Widget -->
                    <div class="col-md-3 col-sm-6 col-xs-12 xmt-40 smt-40">
                        <div class="footer">
                            <h2 class="title__line--2">NEWSLETTER </h2>
                            <div class="ft__inner">
                                <div class="news__input">
                                    <input type="text" placeholder="Your Mail*">
                                    <div class="send__btn">
                                        <a class="fr__btn" href="#">Send Mail</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- End Single Footer Widget -->
                </div>
            </div>
        </div>
        <!-- End Footer Widget -->
        <!-- Start Copyright Area -->
        <div class="htc__copyright bg__cat--5">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="copyright__inner">
                            <p>Copyright© <a href="https://freethemescloud.com/">Free themes Cloud</a> 2018. All right reserved.</p>
                            <a href="#"><img src="images/others/shape/paypol.png" alt="payment images"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Copyright Area -->
    </footer>
    <!-- End Footer Style -->
</div>
<!-- Body main wrapper end -->

<!-- Placed js at the end of the document so the pages load faster -->

<!-- jquery latest version -->
<script src="js/vendor/jquery-3.2.1.min.js"></script>
<!-- Bootstrap framework js -->
<script src="js/bootstrap.min.js"></script>
<!-- All js plugins included in this file. -->
<script src="js/plugins.js"></script>
<script src="js/slick.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<!-- Waypoints.min.js. -->
<script src="js/waypoints.min.js"></script>
<!-- Main js file that contents all jQuery plugins activation. -->
<script src="js/main.js"></script>

</body>