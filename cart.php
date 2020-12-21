<?php
session_start();
error_reporting(0);
require('header.php');
if (isset($_POST['add'])) {
    if (!empty($_POST["quantity"])) {
        $pid = $_GET["pid"];
        $_SESSION['dates'] = $_POST['dates'];
        //echo $_SESSION['dates'];
        $result = mysqli_query($con, "SELECT * FROM courses WHERE id='$pid'");
        while ($row = mysqli_fetch_assoc($result)) {
            $resultset[] = $row;
            $productByCode = $resultset;
            $itemArray = array($productByCode[0]["id"] => array('name' => $productByCode[0]["name"], 'code' => $productByCode[0]["id"], 'quantity' => $_POST["quantity"], 'price' => $productByCode[0]["price"]));
            if (!empty($_SESSION["cart_item"])) {
                // searches for specific value code
                if (in_array($productByCode[0]["id"], array_keys($_SESSION["cart_item"]))) {
                    foreach ($_SESSION["cart_item"] as $k => $v) {
                        if ($productByCode[0]["id"] == $k) {
                            if (empty($_SESSION["cart_item"][$k]["quantity"])) {
                                $_SESSION["cart_item"][$k]["quantity"] = 0;
                            }
                            $_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
                        }
                    }
                } else {
                    //The array_merge() function merges one or more arrays into one array.
                    $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"], $itemArray);
                }
            } else {
                $_SESSION["cart_item"] = $itemArray;
            }
        }
    }
}

if ($_GET['action'] == 'delete') {
    unset($_SESSION['cart_item']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Creative - Start Bootstrap Theme</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/img/logo.png" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v5.13.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic" rel="stylesheet" type="text/css" />
    <!-- Third party plugin CSS-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />

</head>

<body id="page-top">
    <!-- Navigation-->


    <div class="cart">
        <h1>SHOPPING CART</h1>
        <?php
        if (isset($_SESSION["cart_item"])) {
            $total_quantity = 0;
            $total_price = 0;
        ?>
            <table>
                <tr>
                    <th>Course</th>
                    <th>Quantity</th>
                    <th>Amount</th>
                    <th>Dates</th>
                </tr>
                <form action="checkout.php" method="post">
                <?php
                foreach ($_SESSION["cart_item"] as $item) :
                    $item_price = $item["quantity"] * $item["price"];
                ?>
                    <tr>
                        <td><input type="hidden" value="<?= $item["name"]; ?>" name="name[]"><?= $item["name"]; ?><br><input type="hidden" value="<?= $item["price"]; ?>" name="price[]"><?php echo "RM " . $item["price"]; ?></td>
                        <td><input type="hidden" value=<?= $item["quantity"]; ?> name="quantity[]"><?php echo $item["quantity"]; ?></td>
                        <td><?php echo "RM " . number_format($item_price, 2); ?></td>
                        <td><?= $_SESSION['dates']; ?></td>
                        <input type="hidden" value="<?= $item['code'] ?>" name="id[]">
                    </tr>

                    
                <?php
                    $total_quantity += $item["quantity"];
                    $total_price += ($item["price"] * $item["quantity"]);
                     $total_name = $item['name'];
                     $total_code = $item['code'];
                    ?>
                     <input type="hidden" value="<?= $total_price ?>" name="total_price">
                     <input type="hidden" value=<?= $total_quantity ?> name="total_quantity">
                     <input type="hidden" value="<?= $_SESSION['dates']; ?>" name="dates">
                     
                            
                
                <?php
                endforeach;
                ?>
                <tr>
                    <td colspan="2" style="text-align:right; font-weight:bold;">Total</td>
                    <td><?php echo "RM " . number_format($total_price, 2); ?></td>
                    <td><button type="submit" name="submit" class="btn btn-success">Checkout</button>
                    </form> 
                    <button onclick="location.href='cart.php?action=delete&id=<?php echo $item['code']; ?>'" class="btn btn-danger">Remove ALL</button>
                            
                    </td>
                </tr>

            </table>
        <?php
        } else {
        ?>
            <div class="no-records">Your Cart is Empty</div>
        <?php
        }
        ?>


    </div>
    <!-- Footer-->
    <footer class="bg-light py-5">
        <div class="container">
            <div class="small text-center text-muted">Copyright © 2020 - Start Bootstrap</div>
        </div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <!-- Third party plugin JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>

</body>

</html>