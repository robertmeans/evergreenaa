<?php
date_default_timezone_set('America/Denver');
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// error_reporting(0);  // turns off all error reporting
error_reporting(-1); // reports all errors

// ini_set("display_errors", "1"); // shows all errors in browser
ini_set("display_errors", "0"); // hides errors from browser

ini_set("log_errors", 1);

ini_set("error_log", "_errors.txt"); 
