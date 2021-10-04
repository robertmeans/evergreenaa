<?php

function day_range($get_range) {
  if ($get_range == 'sun') {
    $yesterday = 'sat'; $today = 'sun'; $tomorrow = 'mon';
    return array($yesterday, $today, $tomorrow);
  } 
  if ($get_range == 'mon') {
    $yesterday = 'sun'; $today = 'mon'; $tomorrow = 'tue';
    return array($yesterday, $today, $tomorrow);
  } 
  if ($get_range == 'tue') {
    $yesterday = 'mon'; $today = 'tue'; $tomorrow = 'wed';
    return array($yesterday, $today, $tomorrow);
  } 
  if ($get_range == 'wed') {
    $yesterday = 'tue'; $today = 'wed'; $tomorrow = 'thu';
    return array($yesterday, $today, $tomorrow);
  } 
  if ($get_range == 'thu') {
    $yesterday = 'wed'; $today = 'thu'; $tomorrow = 'fri';
    return array($yesterday, $today, $tomorrow);
  } 
  if ($get_range == 'fri') {
    $yesterday = 'thu'; $today = 'fri'; $tomorrow = 'sat';
    return array($yesterday, $today, $tomorrow);
  } 
  if ($get_range == 'sat') {
    $yesterday = 'fri'; $today = 'sat'; $tomorrow = 'sun';
    return array($yesterday, $today, $tomorrow);
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
    $output .= $zone . " (UTC/GMT {$offset})";
    $output .= $zone;
    $output .= "</option>";
  }
  return $output;
}









// function orient_day($eval_today, $today) {

//   if ($eval_today != 0) { 
//     $day = ucfirst(substr($today, 0, 3));
//     return $day; 
//   }
// }


// function convert_timezone($eval_yesterday, $eval_today, $eval_tomorrow, $tz) {
//   $user_tz  = new DateTimeZone($tz); // -7/dst: -6

//   if (($eval_yesterday != '0' && $eval_today != '0' && $eval_tomorrow != '0') || 
//       ($eval_yesterday != '0' && $eval_today != '0') || 
//       ($eval_today != '0' && $eval_tomorrow != '0')) {
//         $mt = new DateTime($eval_tomorrow);
//         $mt->setTimezone($user_tz);
//         $mtz = $mt->format('D g:i A');
//         return $mtz; 
//     } else {


//     if ($eval_yesterday != '0') {
//       $mt = new DateTime($eval_yesterday);
//       $mt->setTimezone($user_tz);
//       $mtz = $mt->format('D g:i A');
//       return $mtz;
//     }
//     if ($eval_today != '0') {
//       $mt = new DateTime($eval_today);
//       $mt->setTimezone($user_tz);
//       $mtz = $mt->format('D g:i A');
//       return $mtz;
//     }
//     if ($eval_tomorrow != '0') {
//       $mt = new DateTime($eval_tomorrow);
//       $mt->setTimezone($user_tz);
//       $mtz = $mt->format('D g:i A');
//       return $mtz;
//     }

//   }
// }

function convert_timezone($eval_yesterday, $eval_today, $eval_tomorrow, $get_range, $tz) {
  $user_tz  = new DateTimeZone($tz); // -7/dst: -6

 if ($eval_yesterday != '0') {
    $mt = new DateTime($eval_yesterday);
    $mt->setTimezone($user_tz);
    $mtz = $mt->format('D g:i A');
    if (strpos($mtz, ucfirst($get_range)) !== false) {
      return $mtz;
    }
  }
  if ($eval_today != '0') {
    $mt = new DateTime($eval_today);
    $mt->setTimezone($user_tz);
    $mtz = $mt->format('D g:i A');
    if (strpos($mtz, ucfirst($get_range)) !== false) {
      return $mtz;
    }
  }
  if ($eval_tomorrow != '0') {
    $mt = new DateTime($eval_tomorrow);
    $mt->setTimezone($user_tz);
    $mtz = $mt->format('D g:i A');
    if (strpos($mtz, ucfirst($get_range)) !== false) {
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