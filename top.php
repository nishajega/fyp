<?php
require('connection.php');
require('addcart_inc.php');

if(isset($_SESSION['user_login'])){
	$name = $_SESSION['name'];

$query = "SELECT * from users_front WHERE name LIKE '$name'";
$res = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($res);

$id = $row['id'];
}

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

  <title>UNITEN EEProMS</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
            <a class="navbar-brand js-scroll-trigger" href="index.php" style="color:black;font-weight:bold;">UNITEN</a><button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto my-2 my-lg-0">
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php" style="color:black;font-weight:bold;">Home</a></li>
                  <li class="nav-item"><a class="nav-link js-scroll-trigger" href="course2.php" style="color:black;font-weight:bold;">Course</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php" style="color:black;font-weight:bold;">About</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php" style="color:black;font-weight:bold;">Contact</a></li> 
                    <?php if(!isset($_SESSION['user_id'])): ?>
                        <li class='nav-item'><a class='nav-link js-scroll-trigger' href='user/login.php' style='color:black;font-weight:bold;'>Register/Login</a></li>
                    <?php else: ?>
                        <li class='nav-item dropdown'>
						 <a class='nav-link dropdown-toggle' href='#' style='color:black;' id='navbarDropdownPortfolio' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
						 Hi <?= $_SESSION['name'] ?> !
						 </a>
						 <div class='dropdown-menu dropdown-menu-right' aria-labelledby='navbarDropdownPortfolio'>
                            <a class='dropdown-item' href='my_order.php'>My Registrations</a>
							<a class='dropdown-item' href='user/profile.php'>Edit Profile</a>
							<a class='dropdown-item' href='logout.php' style="color:black;">Logout</a>
                        </div>
						</li>
                    <?php endif; ?>

                    <li class="nav-item">
                        <div class="htc__shopping__cart">
							<a href="#"><i class="fa fa-shopping-cart" style="font-size:24px"></i></a>
							<a href="cart2.php"><span class="htc__qua"><?php echo $totalproduct ?></span></a>
                        </div>
                       
                </ul>
            </div>
        </div>
    </nav>
  
