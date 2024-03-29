<?php
require('connection.php');
require('addcart_inc.php');

error_reporting(0);
if(isset($_SESSION['user_login'])){
	$name = $_SESSION['name'];
}

$query = "SELECT * from users_front WHERE name LIKE '$name'";
$res = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($res);

$id = $row['id'];

$obj=new add_to_cart();
$totalproduct=$obj->totalProduct();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>UNITEN EEProMS</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/img/logo.png" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <link rel="stylesheet" href="node_modules/mdbootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="node_modules/mdbootstrap/css/mdb.min.css">
    <link rel="stylesheet" href="node_modules/mdbootstrap/css/style.css">
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic" rel="stylesheet" type="text/css" />
    <!-- Third party plugin CSS-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
	<style>
		.htc__shopping__cart {
			position: relative;
		}
		.htc__shopping__cart a i {
			color: #000000;
			font-size: 19px;
		}
		.htc__shopping__cart a span.htc__qua {
		  background: #c43b68;
		  border-radius: 100%;
		  color: #fff;
		  font-size: 9px;
		  height: 17px;
		  line-height: 19px;
		  position: absolute;
		  right: -5px;
		  text-align: center;
		  top: -4px;
		  width: 17px;
		}

	</style>

</head>

<body id="">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
        <div class="container">
            <a class="navbar-brand js-scroll-trigger" href="#page-top" style="color:black;">UNITEN</a><button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto my-2 my-lg-0">
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#page-top" style="color:black;">Home</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="course2.php" style="color:black;font-weight:bold;">Course</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#about" style="color:black;">About</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#contact" style="color:black;">Contact</a></li> 
                    <?php if(!isset($_SESSION['user_id'])): ?>
                        <li class='nav-item'><a class='nav-link js-scroll-trigger' href='user/login.php' style='color:black;'>Register/Login</a></li>
                    <?php else: ?>
                        <li class='nav-item dropdown'>
						 <a class='nav-link dropdown-toggle' href='#' style='color:black;' id='navbarDropdownPortfolio' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
						 Hi   <?= $_SESSION['name'] ?> !
						 </a>
						 <div class='dropdown-menu dropdown-menu-right' aria-labelledby='navbarDropdownPortfolio'>
                            <a class='dropdown-item' href='my_order.php'>My Registration</a>
							<a class='dropdown-item' href='user/profile.php'>Edit Profile</a>
							<a class='dropdown-item' href='logout.php' style="color:black;">Logout</a>
                        </div>
						</li>
                    <?php endif; ?>
					
                    <li class="nav-item">
						<div class="htc__shopping__cart">
							<a href="#"><i class="fa fa-shopping-cart" style="color:black"></i></a>
							<a href="cart2.php"><span class="htc__qua"><?php echo $totalproduct ?></span></a>
                        </div>
                </ul>
            </div>
        </div>
    </nav>