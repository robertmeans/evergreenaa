<?php
// error_reporting(0);  // turns off all error reporting


error_reporting(-1); // reports all errors

ini_set("display_errors", "1"); // shows all errors in browser
ini_set("display_errors", "0"); // hides errors from browser

ini_set("log_errors", 1);
ini_set("error_log", "php-error.log");