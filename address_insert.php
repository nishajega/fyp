<?php

require('header2.php');
require('connection.php');

$query_sel = "SELECT * FROM invoice ORDER BY idinvoice DESC limit 1";
$query_sel_go = mysqli_query($con, $query_sel);
$res_sel = mysqli_fetch_assoc($query_sel_go);
$id_invoice = $res_sel['idinvoice'];

$address1 = $_POST['address1'];
$address2 = $_POST['address2'];
$address3 = $_POST['address3'];
$address4 = $_POST['address4'];
$poskod = $_POST['poskod'];

$query_update = "UPDATE invoice SET address_1='$address1', address_2='$address2', address_3='$address3', address_4='$address4', poskod='$poskod' WHERE idinvoice=$id_invoice";
$query_update_go = mysqli_query($con, $query_update);

//echo $query_update;
?>

<header class="masthead">
    <div class="container h-100">
        <div class="row h-100 align-items-center justify-content-center text-center">
            <div class="col-lg-10 align-self-end">
            <a href="gen_invoice.php?id=<?= $id_invoice ?>" class="btn btn-light btn-xl"> GENERATE INVOICE</a>
            <a href="certificate_gen.php" class="btn btn-light btn-xl"> CERTIFICATE</a>
                <h1 class="text-uppercase text-white font-weight-bold">SUCCESS !</h1>
                <hr class="divider my-4" />
            </div>
        </div>
    </div>
</header>