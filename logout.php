<?php
session_start(); 
unset($_SESSION['user']);
session_destroy(); // destroy session
header("location:index.php"); 
?>

