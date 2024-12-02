<?php

require_once 'config/initialize.php';
require_once 'config/verify_admin.php';



// if (isset($_GET['download'])) {
    // Database configuration
    $host = DB_HOST; // Database host
    $username = DB_USER; // Database username
    $password = DB_PASS; // Database password
    $database = DB_NAME; // Database name

    // Name for the exported SQL file
    $filename = $database . '_backup_' . date('Y-m-d_H-i-s') . '.sql';

    // Command to export the database
    $command = "mysqldump --host=$host --user=$username --password=$password $database > $filename";

    // Execute the command
    system($command);
    // shell_exec($command);

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
// }
?>