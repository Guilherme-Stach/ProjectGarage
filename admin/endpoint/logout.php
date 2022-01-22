<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

unset($_SESSION['email']);
unset($_SESSION['stoken']);


die("<script>window.location='../index.php';</script>");
       //die("4458");

?>