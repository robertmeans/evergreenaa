<?php

function configure_theme() {
  if (isset($_SESSION['db-theme'])) {
    $theme = $_SESSION['db-theme'];
  } elseif (!empty($_COOKIE['sessionTheme'])) {
    $theme = $_COOKIE['sessionTheme'];
  } else {
    $theme = '0';
  }
  return $theme;
}

function preload_config($layout_context) {
  if (isset($_SESSION['db-theme'])) {
    $theme = $_SESSION['db-theme'];
  } elseif (!empty($_COOKIE['sessionTheme'])) {
    $theme = $_COOKIE['sessionTheme'];
  } else {
    $theme = '0';
  }

  if ($theme == '0') {
    if ($layout_context != 'home') {
      if (WWW_ROOT != 'http://localhost/evergreenaa') {
        echo '<div class="preload anni"><img src="_images/preload.gif"></div>';
      } else {
        echo '<div class="preload-dev anni"><img src="_images/preload.gif"></div>';
      }
    } else {
      if (WWW_ROOT != 'http://localhost/evergreenaa') {
        echo '<div class="preload"><p>One day at a time.</p></div>';
      } else {
        echo '<div class="preload-dev"><p>One day at a time.</p></div>';
      }
    }
  } else {
    if ($layout_context != 'home') {
      if (WWW_ROOT != 'http://localhost/evergreenaa') {
        echo '<div class="preload anni"><img src="_images/preload-light.gif"></div>';
      } else {
        echo '<div class="preload-dev anni"><img src="_images/preload-light.gif"></div>';
      }
    } else {
      if (WWW_ROOT != 'http://localhost/evergreenaa') {
        echo '<div class="preload"><p>One day at a time.</p></div>';
      } else {
        echo '<div class="preload-dev"><p>One day at a time.</p></div>';
      }
    }
  }
  return $theme;
}

function mobile_bkg_config($theme) {
  if ($theme == '0') { 
    echo '<img class="background-image" src="_images/aa-logo-dark_mobile.gif" alt="AA Logo">';
   } else { 
    echo '<img class="background-image" src="_images/aa-logo-light_mobile.gif" alt="AA Logo">';
   }
}

function show_homepage() {
  if (!isset($_SESSION['verified']) || ((isset($_SESSION['verified']) && $_SESSION['verified'] != "0") && !isset($_SESSION['message']))) {
    return true; 
    } else { return false; }  
}


function show_member_all_their_meetings($row) {
  if ((($row['id_user']) == $_SESSION['id']) && (($row['visible'] == 1) || ($row['visible'] == 2) || ($row['visible'] == 3))) {
    return true;
  } else { return false; }
}

function show_members_and_public_meetings($row) {
  if ((($row['id_user']) != $_SESSION['id']) && ((($row['visible'] == 2) || ($row['visible'] == 3)))) {
    return true;
  } else { return false; }
}

function show_general_public_meetings($row) {
  if ($row['visible'] != 0 && $row['visible'] != 1 && $row['visible'] != 2) {
    return true;
  } else { return false; }
}

function is_visitor() {
  if (!isset($_SESSION['verified'])) {
    return true;
  } else { return false; }
}

/* explanation: I gave everyone (except President (there can be only one)) a 10-digit range just to be flexible - in case some reason comes up to add more roles, I can plug them in wherever I need them. - 'declare_' functions are used to reference that specific role whereas 'is_' functions are used for permissions. */
function is_president() { /* President = 99 | There should be only 1 President */
  if (isset($_SESSION['role']) && $_SESSION['role'] == 99) {
    return true;
  } else { return false; }
}
function declare_executive() { /* Executive = 80 */
  if (isset($_SESSION['role']) && ($_SESSION['role'] < 81 && $_SESSION['role'] > 69)) {
    return true;
  } else { return false; }
}
function declare_admin() { /* Administrator = 60 */
  if (isset($_SESSION['role']) && ($_SESSION['role'] < 61 && $_SESSION['role'] > 49)) {
    return true;
  } else { return false; }
}
function declare_manager() { /* Administrator = 40 */
  if (isset($_SESSION['role']) && ($_SESSION['role'] < 41 && $_SESSION['role'] > 29)) {
    return true;
  } else { return false; }
}

function declare_member() { /* Member = 20 */
  if (isset($_SESSION['role']) && ($_SESSION['role'] < 21 && $_SESSION['role'] > 9)) {
    return true;
  } else { return false; }
}

/* explanation: if 'is_executive()' then everyone up the line from executive gets access, etc. this way you can always default to the lowest role you want to provide access to and everyone up the line will also inherit those permissions. */
function is_executive() {
  if (is_president() || declare_executive()) {
    return true;
  } else {
    return false;
  }
}
function is_admin() {
  if (is_president() || declare_executive() || declare_admin() || declare_manager()) {
    return true;
  } else {
    return false;
  }
}
function is_manager() {
  if (is_president() || declare_executive() || declare_admin() || declare_manager()) {
    return true;
  } else {
    return false;
  }
}
function is_member() {
  if (is_president() || declare_executive() || declare_admin() || declare_manager() || declare_member()) {
    return true;
  } else {
    return false;
  }
}

function in_admin_mode() {
  if (isset($_SESSION['mode']) && $_SESSION['mode'] == 1) {
    return true;
  } else { return false; }
}

function is_suspended() { 
  if (isset($_SESSION['role']) && $_SESSION['role'] < 5) { /* suspended + kept mtgs = 1, suspended + mtgs-to-draft = 0 */
    return true;
  } else { return false; }
}

function is_owner($row) {
  if ((isset($row['id_user']) && isset($_SESSION['id'])) && $row['id_user'] == $_SESSION['id']) {
    return true;
  } else { return false; }
}







function apply_offset_to_meetings($results, $tz, $time_offset) {

  foreach($results as $k=>$v) {
    $from_tz_obj = new DateTimeZone($v['mtg_tz']);
    $to_tz_obj = new DateTimeZone($tz);

    $cfoo = new DateTime($v['meet_time'], $from_tz_obj);
    $cfoo->setTimezone($to_tz_obj);

    if ($v['sun'] == '1') {

      $csun = new DateTime('Sunday ' . $v['meet_time'], $from_tz_obj);
      $csun->setTimezone($to_tz_obj);
      $nsun = $csun->format('l Hi');

      if (strpos($nsun, 'Saturday') !== false) { 
        $results[$k]['sat'] = '1';
      }

      if ($time_offset == 'neg' && $v['mon'] != '1' && strpos($nsun, 'Sunday') === false) {
        $results[$k]['sun'] = '0';
      }
      if ($time_offset == 'pos' && $v['sat'] != '1' && strpos($nsun, 'Sunday') === false) {
        $results[$k]['sun'] = '0';
      }
   
      if (strpos($nsun, 'Monday') !== false) { 
        $results[$k]['mon'] = '1';
      }
    }

    if ($v['mon'] == '1') {
  
      $cmon = new DateTime('Monday ' . $v['meet_time'], $from_tz_obj);
      $cmon->setTimezone($to_tz_obj);
      $nmon = $cmon->format('l Hi');

      if (strpos($nmon, 'Sunday') !== false) { 
        $results[$k]['sun'] = '1';
      }

      if ($time_offset == 'neg' && $v['tue'] != '1' && strpos($nmon, 'Monday') === false) {
        $results[$k]['mon'] = '0';
      }
      if ($time_offset == 'pos' && $v['sun'] != '1' && strpos($nmon, 'Monday') === false) {
        $results[$k]['mon'] = '0';
      }
    
      if (strpos($nmon, 'Tuesday') !== false) { 
        $results[$k]['tue'] = '1';
      }
    }

    if ($v['tue'] == '1') {   

      $ctue = new DateTime('Tuesday ' . $v['meet_time'], $from_tz_obj);
      $ctue->setTimezone($to_tz_obj);
      $ntue = $ctue->format('l Hi');

      if (strpos($ntue, 'Monday') !== false) { // if converted time contains "Monday"
        $results[$k]['mon'] = '1';
      }

      if ($time_offset == 'neg' && $v['wed'] != '1' && strpos($ntue, 'Tuesday') === false) {
        $results[$k]['tue'] = '0';
      }
      if ($time_offset == 'pos' && $v['mon'] != '1' && strpos($ntue, 'Tuesday') === false) {
        $results[$k]['tue'] = '0';
      }
   
      if (strpos($ntue, 'Wednesday') !== false) { // if converted time contains "Wednesday"
        $results[$k]['wed'] = '1';
      }
    } 

    if ($v['wed'] == '1') {

      $cwed = new DateTime('Wednesday ' . $v['meet_time'], $from_tz_obj);
      $cwed->setTimezone($to_tz_obj);
      $nwed = $cwed->format('l Hi');

      if (strpos($nwed, 'Tuesday') !== false) {  
        $results[$k]['tue'] = '1';
      }   

      if ($time_offset == 'neg' && $v['thu'] != '1' && strpos($nwed, 'Wednesday') === false) {
        $results[$k]['wed'] = '0';
      }
      if ($time_offset == 'pos' && $v['tue'] != '1' && strpos($nwed, 'Wednesday') === false) {
        $results[$k]['wed'] = '0';
      }

      if (strpos($nwed, 'Thursday') !== false) { 
        $results[$k]['thu'] = '1';
      }     
    }

    if ($v['thu'] == '1') {

      $cthu = new DateTime('Thursday ' . $v['meet_time'], $from_tz_obj);
      $cthu->setTimezone($to_tz_obj);
      $nthu = $cthu->format('l Hi');

      if (strpos($nthu, 'Wednesday') !== false) { 
        $results[$k]['wed'] = '1';
      }

      if ($time_offset == 'neg' && $v['fri'] != '1' && strpos($nthu, 'Thursday') === false) {
        $results[$k]['thu'] = '0';
      }
      if ($time_offset == 'pos' && $v['wed'] != '1' && strpos($nthu, 'Thursday') === false) {
        $results[$k]['thu'] = '0';
      }

      if (strpos($nthu, 'Friday') !== false) {  
        $results[$k]['fri'] = '1';
      }             
    }   

    if ($v['fri'] == '1') {

      $cfri = new DateTime('Friday ' . $v['meet_time'], $from_tz_obj);
      $cfri->setTimezone($to_tz_obj);
      $nfri = $cfri->format('l Hi');

      if (strpos($nfri, 'Thursday') !== false) { 
        $results[$k]['thu'] = '1';
      }

      if ($time_offset == 'neg' && $v['sat'] != '1' && strpos($nfri, 'Friday') === false) {
        $results[$k]['fri'] = '0';
      }
      if ($time_offset == 'pos' && $v['thu'] != '1' && strpos($nfri, 'Friday') === false) {
        $results[$k]['fri'] = '0';
      }

      if (strpos($nfri, 'Saturday') !== false) { 
        $results[$k]['sat'] = '1';
      }               
    }

    if ($v['sat'] == '1') {

      $csat = new DateTime('Saturday ' . $v['meet_time'], $from_tz_obj);
      $csat->setTimezone($to_tz_obj);
      $nsat = $csat->format('l Hi');
   
      if (strpos($nsat, 'Friday') !== false) {  
        $results[$k]['fri'] = '1';
      }

      if ($time_offset == 'neg' && $v['sun'] != '1' && strpos($nsat, 'Saturday') === false) {
        $results[$k]['sat'] = '0';
      }
      if ($time_offset == 'pos' && $v['fri'] != '1' && strpos($nsat, 'Saturday') === false) {
        $results[$k]['sat'] = '0';
      }

      if (strpos($nsat, 'Sunday') !== false) { 
        $results[$k]['sun'] = '1';
      }                     
    }

    $v['meet_time'] = $cfoo->format('Hi');
    $b[] = $v['meet_time'] . ' ' . $v['group_name'];
    // echo print_r($b);
  }
  asort($b);
  foreach ($b as $k=>$v) {
    $c[] = $results[$k];
    // echo print_r($c);
  }
  return $c;
}

function apply_offset_to_edit($time) {
  // initialize return variables
  $sun = '0';
  $mon = '0';
  $tue = '0';
  $wed = '0';
  $thu = '0';
  $fri = '0';
  $sat = '0';

  $from_tz_obj = new DateTimeZone($time['tz']);
  $to_tz_obj = new DateTimeZone($time['tz']);
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
  } 

  return array($ct, $sun, $mon, $tue, $wed, $thu, $fri, $sat);
}

function day_range($today) {
  if ($today == 'Sunday') {
    $yesterday = 'Saturday'; $tomorrow = 'Monday';
  } 
  if ($today == 'Monday') {
    $yesterday = 'Sunday'; $tomorrow = 'Tuesday';
  } 
  if ($today == 'Tuesday') {
    $yesterday = 'Monday'; $tomorrow = 'Wednesday';
  } 
  if ($today == 'Wednesday') {
    $yesterday = 'Tuesday'; $tomorrow = 'Thursday';
  } 
  if ($today == 'Thursday') {
    $yesterday = 'Wednesday'; $tomorrow = 'Friday';
  } 
  if ($today == 'Friday') {
    $yesterday = 'Thursday'; $tomorrow = 'Saturday';
  } 
  if ($today == 'Saturday') {
    $yesterday = 'Friday'; $tomorrow = 'Sunday';
  } 

  $y = substr(lcfirst($yesterday), 0,3);
  $d = substr(lcfirst($today), 0,3);
  $t = substr(lcfirst($tomorrow), 0,3);

  return array($yesterday, $tomorrow, $y, $d, $t); 
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
  $output .= ">USA [Phoenix, AZ]</option>";

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
  if ($tz == 'America/New_York') { echo 'USA Eastern time'; }
    elseif ($tz == 'America/Chicago') { echo 'USA Central time'; }
    elseif ($tz == 'America/Denver') { echo 'USA Mountain time'; }
    elseif ($tz == 'America/Phoenix') { echo 'USA [Phoenix, AZ]'; }
    elseif ($tz == 'America/Los_Angeles') { echo 'USA Pacific time'; }
    elseif ($tz == 'America/Anchorage') { echo 'USA Alaska time'; }
    elseif ($tz == 'Pacific/Honolulu') { echo 'USA Hawaii time'; }
    elseif ($tz == 'UTC') { echo 'UTC/GMT time'; }
    // else  { echo $tz; } // make it way prettier...
    else  { echo trim(str_replace('_', ' ', substr($tz, strpos($tz, '/') + 1))) . ' time'; } // :-)
    return $tz;  
}

function format_time($meet_time) {
  $ct = new DateTime($meet_time);
  $nct = $ct->format('g:i A');
  return $nct;
}

function converted_time($time, $mtg_tz, $tz) {
  if ($mtg_tz === $tz) {
    $ct = new DateTime($time);
    $nct = $ct->format('g:i A');    
  } else {
    $from_tz_obj = new DateTimeZone($mtg_tz);
    $to_tz_obj = new DateTimeZone($tz);

    $ct = new DateTime($time, $from_tz_obj);
    $ct->setTimezone($to_tz_obj);
    $nct = $ct->format('g:i A');
  }
  return $nct;
}

function convert_timezone($ey, $et, $etm, $meet_time, $yesterday, $today, $tomorrow, $tz, $time_offset) {
  $user_tz  = new DateTimeZone($tz); // -7/dst: -6
  $lc = substr(ucfirst($today), 0,3);

 if ($ey == '1') { 
    $mt = new DateTime($yesterday . ' ' . $meet_time);
    $mt->setTimezone($user_tz);
    $mtz = $mt->format('D g:i A');
    if (strpos($mtz, $lc) !== false) {
      return $mtz;
    }
  }
  if ($et == '1') { 
    $mt = new DateTime($today . ' ' . $meet_time);
    $mt->setTimezone($user_tz);
    $mtz = $mt->format('D g:i A');
    if (strpos($mtz, $lc) !== false) {
      return $mtz;
    }
  }
  if ($etm == '1') { 
    $mt = new DateTime($tomorrow . ' ' . $meet_time);
    $mt->setTimezone($user_tz);
    $mtz = $mt->format('D g:i A');
    if (strpos($mtz, $lc) !== false) {
      return $mtz;
    }
  }
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

function print_day($row) {
  $p = '';

  if ($row['sun'] == 0) {  } 
  else if (($row['sun'] !=0) && (($row['mon'] != 0) || ($row['tue'] != 0) || ($row['wed'] != 0) || ($row['thu'] != 0) || ($row['fri'] != 0) || ($row['sat'] != 0))) {
    $p .= "Sun, "; 
  } else { $p .= "Sun"; }

  if ($row['mon'] == 0) {  }
  else if (($row['mon'] !=0) && (($row['tue'] != 0) || ($row['wed'] != 0) || ($row['thu'] != 0) || ($row['fri'] != 0) || ($row['sat'] != 0))) { 
    $p .= "Mon, "; 
  } else { $p .= "Mon"; }

  if ($row['tue'] == 0) {  }
  else if (($row['tue'] !=0) && (($row['wed'] != 0) || ($row['thu'] != 0) || ($row['fri'] != 0) || ($row['sat'] != 0))) { 
    $p .= "Tue, "; 
  } else { $p .= "Tue"; }

  if ($row['wed'] == 0) {  }
  else if (($row['wed'] !=0) && (($row['thu'] != 0) || ($row['fri'] != 0) || ($row['sat'] != 0))) { 
    $p .= "Wed, "; 
  } else { $p .= "Wed"; }

  if ($row['thu'] == 0) {  }
  else if (($row['thu'] !=0) && (($row['fri'] != 0) || ($row['sat'] != 0))) { 
    $p .= "Thu, "; 
  } else { $p .= "Thu"; }

  if ($row['fri'] == 0) {  }
  else if (($row['fri'] !=0) && ($row['sat'] != 0)) { 
    $p .= "Fri, "; 
  } else { $p .= "Fri"; }

  if ($row['sat'] == 0) {  } 
  else { $p .= "Sat "; } // Sat will never have a comma after it so it can stand alone like this

  echo $p;
}

function find_offset($float) {
  $hours = floor($float);
  $minutes = ($float - $hours) * 60;
  return sprintf("%+02d:%02d", $hours, $minutes);
}

function u($string="") {
	return urlencode($string);
}

function h($string="") {
	return htmlspecialchars($string ?? '');
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
    $num = count($errors);

    $output .= "<div class=\"errors\">";
    $output .= "Please fix the following errors:";
    $output .= "<ul>";

    if (isset($errors['name_link1']) || isset($errors['name_link2']) || isset($errors['name_link3']) || isset($errors['name_link4'])) {
      if ($num > 1) {
        $output .= "<li class=\"foobgar\">NOTE: I can't retain your file selections if there are errors. Every time there is <em>any</em> error you need to reselect the files you want to upload.</li>";
      } else {
        $output .= "<li class=\"foobgar\">NOTE: I can't retain your file selection if there are errors. Every time there is <em>any</em> error you need to reselect the file you want to upload.</li>";
      }
    }

    foreach($errors as $error) {
      $output .= "<li>" . h($error) . "</li>";
    }
    $output .= "</ul>";
    $output .= "</div>";
  	}
  	return $output;
	}

function display_theme_errors($errors=array()) {
  $output = '';
  if(!empty($errors)) {
    $num = count($errors);

    $output .= "<div class=\"errors\">";
    // $output .= "Head's up!";
    $output .= '<img class="holup" src="_images/hol-up.webp">';
    $output .= "<ul>";

    if (isset($errors['name_link1']) || isset($errors['name_link2']) || isset($errors['name_link3']) || isset($errors['name_link4'])) {
      if ($num > 1) {
        $output .= "<li class=\"foobgar\">So, you changed the theme <span class=\"iw\">after</span> you edited the file uploads section?! That's an unusual sequence of choices. I can't retain your file selections when the page reloads. You'll need to reselect the files you want to upload.</li>";
      } else {
        $output .= "<li class=\"foobgar\">So, you changed the theme <span class=\"iw\">after</span> you edited the file uploads section?! That's an unusual sequence of choices. I can't retain your file selections when the page reloads. You'll need to reselect the file you want to upload.</li>";
      }
    }

    foreach($errors as $error) {
      $output .= "<li>" . h($error) . "</li>";
    }

    $output .= "</ul>";
    $output .= "</div>";
  }
  return $output;
}

function ewd_copyright($startYear) {
  $currentYear = date('Y');
  if ($startYear < $currentYear) {
    $currentYear = date('y');
    // return "<i class=\"fas fa-peace\"></i> $startYear&ndash;$currentYear";
    return "<i class=\"far fa-heart\"></i> $startYear&ndash;$currentYear";
  } else {
    // return "<i class=\"fas fa-peace\"></i> $startYear";
    return "<i class=\"far fa-heart\"></i> $startYear";
  }
}


	
?>