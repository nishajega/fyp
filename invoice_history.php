<?php

require('connection.php');
error_reporting(0);
$id = $_GET['id'];
$stmt = "SELECT a.name as username, a.email as useremail, a.phonenum as phonenum, b.idinvoice as invoiceid, b.item as itemname,";
$stmt .= "b.totalprice as totalprice, b.quantity as quantity FROM users_front a INNER JOIN invoice b ON a.id=b.userID WHERE a.id=$id";

$qry = mysqli_query($con, $stmt);


while ($row = mysqli_fetch_assoc($qry)) :
    $inv_arr[] = $row;
endwhile;
// $username = $row['username'];
// $usermail = $row['useremail'];
// $phonenum = $row['phonenum'];
// $invoiceid = $row['invoiceid'];
// $itemname = $row['itemname'];
// $totalprice = $row['totalprice'];
// $quantity = $row['quantity'];

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
    <header>
        <!-- Fixed navbar -->
        <nav class="navbar navbar-expand-md navbar-light fixed-top bg-light">
            <a class="navbar-brand" href="index.php">UNITEN</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php" style="color:black;font-weight:bold;">HOME</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="course.php" style="color:black;font-weight:bold;">COURSE</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php" style="color:black;font-weight:bold;">ABOUT</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php" style="color:black;font-weight:bold;">CONTACT</a></li> 
                    <?php if(!isset($_SESSION['name'])): ?>
                        <li class='nav-item'><a class='nav-link js-scroll-trigger' href='user/student_register.php' style='color:black;'>You are not logged in</a></li>
                    <?php else: ?>
                        <li class='nav-item dropdown'>
						 <a class='nav-link dropdown-toggle' href='#' style='color:black;font-weight:bold;' id='navbarDropdownPortfolio' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
						 <?= $_SESSION['name'] ?>
						 </a>
						 <div class='dropdown-menu dropdown-menu-right' aria-labelledby='navbarDropdownPortfolio'>
                            <a class='dropdown-item' href='invoice_history.php?id=<?= $id ?>'>Purchase History</a>
							<a class='dropdown-item' href='logout.php'>Logout</a>
                        </div>
						</li>
                    <?php endif; ?>
                </ul>
                <form class="form-inline mt-2 mt-md-0">
                    <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
            </div>
        </nav>
    </header>

    <!-- Begin page content -->
    <main role="main" class="flex-shrink-0">
        <div class="container">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">First</th>
                        <th scope="col">Last</th>
                        <th scope="col">Handle</th>
                    </tr>
                </thead>
                <tbody>

                    <tr>
                        <th scope="row"></th>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>

            <table class="table">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">Invoice ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">item</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Total Price</th>
                        <th scope="col">Date</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($inv_arr as $invoices) : ?>
                        <tr>
                            <th scope="row"><?= $invoices['invoiceid'] ?></th>
                            <td><?= $invoices['username'] ?></td>
                            <td><?= $invoices['itemname'] ?></td>
                            <td><?= $invoices['quantity'] ?></td>
                            <td><?= $invoices['totalprice'] ?></td>
                            <td>-</td>
                            <td><a class="btn btn-primary" href="testcert/gen_cert.php?id=<?= $id ?>" role="button">GEN E-CERT </a><br><br><a class="btn btn-danger" href="gen_invoice.php?id=<?= $invoices['invoiceid'] ?>" role="button">GEN INVOICE </a></td>
                        </tr>
                    <?php endforeach; ?>
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