<?php

require_once 'config/initialize.php';
require_once 'config/verify_admin.php';

// Database configuration
$host     = DB_HOST; // Database host
$username = DB_USER; // Database username
$password = DB_PASS; // Database password
$database = DB_NAME; // Database name

$tz = 'America/Denver';
$timestamp = time();
$dt = new DateTime("now", new DateTimeZone($tz)); //first argument "must" be a string
$dt->setTimestamp($timestamp); //adjust the object to correct timestamp
$date = $dt->format('mdyHi');


