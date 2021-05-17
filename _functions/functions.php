<?php

function u($string="") {
	return urlencode($string);
}

function h($string="") {
	return htmlspecialchars($string);
}

function is_post_request() {
	return $_SERVER['REQUEST_METHOD'] == 'POST';
}

function is_get_request() {
	return $_SERVER['REQUEST_METHOD'] == 'GET';
}

function display_errors($errors=array()) {
  $output = '';
  if(!empty($errors)) {
    $output .= "<div class=\"errors\">";
    $output .= "Please fix the following errors:";
    $output .= "<ul>";

    if (isset($errors['name_link1']) || isset($errors['name_link2']) || isset($errors['name_link3']) || isset($errors['name_link4'])) {
      $output .= "<li>NOTE: File selections do not persist between page refresh. ALL files indicated in red below need to be reselected.</li>";
    }

    foreach($errors as $error) {
      $output .= "<li>" . h($error) . "</li>";
    }
    $output .= "</ul>";
    $output .= "</div>";
  	}
  	return $output;
	}

	
?>