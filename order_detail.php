<?php
include('top.php');
require('functions.php');
$order_id=get_safe_value($con, $_GET['id']);
?>

<!doctype html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.1.1">
    <title>Sticky Footer Navbar Template · Bootstrap</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/sticky-footer-navbar/">

    <!-- Bootstrap core CSS -->
    <!-- <link href="/docs/4.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <!-- Favicons -->
    <link rel="apple-touch-icon" href="/docs/4.5/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
    <link rel="icon" href="/docs/4.5/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
    <link rel="icon" href="/docs/4.5/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
    <link rel="manifest" href="/docs/4.5/assets/img/favicons/manifest.json">
    <link rel="mask-icon" href="/docs/4.5/assets/img/favicons/safari-pinned-tab.svg" color="#563d7c">
    <link rel="icon" href="/docs/4.5/assets/img/favicons/favicon.ico">
    <meta name="msapplication-config" content="/docs/4.5/assets/img/favicons/browserconfig.xml">
    <meta name="theme-color" content="#563d7c">


    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
    <!-- Custom styles for this template -->
    <link href="sticky-footer-navbar.css" rel="stylesheet">
</head>

<body class="d-flex flex-column h-100">

    <!-- Begin page content -->
    <main role="main" class="flex-shrink-0">
        <div class="container">
		<br><br>
		<h3>My Courses</h3><br>
            <table class="table">
                <thead class="thead-light" style="text-align:center;">
                    <tr>
						<th scope="col">E-Certificate</th>
                        <th scope="col">Course Name</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Price</th>
						<th scope="col">Subtotal</th>
                    </tr>
                </thead>
                <tbody style="text-align:center;">
					<?php
						$username=$_SESSION['name'];
						$res=mysqli_query($con, "select distinct(order_detail.id),order_detail.*, 
						courses.name from order_detail, courses, ordered where 
						order_detail.order_id='$order_id' and ordered.user_name='$username' and order_detail.product_id=courses.id");
						$total_price=0;
						while($row=mysqli_fetch_assoc($res)){
							$total_price=$total_price+($row['quantity']*$row['price']);
					?>
                        <tr>
							<td><a class="btn btn-primary" href="testcert.php?id=<?php echo $row['id']  ?>" role="button">E-Cert</a></td>
                            <th scope="row"><?php echo $row['name'] ?></th>
                            <td><?php echo $row['quantity'] ?></td>
                            <td><?php echo $row['price'] ?></td>
                            <td><?php echo $row['quantity']*$row['price']?></td>
					   </tr>
						<?php } ?>
						<tr>
                            <td colspan="3"></td>
                            <td style="font-weight: bold;">Total Price</td>
                            <td><?php echo $total_price?></td>
                        </tr>
                </tbody>
            </table>
        </div>
    </main>

    <footer class="footer mt-auto py-3">
        <div class="container">
            <span class="text-muted"></span>
        </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script>
        window.jQuery || document.write('<script src="/docs/4.5/assets/js/vendor/jquery.slim.min.js"><\/script>')
    </script>
    <script src="/docs/4.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>

</html>