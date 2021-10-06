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

// downloads > Lynda Easy PHP TimeZone
function timezone_select_options($selected_timezone="America/Denver") {
  $tz_idents = timezone_identifiers_list();
  // $tz_indents = DateTimeZone::listIdentifiers();
  $output = "";
  $dt = new DateTime('now');

  $output .= "<option value=\"America/New_York\"";
  if ($selected_timezone == 'America/New_York') { $output .= " selected"; } 
  $output .= ">USA Eastern</option>";

  $output .= "<option value=\"America/Chicago\"";
  if ($selected_timezone == 'America/Chicago') { $output .= " selected"; } 
  $output .= ">USA Central</option>";

  $output .= "<option value=\"America/Denver\"";
  if ($selected_timezone == 'America/Denver') { $output .= " selected"; } 
  $output .= ">USA Mountain</option>";

  $output .= "<option value=\"America/Phoenix\"";
  if ($selected_timezone == 'America/Phoenix') { $output .= " selected"; } 
  $output .= ">USA Mtn Standard</option>";

  $output .= "<option value=\"America/Los_Angeles\"";
  if ($selected_timezone == 'America/Los_Angeles') { $output .= " selected"; } 
  $output .= ">USA Pacific</option>";

  $output .= "<option value=\"America/Anchorage\"";
  if ($selected_timezone == 'America/Anchorage') { $output .= " selected"; } 
  $output .= ">USA Alaska</option>";

  $output .= "<option value=\"Pacific/Honolulu\"";
  if ($selected_timezone == 'Pacific/Honolulu') { $output .= " selected"; } 
  $output .= ">USA Hawaii</option>";

  $output .= "<option value=\"empty\">- - - - - - - - - - - - - - - - - - -</option>";

  foreach($tz_idents as $zone) {
    $output .= "<option value=\"{$zone}\"";

    if ($selected_timezone != 'America/New_York' && $selected_timezone != 'America/Chicago' && $selected_timezone != 'America/Denver' && $selected_timezone != 'America/Phoenix' && $selected_timezone != 'America/Los_Angeles' && $selected_timezone != 'America/Anchorage' && $selected_timezone != 'Pacific/Honolulu') {
      if ($selected_timezone == $zone) { $output .= " selected"; }
    }

    $output .= ">";
    $output .= $zone;
    $output .= "</option>";
  }
  return $output;
}

function pretty_tz($tz) {
  if ($tz == 'America/New_York') { echo 'USA Eastern'; }
    elseif ($tz == 'America/Chicago') { echo 'USA Central'; }
    elseif ($tz == 'America/Denver') { echo 'USA Mountain'; }
    elseif ($tz == 'America/Phoenix') { echo 'USA Mtn Standard'; }
    elseif ($tz == 'America/Los_Angeles') { echo 'USA Pacific'; }
    elseif ($tz == 'America/Anchorage') { echo 'USA Alaska'; }
    elseif ($tz == 'Pacific/Honolulu') { echo 'USA Hawaii'; }
    else  { echo trim(str_replace('_', ' ', substr($tz, strpos($tz, '/') + 1))); } // :-)
    return $tz;  
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



// $ut = meet_time
function figger_it_out($tz, $ut, $su, $mo, $tu, $we, $th, $fr, $sa) {
  $uz  = new DateTimeZone($tz);

  $nt = new DateTime(strtotime($ut));
  $nt->setTimezone($uz);
  $utime = $nt->format('Hi');

  if($su != 'g') {
    $pt = new DateTime('Sunday ' . $ut);
    $pt->setTimezone($uz);
    $ptc = $pt->format('l g:i A');
    if (strpos($ptc, 'Sunday') !== false) {
      $usun = '1';
      return $usun;
    } else {
      $usun = '0';
      return $usun;
    }
  }
  if($mo != 'g') {
    $pt = new DateTime('Monday ' . $ut);
    $pt->setTimezone($uz);
    $ptc = $pt->format('l g:i A');
    if (strpos($ptc, 'Monday') !== false) {
      $umon = '1';
    } else {
      $umon = '0';
    }
  } 
  if($tu != 'g') {
    $pt = new DateTime('Tuesday ' . $ut);
    $pt->setTimezone($uz);
    $ptc = $pt->format('l g:i A');
    if (strpos($ptc, 'Tuesday') !== false) {
      $utue = '1';
    } else {
      $utue = '0';
    }
  } 
  if($we != 'g') {
    $pt = new DateTime('Wednesday ' . $ut);
    $pt->setTimezone($uz);
    $ptc = $pt->format('l g:i A');
    if (strpos($ptc, 'Wednesday') !== false) {
      $uwed = '1';
    } else {
      $uwed = '0';
    }
  }
  if($th != 'g') {
    $pt = new DateTime('Thursday ' . $ut);
    $pt->setTimezone($uz);
    $ptc = $pt->format('l g:i A');
    if (strpos($ptc, 'Thursday') !== false) {
      $uthu = '1';
    } else {
      $uthu = '0';
    }
  }
  if($fr != 'g') {
    $pt = new DateTime('Friday ' . $ut);
    $pt->setTimezone($uz);
    $ptc = $pt->format('l g:i A');
    if (strpos($ptc, 'Friday') !== false) {
      $ufri = '1';
    } else {
      $ufri = '0';
    }
  }
  if($sa != 'g') {
    $pt = new DateTime('Saturday ' . $ut);
    $pt->setTimezone($uz);
    $ptc = $pt->format('l g:i A');
    if (strpos($ptc, 'Saturday') !== false) {
      $usat = '1';
    } else {
      $usat = '0';
    }
  }

  return array($utime, $usun, $umon, $utue, $uwed, $uthu, $ufri, $usat);
}

// function convert_time_utc($tz, $mtg_time) {
//   $user_tz  = new DateTimeZone($tz);

//   $nt = new DateTime($mtg_time);
//   $nt->setTimezone($user_tz);
//   $utc_time = $nt->format('Hi');

//   return $utc_time;
// }
function convert_day($tz, $day, $mtg_time) {

  $user_tz  = new DateTimeZone($tz);

  if($sun != '0') {
    $pt = new DateTime('Sunday ' . $mtg_time);
    $pt->setTimezone($user_tz);
    $ptc = $pt->format('l g:i A');
    if (strpos($ptc, 'Sunday') !== false) {
      $utc_day = '1';
      return $utc_day;
    } else {
      $utc_day = '0';
      return $utc_day;
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