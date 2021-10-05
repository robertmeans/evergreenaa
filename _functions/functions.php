<?php

function day_range($today) {
  if ($today == 'Sunday') {
    $yesterday = 'Saturday'; $tomorrow = 'Monday';
    return array($yesterday, $tomorrow);
  } 
  if ($today == 'Monday') {
    $yesterday = 'Sunday'; $tomorrow = 'Tuesday';
    return array($yesterday, $tomorrow);
  } 
  if ($today == 'Tuesday') {
    $yesterday = 'Monday'; $tomorrow = 'Wednesday';
    return array($yesterday, $tomorrow);
  } 
  if ($today == 'Wednesday') {
    $yesterday = 'Tuesday'; $tomorrow = 'Thursday';
    return array($yesterday, $tomorrow);
  } 
  if ($today == 'Thursday') {
    $yesterday = 'Wednesday'; $tomorrow = 'Friday';
    return array($yesterday, $tomorrow);
  } 
  if ($today == 'Friday') {
    $yesterday = 'Thursday'; $tomorrow = 'Saturday';
    return array($yesterday, $tomorrow);
  } 
  if ($today == 'Saturday') {
    $yesterday = 'Friday'; $tomorrow = 'Sunday';
    return array($yesterday, $tomorrow);
  } 
}

function timezone_select_options($selected_timezone="America/Denver") {
  $tz_idents = timezone_identifiers_list();

  $output = "";
  $dt = new DateTime('now');
  foreach($tz_idents as $zone) {
    $this_tz = new DateTimeZone($zone);
    $dt->setTimezone($this_tz);
    $offset = $dt->format('P');
    
    $output .= "<option value=\"{$zone}\"";
    if($selected_timezone == $zone) { $output .= " selected"; }
    $output .= ">";
    // $output .= $zone . " (UTC/GMT {$offset})";
    $output .= $zone;
    $output .= "</option>";
  }
  return $output;
}

function convert_timezone($ey, $et, $etm, $meet_time, $yesterday, $today, $tomorrow, $tz) {
  $user_tz  = new DateTimeZone($tz); // -7/dst: -6
  $lc = substr(ucfirst($today), 0,3);

 if ($ey != '0') { // yesterday
    $mt = new DateTime($yesterday . ' ' . $meet_time);
    $mt->setTimezone($user_tz);
    $mtz = $mt->format('D g:i A');
    if (strpos($mtz, $lc) !== false) {

      return $mtz;
    }
  }
  if ($et != '0') { // today
    $mt = new DateTime($today . ' ' . $meet_time);
    $mt->setTimezone($user_tz);
    $mtz = $mt->format('D g:i A');
    if (strpos($mtz, $lc) !== false) {
      return $mtz;
    }
  }
  if ($etm != '0') { // tomorrow
    $mt = new DateTime($tomorrow . ' ' . $meet_time);
    $mt->setTimezone($user_tz);
    $mtz = $mt->format('D g:i A');
    if (strpos($mtz, $lc) !== false) {
      return $mtz;
    }
  }
}



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
      $output .= "<li class=\"foobgar\">NOTE: I can't retain your file selections if there are errors. Every time there is <em>any</em> error you need to reselect the files you want to upload.</li>";
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