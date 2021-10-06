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




function figger_it_out($time) {

  $utc = 'UTC';
  // $time['$ut'] = $from_time (user input)
  // $time['$tz'] = $from_tz (user's tz)
  // $utc = $to_tz (convert to UTC)
  $from_tz_obj = new DateTimeZone($utc);
  $to_tz_obj = new DateTimeZone($time['tz']);
  // $ct = "converted time"
  $ct = new DateTime($time['ut'], $from_tz_obj);
  $ct->setTimezone($to_tz_obj);

  if($time['sun'] == '1') {
    $csun = new DateTime('Sunday ' . $time['ut'], $from_tz_obj);
    $csun->setTimezone($to_tz_obj);
    $nsun = $csun->format('l Hi');

    if (strpos($nsun, 'Saturday') !== false) {
      $sat = '1';
    }
    if (strpos($nsun, 'Sunday') !== false) {
      $sun = '1';
    }    
    if (strpos($nsun, 'Monday') !== false) {
      $mon = '1';
    }
  } else {
    $sun = '0';
  }

  if($time['mon'] == '1') {
    $cmon = new DateTime('Monday ' . $time['ut'], $from_tz_obj);
    $cmon->setTimezone($to_tz_obj);

    $nmon = $cmon->format('l Hi');
    if (strpos($nmon, 'Sunday') !== false) {
      $sun = '1';
    }   
    if (strpos($nmon, 'Monday') !== false) {
      $mon = '1';
    }
    if (strpos($nmon, 'Tuesday') !== false) {
      $tue = '1';
    }
  } else {
      $mon = '0';
    }    

  if($time['tue'] == '1') {
    $ctue = new DateTime('Tuesday ' . $time['ut'], $from_tz_obj);
    $ctue->setTimezone($to_tz_obj);

    $ntue = $ctue->format('l Hi');
    if (strpos($ntue, 'Monday') !== false) {
      $mon = '1';
    }
    if (strpos($ntue, 'Tuesday') !== false) {
      $tue = '1';
    }    
    if (strpos($ntue, 'Wednesday') !== false) {
      $wed = '1';
    }
  } else {
      $tue = '0';
    }

  if($time['wed'] == '1') {
    $cwed = new DateTime('Wednesday ' . $time['ut'], $from_tz_obj);
    $cwed->setTimezone($to_tz_obj);

    $nwed = $cwed->format('l Hi');
    if (strpos($nwed, 'Tuesday') !== false) {
      $tue = '1';
    }   
    if (strpos($nwed, 'Wednesday') !== false) {
      $wed = '1';
    }    
    if (strpos($nwed, 'Thursday') !== false) {
      $thu = '1';
    }
  } else {
      $wed = '0';
    }

  if($time['thu'] == '1') {
    $cthu = new DateTime('Thursday ' . $time['ut'], $from_tz_obj);
    $cthu->setTimezone($to_tz_obj);

    $nthu = $cthu->format('l Hi');
    if (strpos($nthu, 'Wednesday') !== false) {
      $wed = '1';
    }    
    if (strpos($nthu, 'Thursday') !== false) {
      $thu = '1';
    }    
    if (strpos($nthu, 'Friday') !== false) {
      $fri = '1';
    }
  } else {
      $thu = '0';
    }

  if($time['fri'] == '1') {
    $cfri = new DateTime('Friday ' . $time['ut'], $from_tz_obj);
    $cfri->setTimezone($to_tz_obj);

    $nfri = $cfri->format('l Hi');
    if (strpos($nfri, 'Thursday') !== false) {
      $thu = '1';
    }    
    if (strpos($nfri, 'Friday') !== false) {
      $fri = '1';
    }    
    if (strpos($nfri, 'Saturday') !== false) {
      $sat = '1';
    }
  } else {
      $fri = '0';
    }

  if($time['sat'] == '1') {
    $csat = new DateTime('Saturday ' . $time['ut'], $from_tz_obj);
    $csat->setTimezone($to_tz_obj);

    $nsat = $csat->format('l Hi');
    if (strpos($nsat, 'Friday') !== false) {
      $fri = '1';
    }    
    if (strpos($nsat, 'Saturday') !== false) {
      $sat = '1';
    }    
    if (strpos($nsat, 'Sunday') !== false) {
      $sun = '1';
    }
  } else {
      $sat = '0';
    }

  return array($ct, $sun, $mon, $tue, $wed, $thu, $fri, $sat);
}


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