<?php 
ini_set('display_errors',1);
error_reporting(-1);
session_start();
unset($_SESSION['login']);
unset($_SESSION['studentID']);

$newURL = "task2.php";
header('Location: '.$newURL);
die;
?>