<?php
require_once('./config.php');
require('header2.php');

$student_name = $_POST['student_name'];
$stmt_invc = "INSERT INTO cert (name) VALUES ('$student_name')";
$stmt_invc_qr = mysqli_query($con, $stmt_invc);
$nameuser = $_SESSION['name'];
$stmt = "SELECT * FROM users_front WHERE name LIKE '$nameuser'";
$res = mysqli_query($con, $stmt);
$row = mysqli_fetch_assoc($res);

$email = $row['email'];
$id_users = $row['id'];

$token  = $_POST['stripeToken'];
$email  = $_POST['stripeEmail'];
$pay = $_POST['stripe-amount'];
$desc = $_POST['stripe-desc'];

$customer = \Stripe\Customer::create([
    'email' => $email,
    'source'  => $token,
]);

$charge = \Stripe\Charge::create([
    'customer' => $customer->id,
    'amount'   => $pay,
    'currency' => 'myr',
    'description' => $desc
]);

//echo '<h1>Successfully charged $50.00!</h1>';
?>

<!-- Masthead-->
<header class="masthead">
    <div class="container h-100">
        <div class="row h-100 align-items-center justify-content-center text-center">
            <div class="col-lg-10 align-self-end">
                <h1 class="text-uppercase text-white font-weight-bold">PAYMENT SUCCESS !</h1>
                <hr class="divider my-4" />
            </div>
            <div class="col-lg-8 align-self-baseline">
                <p class="text-white-75 font-weight-light mb-5">Please fill in your address for invoice.</p>
            </div>
                <div class="container text-center">
                    <hr class="divider my-4" />
                    <form method="post" action="address_insert.php">
                        <div class="enquiry">
                            <input type="text" placeholder="Address line 1" name="address1" ><br>

                            <input type="text" placeholder="Address line 2" name="address2" ><br>

                            <input type="text" placeholder="Address line 3" name="address3" ><br>

                            <input type="text" placeholder="Address line 4" name="address4" ><br>

                            <input type="text" placeholder="Poskod" name="poskod" ><br>
                            <button type="submit" name="submit">Submit</button>
                        </div>
                </div>

        </div>
    </div>
</header>
<!-- About-->