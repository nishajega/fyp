<?php
session_start();
unset($_SESSION['user_login']);
unset($_SESSION['user_id']);
unset($_SESSION['name']);
header('location: index.php');
?>