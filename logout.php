<?php
include_once 'logic/User.php';
session_start();

$user = new User();
$user->userLogout();
header("location:index.php");
exit();
 ?>
