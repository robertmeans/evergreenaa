<?php
require_once 'config/initialize.php';

$date = new DateTime('now', new DateTimeZone('America/Denver'));
$now = $date->format("H:i:s D, m.d.y");
$their_ip = $_SERVER['REMOTE_ADDR'];

if (isset($_SESSION['id'])) {         $user_id = $_SESSION['id'];         } else { $user_id = ''; }
if (isset($_SESSION['username'])) {   $username = $_SESSION['username'];  } else { $username = 'visitor'; }
if (isset($_SESSION['email'])) {      $email = $_SESSION['email'];        } else { $email = ''; }
if (isset($_POST['day'])) {           $day = $_POST['day'];               } else { $day = ''; }
if (isset($_POST['mtgName'])) {       $mtg_name = $_POST['mtgName'];      } else { $mtg_name = ''; }


if (is_post_request() && isset($_POST['analytics_day'])) {
  
  global $db;

  $sql = "INSERT INTO analytics ";
  $sql .= "(occurred, auser_email, day_opened, mtg_opened, a_ip) ";
  $sql .= "VALUES (";
  $sql .= "'" . $now . "', ";
  $sql .= "'" . $email . "', "; 
  $sql .= "'" . $day . "', ";
  $sql .= "'" . $mtg_name . "', ";
  $sql .= "'" . $their_ip . "'";
  $sql .= ")";

  mysqli_query($db, $sql); 
 
}

if (is_post_request() && isset($_POST['analytics_mtgName'])) {
  
  global $db;

  $sql = "INSERT INTO analytics ";
  $sql .= "(occurred, auser_email, day_opened, mtg_opened, a_ip) ";
  $sql .= "VALUES (";
  $sql .= "'" . $now . "', ";
  $sql .= "'" . $email . "', "; 
  $sql .= "'" . $day . "', ";
  $sql .= "'" . $mtg_name . "', ";
  $sql .= "'" . $their_ip . "'";
  $sql .= ")";

  mysqli_query($db, $sql); 
  
  
}

