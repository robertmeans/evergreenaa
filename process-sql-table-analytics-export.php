<?php

require_once 'config/initialize.php';
require_once 'config/verify_admin.php';

$start_date = get_analytic_start_date();

while ($row = mysqli_fetch_assoc($start_date)) {

  if ($row['occurred'] !== '') {
    $raw_start_date = $row['occurred'];
    $dateTimez = DateTime::createFromFormat('H:i:s D, m.d.y', $raw_start_date);
    $start = $dateTimez->format('m-d-y_Hi');
  } else {
    $start = 'no-telling';
  }
}

// Database configuration
$host     = DB_HOST; // Database host
$username = DB_USER; // Database username
$password = DB_PASS; // Database password
$database = DB_NAME; // Database name

$tz = 'America/Denver';
$timestamp = time();
$dt = new DateTime("now", new DateTimeZone($tz)); //first argument "must" be a string
$dt->setTimestamp($timestamp); //adjust the object to correct timestamp
$date = $dt->format('m-d-y_Hi');

// $start = $_POST['start_date'];

// Name for the exported SQL file
if (WWW_ROOT == 'http://localhost/evergreenaa') {
  $filename = $start . '-to-' . $date . '_LOCAL-analytics_table.sql';
} else {
  $filename = $start . '-to-' . $date . '_ONLINE-analytics_table.sql';
}

// Command to export the database
$command = "mysqldump --host=$host --user=$username --password=$password $database analytics > $filename";

// Execute the command
system($command);

// Check if the file was created
if (file_exists($filename)) {
  // Set headers to download the file
  header('Content-Description: File Transfer');
  header('Content-Type: application/octet-stream');
  header('Content-Disposition: attachment; filename=' . basename($filename));
  header('Expires: 0');
  header('Cache-Control: must-revalidate');
  header('Pragma: public');
  header('Content-Length: ' . filesize($filename));

  // Read and output the file
  readfile($filename);

  // Delete the temporary file
  unlink($filename);

  exit;
} else {
    echo "Failed to create the backup file.";
}







?>