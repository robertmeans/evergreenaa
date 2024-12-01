<?php
if (isset($_GET['filename'])) {
  $filename = $_GET['filename'];

  if (file_exists($filename) && filesize($filename) > 0) {
    echo "File is not empty";
  } else {
    echo "File is empty or does not exist";
  }
}
?>