<?php
require_once 'config/initialize.php';

global $conn;

if (isset($_GET['token'])) {
  $token = $_GET['token'];
} else if (isset($_SESSION['reset-token'])) {
  $token = $_SESSION['reset-token'];
} else {
  header('location:'. WWW_ROOT);
  exit(); 
}



if (isset($_SESSION['reset-token'])) {
  $_SESSION['message'] = "Your password has been updated.";
  $_SESSION['alert-class'] = "alert-success";
  header('location:'. WWW_ROOT . '/login.php');
  exit(); 
}



$sql = "SELECT * FROM users WHERE token='$token' LIMIT 1";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);

if ($user['verified'] == '1') {
  $_SESSION['message'] = "Your email address was successfully verified! You can now login.";
  $_SESSION['alert-class'] = "alert-success";
  header('location:'. WWW_ROOT . '/login.php');
  exit();
} else {
  header('location:'. WWW_ROOT);
  exit();
}