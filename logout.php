<?php
session_start();

require "Util.php";
$util = new Util();

//Clear Session
$_SESSION['id'] = "";
$_SESSION['username'] = "";
$_SESSION['email'] = "";
$_SESSION['verified'] = "";
session_destroy();

// clear cookies
$util->clearAuthCookie();

header("Location: index.php");
?>