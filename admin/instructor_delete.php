<?php
include('connection.php');
if(isset($_GET['id'])){

    $id = $_GET['id'];

    $query_del = "UPDATE instructor SET status='disabled' WHERE id=$id";
    $res = mysqli_query($con, $query_del);
    header('Location: instructor_list.php');
} else{

}

?>