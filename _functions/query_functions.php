<?php

function get_meetings_for_today($today) {
    global $db;

    $sql = "SELECT * FROM meetings WHERE ";
    $sql .= "" . $today . " != 0 ORDER BY meet_time;";
    // echo $sql; 
    $result = mysqli_query($db, $sql); 
    return $result;
}

function create_new_meeting($id, $groupname, $sun, $mon, $tue, $wed, $thu, $fri, $sat, $time, $ampm, $phone, $idnum, $meetingpswd, $meeturl, $dedicated_om, $code_o, $code_w, $code_m, $code_c, $code_beg, $code_h, $code_d, $code_b, $code_ss, $code_sp, $month_speaker, $potluck, $addnotes) {
  global $db;

  $sql = "INSERT INTO meetings ";
  $sql .= "(id_user, group_name, sun, mon, tue, wed, thu, fri, sat, meet_time, am_pm, meet_phone, meet_id, meet_pswd, meet_url, dedicated_om, code_o, code_w, code_m, code_c, code_beg, code_h, code_d, code_b, code_ss, code_sp, month_speaker, potluck, add_note) ";
  $sql .= "VALUES ("; 
  $sql .= "'" . $id       . "', ";
  $sql .= "'" . $groupname    . "', ";
  $sql .= "'" . $sun      . "', ";
  $sql .= "'" . $mon      . "', ";
  $sql .= "'" . $tue      . "', ";
  $sql .= "'" . $wed      . "', ";
  $sql .= "'" . $thu      . "', ";
  $sql .= "'" . $fri      . "', ";
  $sql .= "'" . $sat      . "', ";
  $sql .= "'" . $time       . "', ";
  $sql .= "'" . $ampm       . "', ";
  $sql .= "'" . $phone      . "', ";
  $sql .= "'" . $idnum      . "', ";
  $sql .= "'" . $meetingpswd  . "', ";
  $sql .= "'" . $meeturl    . "', ";
  $sql .= "'" . $dedicated_om   . "', ";
  $sql .= "'" . $code_o     . "', ";
  $sql .= "'" . $code_w     . "', ";
  $sql .= "'" . $code_m     . "', ";
  $sql .= "'" . $code_c     . "', ";
  $sql .= "'" . $code_beg     . "', ";
  $sql .= "'" . $code_h     . "', ";
  $sql .= "'" . $code_d     . "', ";
  $sql .= "'" . $code_b     . "', ";
  $sql .= "'" . $code_ss    . "', ";
  $sql .= "'" . $code_sp    . "', ";
  $sql .= "'" . $month_speaker  . "', ";
  $sql .= "'" . $potluck    . "', ";
  $sql .= "'" . $addnotes     . "'";
  $sql .= ")";
  $result = mysqli_query($db, $sql); 

  if ($result) {
    return true;
  } else {
    echo mysqli_error($db);
    db_disconnect($db);
    exit;
  }

}

function edit_meeting($id) {
  global $db;

  $sql = "SELECT * FROM meetings WHERE ";
  $sql .= "id_mtg='" . $id . "' ";
  // $sql .= "ORDER BY meet_time;";
  // echo $sql; 
  $result = mysqli_query($db, $sql); 
  confirm_result_set($result);
  $row = mysqli_fetch_assoc($result);
  mysqli_free_result($result);
  return $row;   
}

function find_all_users() {
	global $db;

	$sql 	= "SELECT * FROM users ";
	$sql 	.= "ORDER BY id ASC";
	// echo $sql;
	$result = mysqli_query($db, $sql);
	confirm_result_set($result);
	return $result;
}

function find_all_meetings() {
	global $db;

	$sql = 	"SELECT * FROM meetings ";
	$sql .= "ORDER BY id ASC";
	// echo $sql;
	$result = mysqli_query($db, $sql);
	confirm_result_set($result);
	return $result;
}

function find_meetings_by_id($id) {
	global $db;

	$sql = "SELECT * FROM meetings ";
	$sql .= "WHERE id_user='" . $id . "' ";
  $sql .= "ORDER BY meet_time;";
	$result = mysqli_query($db, $sql);
	confirm_result_set($result);	
	return $result; // returns an assoc. array	
}

function validate_update($row) {

  $errors = [];

  if (is_blank($row['group_name'])) {
    $errors[] = "Name your Meeting! Under 50 characters, please.";
  } else if (!has_length($row['group_name'], ['min' => 1, 'max' => 50])) {
    $errors[] = "Meeting Name needs to be less than 50 characters.";
  }

  return $errors; 
 
}

function update_meeting($id, $row) {
  global $db;

  $errors = validate_update($row);
  if (!empty($errors)) {
    return $errors;
  }

  $sql = "UPDATE meetings SET ";
  $sql .= "group_name='"    . $row['group_name']    . "', ";
  $sql .= "sun='"           . $row['sun']           . "', ";
  $sql .= "mon='"           . $row['mon']       . "', ";
  $sql .= "tue='"           . $row['tue']       . "', ";
  $sql .= "wed='"           . $row['wed']       . "', ";
  $sql .= "thu='"           . $row['thu']       . "', ";
  $sql .= "fri='"           . $row['fri']       . "', ";
  $sql .= "sat='"           . $row['sat']       . "', ";
  $sql .= "meet_time='"     . $row['meet_time']   . "', ";
  $sql .= "am_pm='"         . $row['am_pm']     . "', ";
  $sql .= "meet_phone='"    . $row['meet_phone']  . "', ";
  $sql .= "meet_id='"       . $row['meet_id']     . "', ";
  $sql .= "meet_pswd='"     . $row['meet_pswd']   . "', ";
  $sql .= "meet_url='"      . $row['meet_url']    . "', ";
  $sql .= "dedicated_om='"  . $row['dedicated_om']  . "', ";
  $sql .= "code_b='"        . $row['code_b']    . "', ";
  $sql .= "code_d='"        . $row['code_d']    . "', ";
  $sql .= "code_o='"        . $row['code_o']    . "', ";
  $sql .= "code_w='"        . $row['code_w']    . "', ";
  $sql .= "code_beg='"      . $row['code_beg']    . "', ";
  $sql .= "code_h='"        . $row['code_h']    . "', ";
  $sql .= "code_c='"        . $row['code_c']    . "', ";
  $sql .= "code_m='"        . $row['code_m']    . "', ";
  $sql .= "code_ss='"       . $row['code_ss']     . "', ";
  $sql .= "code_sp='"       . $row['code_sp']   . "', ";
  $sql .= "month_speaker='" . $row['month_speaker'] . "', ";
  $sql .= "potluck='"       . $row['potluck']     . "', ";
  $sql .= "add_note='"      . $row['add_note']    . "' ";

  $sql .= "WHERE id_mtg='"  . $id . "' ";
  $sql .= "LIMIT 1";

  $result = mysqli_query($db, $sql);
  // UPDATE statements are true/false
  if($result === true) {
    return true;
    } else {
      // UPDATE failed
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }  
}

function is_blank($value) {
	
  return !isset($value) || trim($value) === '';
}

function has_presence($value) {
	
  return !is_blank($value);
}

// has_length_greater_than('abcd', 3)
// * validate string length
// * spaces count towards length
// * use trim() if spaces should not count
function has_length_greater_than($value, $min) {
  $length = strlen($value);
  return $length > $min;
}

// has_length_less_than('abcd', 5)
// * validate string length
// * spaces count towards length
// * use trim() if spaces should not count
function has_length_less_than($value, $max) {
  $length = strlen($value);
  return $length < $max;
}
// has_length('abcd', ['min' => 3, 'max' => 5])
// * validate string length
// * combines functions_greater_than, _less_than, _exactly
// * spaces count towards length
// * use trim() if spaces should not count
function has_length($value, $options) {
  if(isset($options['min']) && !has_length_greater_than($value, $options['min'] - 1)) {
    return false;
  } elseif(isset($options['max']) && !has_length_less_than($value, $options['max'] + 1)) {
    return false;
  } elseif(isset($options['exact']) && !has_length_exactly($value, $options['exact'])) {
    return false;
  } else {
    return true;
  }
}

function validate_row($row) {
  $errors = [];

	if(is_blank($row['group_name'])) {
		$errors[] = "You need a name for your group.";
	}
	if(!has_length($row['group_name'], ['min' => 1, 'max' => 50])) {
		$errors[] = "Group name can be up to 50 characters.";
	}
	return $errors;
}

