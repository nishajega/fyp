<?php
require('connection.php');
require('addcart_inc.php');

$name = $_SESSION['name'];

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

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Modern Business - Start Bootstrap Template</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/modern-business.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
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

<body>

  <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top py-3" id="mainNav">
        <div class="container">
            <a class="navbar-brand js-scroll-trigger" href="#page-top" style="color:black;">UNITEN</a><button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto my-2 my-lg-0">
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#page-top" style="color:black;">HOME</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" style="color:black;" id="navbarDropdownPortfolio" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            COURSE
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownPortfolio">
                            <a class="dropdown-item" href="course.php">Show Courses</a>

                        </div>
                    </li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#about" style="color:black;text-weight:bold;">ABOUT</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#contact" style="color:black;">CONTACT</a></li> 
                    <?php if(!isset($_SESSION['user_id'])): ?>
                        <li class='nav-item'><a class='nav-link js-scroll-trigger' href='user/login.php' style='color:black;'>Register/Login</a></li>
                    <?php else: ?>
                        <li class='nav-item dropdown'>
						 <a class='nav-link dropdown-toggle' href='#' style='color:black;' id='navbarDropdownPortfolio' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
						 Welcome   <?= $_SESSION['name'] ?> !!!
						 </a>
						 <div class='dropdown-menu dropdown-menu-right' aria-labelledby='navbarDropdownPortfolio'>
                            <a class='dropdown-item' href='invoice_history.php?id=<?= $id ?>'>Purchase History</a>
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
  
