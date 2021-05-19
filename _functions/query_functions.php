<?php

function get_meetings_for_today($today) {
    global $db;

    $sql = "SELECT * FROM meetings WHERE ";
    $sql .= "" . $today . " != 0 ORDER BY meet_time;";
    // echo $sql; 
    $result = mysqli_query($db, $sql); 
    return $result;
}

function get_all_public_meetings_for_today($today) {
    global $db;

    $sql = "SELECT * FROM meetings WHERE ";
    $sql .= "" . $today . " != 0 ";
    $sql .= "AND visible != 0 ";
    $sql .= "AND visible != 1 ";
    $sql .= "ORDER BY meet_time;";
    // echo $sql; 
    $result = mysqli_query($db, $sql); 
    return $result;
}

function get_all_public_and_private_meetings_for_today($today) {
    global $db;

    $sql = "SELECT * FROM meetings WHERE ";
    $sql .= "" . $today . " != 0 ";
    $sql .= "AND visible != 0 ";
    $sql .= "ORDER BY meet_time;";
    // echo $sql; 
    $result = mysqli_query($db, $sql); 
    return $result;
}

function create_new_meeting($row, $nf1, $fn1, $nf2, $fn2, $nf3, $fn3, $nf4, $fn4) {
  global $db;

    $errors = validate_new($row, $nf1, $fn1, $nf2, $fn2, $nf3, $fn3, $nf4, $fn4);
    if (!empty($errors)) {
      return $errors;
    }


  if (isset($fn1) && ($fn1 != '')) {
    if (move_uploaded_file($fn1, 'uploads/' . $nf1)) {
      // upload successful. continue processing.
    } else {
      $errors['upload_error'] = "There was a problem uploading file in position 1. Please try again.";
      return $errors;
    }
  }
  if (isset($fn2) && ($fn2 != '')) {
    if (move_uploaded_file($fn2, 'uploads/' . $nf2)) {
      // upload successful. continue processing.
    } else {
      $errors['upload_error'] = "There was a problem uploading file in position 2. Please try again.";
      return $errors;
    }
  }
  if (isset($fn3) && ($fn3 != '')) {
    if (move_uploaded_file($fn3, 'uploads/' . $nf3)) {
      // upload successful. continue processing.
    } else {
      $errors['upload_error'] = "There was a problem uploading file in position 3. Please try again.";
      return $errors;
    }
  }
  if (isset($fn4) && ($fn4 != '')) {
    if (move_uploaded_file($fn4, 'uploads/' . $nf4)) {
      // upload successful. continue processing.
    } else {
      $errors['upload_error'] = "There was a problem uploading file in position 4. Please try again.";
      return $errors;
    }
  }


  $sql = "INSERT INTO meetings ";
  $sql .= "(id_user, sun, mon, tue, wed, thu, fri, sat, meet_time, group_name, meet_phone, meet_id, meet_pswd, meet_url, meet_addr, meet_desc, dedicated_om, code_b, code_d, code_o, code_w, code_beg, code_h, code_sp, code_c, code_m, code_ss, month_speaker, potluck, file1, link1, file2, link2, file3, link3, file4, link4, add_note) ";
  $sql .= "VALUES ("; 
  $sql .= "'" . db_escape($db, $row['id_user'])        . "', ";
  $sql .= "'" . $row['sun']            . "', ";
  $sql .= "'" . $row['mon']            . "', ";
  $sql .= "'" . $row['tue']            . "', ";
  $sql .= "'" . $row['wed']            . "', ";
  $sql .= "'" . $row['thu']            . "', ";
  $sql .= "'" . $row['fri']            . "', ";
  $sql .= "'" . $row['sat']            . "', ";
  $sql .= "'" . date('Hi', strtotime($row['meet_time']))        . "', ";
  $sql .= "'" . db_escape($db, $row['group_name'])     . "', ";
  $sql .= "'" . db_escape($db, $row['meet_phone'])     . "', ";
  $sql .= "'" . db_escape($db, $row['meet_id'])        . "', ";
  $sql .= "'" . db_escape($db, $row['meet_pswd'])      . "', ";
  $sql .= "'" . db_escape($db, $row['meet_url'])       . "', ";
  $sql .= "'" . db_escape($db, $row['meet_addr'])       . "', ";
  $sql .= "'" . db_escape($db, $row['meet_desc'])       . "', ";
  $sql .= "'" . $row['dedicated_om']   . "', ";
  $sql .= "'" . $row['code_b']         . "', ";
  $sql .= "'" . $row['code_d']         . "', ";
  $sql .= "'" . $row['code_o']         . "', ";
  $sql .= "'" . $row['code_w']         . "', ";
  $sql .= "'" . $row['code_beg']       . "', ";
  $sql .= "'" . $row['code_h']         . "', ";
  $sql .= "'" . $row['code_sp']        . "', ";
  $sql .= "'" . $row['code_c']         . "', ";
  $sql .= "'" . $row['code_m']         . "', ";
  $sql .= "'" . $row['code_ss']        . "', ";
  $sql .= "'" . $row['month_speaker']  . "', ";
  $sql .= "'" . $row['potluck']        . "', ";

  $sql .= "'" . db_escape($db, $nf1)       . "', ";
  $sql .= "'" . db_escape($db, $row['link1'])       . "', ";
  $sql .= "'" . db_escape($db, $nf2)       . "', ";
  $sql .= "'" . db_escape($db, $row['link2'])       . "', ";
  $sql .= "'" . db_escape($db, $nf3)       . "', ";
  $sql .= "'" . db_escape($db, $row['link3'])       . "', ";
  $sql .= "'" . db_escape($db, $nf4)       . "', ";
  $sql .= "'" . db_escape($db, $row['link4'])       . "', ";

  $sql .= "'" . db_escape($db, $row['add_note'])       . "'";
  $sql .= ")";
  $result = mysqli_query($db, $sql);
  // echo $sql;  

  if ($result) {
    return true;
  } else {
    echo mysqli_error($db);
    db_disconnect($db);
    exit;
  }
}

function update_meeting($id, $row, $nf1, $fn1, $nf2, $fn2, $nf3, $fn3, $nf4, $fn4) {
  global $db;

  $errors = validate_update($row, $nf1, $fn1, $nf2, $fn2, $nf3, $fn3, $nf4, $fn4);
  if (!empty($errors)) {
    return $errors;
  }



  if (isset($fn1) && ($fn1 != '')) {
    if (move_uploaded_file($fn1, 'uploads/' . $nf1)) {
      // upload successful. continue processing.
    } else {
      $errors['upload_error'] = "There was a problem uploading file in position 1. Please try again.";
      return $errors;
    }
  }
  if (isset($fn2) && ($fn2 != '')) {
    if (move_uploaded_file($fn2, 'uploads/' . $nf2)) {
      // upload successful. continue processing.
    } else {
      $errors['upload_error'] = "There was a problem uploading file in position 2. Please try again.";
      return $errors;
    }
  }
  if (isset($fn3) && ($fn3 != '')) {
    if (move_uploaded_file($fn3, 'uploads/' . $nf3)) {
      // upload successful. continue processing.
    } else {
      $errors['upload_error'] = "There was a problem uploading file in position 3. Please try again.";
      return $errors;
    }
  }
  if (isset($fn4) && ($fn4 != '')) {
    if (move_uploaded_file($fn4, 'uploads/' . $nf4)) {
      // upload successful. continue processing.
    } else {
      $errors['upload_error'] = "There was a problem uploading file in position 4. Please try again.";
      return $errors;
    }
  }


  $sql = "UPDATE meetings SET ";
  $sql .= "visible='"       . $row['visible']           . "', ";
  $sql .= "sun='"           . $row['sun']           . "', ";
  $sql .= "mon='"           . $row['mon']           . "', ";
  $sql .= "tue='"           . $row['tue']           . "', ";
  $sql .= "wed='"           . $row['wed']           . "', ";
  $sql .= "thu='"           . $row['thu']           . "', ";
  $sql .= "fri='"           . $row['fri']           . "', ";
  $sql .= "sat='"           . $row['sat']           . "', ";
  $sql .= "group_name='"    . db_escape($db, $row['group_name'])    . "', ";
  $sql .= "meet_time='"     . date('Hi', strtotime($row['meet_time']))        . "', ";
  $sql .= "meet_phone='"    . db_escape($db, $row['meet_phone'])    . "', ";
  $sql .= "meet_id='"       . db_escape($db, $row['meet_id'])       . "', ";
  $sql .= "meet_pswd='"     . db_escape($db, $row['meet_pswd'])     . "', ";
  $sql .= "meet_url='"      . db_escape($db, $row['meet_url'])      . "', ";
  $sql .= "meet_addr='"      . db_escape($db, $row['meet_addr'])      . "', ";
  $sql .= "meet_desc='"      . db_escape($db, $row['meet_desc'])      . "', ";
  $sql .= "dedicated_om='"  . $row['dedicated_om']  . "', ";
  $sql .= "code_b='"        . $row['code_b']        . "', ";
  $sql .= "code_d='"        . $row['code_d']        . "', ";
  $sql .= "code_o='"        . $row['code_o']        . "', ";
  $sql .= "code_w='"        . $row['code_w']        . "', ";
  $sql .= "code_beg='"      . $row['code_beg']      . "', ";
  $sql .= "code_h='"        . $row['code_h']        . "', ";
  $sql .= "code_c='"        . $row['code_c']        . "', ";
  $sql .= "code_m='"        . $row['code_m']        . "', ";
  $sql .= "code_ss='"       . $row['code_ss']       . "', ";
  $sql .= "code_sp='"       . $row['code_sp']       . "', ";
  $sql .= "month_speaker='" . $row['month_speaker'] . "', ";
  $sql .= "potluck='"       . $row['potluck']       . "', ";

  $sql .= "file1='"  . db_escape($db, $nf1)  . "', ";
  $sql .= "link1='"  . db_escape($db, $row['link1'])  . "', ";
  $sql .= "file2='"  . db_escape($db, $nf2)  . "', ";
  $sql .= "link2='"  . db_escape($db, $row['link2'])  . "', ";
  $sql .= "file3='"  . db_escape($db, $nf3)  . "', ";
  $sql .= "link3='"  . db_escape($db, $row['link3'])  . "', ";
  $sql .= "file4='"  . db_escape($db, $nf4)  . "', ";
  $sql .= "link4='"  . db_escape($db, $row['link4'])  . "', ";



  $sql .= "add_note='"      . db_escape($db, $row['add_note'])      . "' ";

  $sql .= "WHERE id_mtg='"  . db_escape($db, $id) . "' ";
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

function finalize_new_meeting($id, $row) {
  global $db;

  $sql = "UPDATE meetings SET ";
  $sql .= "visible='"       . $row['visible']           . "' ";
 
  $sql .= "WHERE id_mtg='"  . db_escape($db, $id) . "' ";
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

function delete_meeting($id) {
  global $db;

  $sql = "DELETE FROM meetings ";
  $sql .= "WHERE id='" . db_escape($db, $id) . "' ";
  $sql .= "LIMIT 1'";

  $result = mysqli_query($db, $sql);

  if($result) {
    // $_SESSION["message"] = "You deleted that sucker!";
    return true;
  } else {
    // delete failed
    echo mysqli_error($db);
    db_disconnect($db);
    exit;
  }
}

function edit_meeting($id) {
  global $db;

  $sql = "SELECT * FROM meetings WHERE ";
  $sql .= "id_mtg='" . db_escape($db, $id) . "' ";
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
	$sql 	.= "ORDER BY id_user ASC";
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

  $sql = "SELECT * FROM meetings WHERE ";
  // for some reason (?!) you cannot pass in $today into single quotes.
  // this cost me countless amount of time.
  $sql .= "id_user='" . db_escape($db, $id) . "' ";
  // echo $sql;
  $result = mysqli_query($db, $sql);
  confirm_result_set($result);  
  return $result; // returns an assoc. array  
}

function find_meetings_by_id_today($id, $today) {
	global $db;

	$sql = "SELECT * FROM meetings WHERE ";
	// for some reason (?!) you cannot pass in $today into single quotes.
  // this cost me countless amount of time.
  $sql .= "id_user='" . db_escape($db, $id) . "' AND " . $today . " !=0 ";
  $sql .= "ORDER BY meet_time;";
  // echo $sql;
	$result = mysqli_query($db, $sql);
	confirm_result_set($result);	
	return $result; // returns an assoc. array	
}

// different validation function for updates because you have to account for $row['value']
// that might be in field and also to compare $_POST['value'] in case there's a difference.
// it's a cluster but trust yourself - this is right... unless it's not.
function validate_new($row, $nf1, $fn1, $nf2, $fn2, $nf3, $fn3, $nf4, $fn4) {

  $errors = [];

  if (is_blank($row['group_name']) && ((isset($fn1) && $fn1 != '') || (isset($fn2) && $fn2 != '') || (isset($fn3) && $fn3 != '') || (isset($fn4) && $fn4 != ''))) {
    $errors['group_name'] = "Name your Meeting! Under 50 characters, please.";
    if (isset($fn1) && $fn1 != '') {
      $errors['name_link1'] = "Restore file selection in position 1.";
    }
    if (isset($fn2) && $fn2 != '') {
      $errors['name_link2'] = "Restore file selection in position 2";
    }
    if (isset($fn3) && $fn3 != '') {
      $errors['name_link3'] = "Restore file selection in position 3";
    }
    if (isset($fn4) && $fn4 != '') {
      $errors['name_link4'] = "Restore file selection in position 4";
    }
    
  } else if (is_blank($row['group_name'])) {
    $errors['group_name'] = "Name your Meeting! Under 50 characters, please.";
    if (isset($fn1) && $fn1 != '') {
      $errors['name_link1'] = "Restore file selection in position 1.";
    }
    if (isset($fn2) && $fn2 != '') {
      $errors['name_link2'] = "Restore file selection in position 2";
    }
    if (isset($fn3) && $fn3 != '') {
      $errors['name_link3'] = "Restore file selection in position 3";
    }
    if (isset($fn4) && $fn4 != '') {
      $errors['name_link4'] = "Restore file selection in position 4";
    }


  } else if (!has_length($row['group_name'], ['min' => 1, 'max' => 50])) {
    $errors['group_name'] = "Meeting Name needs to be less than 50 characters.";
    if (isset($fn1) && $fn1 != '') {
      $errors['name_link1'] = "Restore file selection in position 1.";
    }
    if (isset($fn2) && $fn2 != '') {
      $errors['name_link2'] = "Restore file selection in position 2";
    }
    if (isset($fn3) && $fn3 != '') {
      $errors['name_link3'] = "Restore file selection in position 3";
    }
    if (isset($fn4) && $fn4 != '') {
      $errors['name_link4'] = "Restore file selection in position 4";
    }


  }


  if (( $row['sun'] == "0" && 
        $row['mon'] == "0" && 
        $row['tue'] == "0" && 
        $row['wed'] == "0" && 
        $row['thu'] == "0" && 
        $row['fri'] == "0" && 
        $row['sat'] == "0"  ) && ((isset($fn1) && $fn1 != '') || (isset($fn2) && $fn2 != '') || (isset($fn3) && $fn3 != '') || (isset($fn4) && $fn4 != ''))) {
    $errors['pick_a_day'] = "Pick a day or days for your meeting.";
    if (isset($fn1) && $fn1 != '') {
      $errors['name_link1'] = "Restore file selection in position 1.";
    }
    if (isset($fn2) && $fn2 != '') {
      $errors['name_link2'] = "Restore file selection in position 2";
    }
    if (isset($fn3) && $fn3 != '') {
      $errors['name_link3'] = "Restore file selection in position 3";
    }
    if (isset($fn4) && $fn4 != '') {
      $errors['name_link4'] = "Restore file selection in position 4";
    }

  } else if (( $row['sun'] == "0" && 
        $row['mon'] == "0" && 
        $row['tue'] == "0" && 
        $row['wed'] == "0" && 
        $row['thu'] == "0" && 
        $row['fri'] == "0" && 
        $row['sat'] == "0"  )) {
    $errors['pick_a_day'] = "Pick a day or days for your meeting.";
  }

   if (is_blank($row['meet_time']) && ((isset($fn1) && $fn1 != '') || (isset($fn2) && $fn2 != '') || (isset($fn3) && $fn3 != '') || (isset($fn4) && $fn4 != ''))) {
    $errors['meet_time'] = "Please set a time.";
    if (isset($fn1) && $fn1 != '') {
      $errors['name_link1'] = "Restore file selection in position 1.";
    }
    if (isset($fn2) && $fn2 != '') {
      $errors['name_link2'] = "Restore file selection in position 2";
    }
    if (isset($fn3) && $fn3 != '') {
      $errors['name_link3'] = "Restore file selection in position 3";
    }
    if (isset($fn4) && $fn4 != '') {
      $errors['name_link4'] = "Restore file selection in position 4";
    }

  } else if (is_blank($row['meet_time'])) {
    $errors['meet_time'] = "Please set a time.";
  }


  if ((!is_blank($row['meet_phone']) && has_length_less_than($row['meet_phone'], 10)) && ((isset($fn1) && $fn1 != '') || (isset($fn2) && $fn2 != '') || (isset($fn3) && $fn3 != '') || (isset($fn4) && $fn4 != ''))) {
    $errors['meet_phone'] = "Only 10-digit phone numbers.";
    if (isset($fn1) && $fn1 != '') {
      $errors['name_link1'] = "Restore file selection in position 1.";
    }
    if (isset($fn2) && $fn2 != '') {
      $errors['name_link2'] = "Restore file selection in position 2";
    }
    if (isset($fn3) && $fn3 != '') {
      $errors['name_link3'] = "Restore file selection in position 3";
    }
    if (isset($fn4) && $fn4 != '') {
      $errors['name_link4'] = "Restore file selection in position 4";
    }

  } else if (!is_blank($row['meet_phone']) && has_length_less_than($row['meet_phone'], 10)) {
    $errors['meet_phone'] = "Only 10-digit phone numbers.";
  }


  if ((!is_blank($row['meet_phone']) && has_length_greater_than($row['meet_phone'], 10)) && ((isset($fn1) && $fn1 != '') || (isset($fn2) && $fn2 != '') || (isset($fn3) && $fn3 != '') || (isset($fn4) && $fn4 != ''))) {
    $errors['meet_phone'] = "You've got too many numbers in your phone number.";
    if (isset($fn1) && $fn1 != '') {
      $errors['name_link1'] = "Restore file selection in position 1.";
    }
    if (isset($fn2) && $fn2 != '') {
      $errors['name_link2'] = "Restore file selection in position 2";
    }
    if (isset($fn3) && $fn3 != '') {
      $errors['name_link3'] = "Restore file selection in position 3";
    }
    if (isset($fn4) && $fn4 != '') {
      $errors['name_link4'] = "Restore file selection in position 4";
    }

  } else if (!is_blank($row['meet_phone']) && has_length_greater_than($row['meet_phone'], 10)) {
    $errors['meet_phone'] = "You've got too many numbers in your phone number.";
  }


  if ((!is_blank($row['meet_id']) && has_length_greater_than($row['meet_id'], 15)) && ((isset($fn1) && $fn1 != '') || (isset($fn2) && $fn2 != '') || (isset($fn3) && $fn3 != '') || (isset($fn4) && $fn4 != ''))) {
    $errors['meet_id'] = "Meeting ID's aren't that long! C'mon man.";
    if (isset($fn1) && $fn1 != '') {
      $errors['name_link1'] = "Restore file selection in position 1.";
    }
    if (isset($fn2) && $fn2 != '') {
      $errors['name_link2'] = "Restore file selection in position 2";
    }
    if (isset($fn3) && $fn3 != '') {
      $errors['name_link3'] = "Restore file selection in position 3";
    }
    if (isset($fn4) && $fn4 != '') {
      $errors['name_link4'] = "Restore file selection in position 4";
    }

  } else if (!is_blank($row['meet_id']) && has_length_greater_than($row['meet_id'], 15)) {
    $errors['meet_id'] = "Meeting ID's aren't that long! C'mon man.";
  } 


  if ((!is_blank($row['meet_pswd']) && has_length_greater_than($row['meet_pswd'], 30)) && ((isset($fn1) && $fn1 != '') || (isset($fn2) && $fn2 != '') || (isset($fn3) && $fn3 != '') || (isset($fn4) && $fn4 != ''))) {
    $errors['meet_pswd'] = "That password is way too long.";
    if (isset($fn1) && $fn1 != '') {
      $errors['name_link1'] = "Restore file selection in position 1.";
    }
    if (isset($fn2) && $fn2 != '') {
      $errors['name_link2'] = "Restore file selection in position 2";
    }
    if (isset($fn3) && $fn3 != '') {
      $errors['name_link3'] = "Restore file selection in position 3";
    }
    if (isset($fn4) && $fn4 != '') {
      $errors['name_link4'] = "Restore file selection in position 4";
    }

  } else if (!is_blank($row['meet_pswd']) && has_length_greater_than($row['meet_pswd'], 30)) {
    $errors['meet_pswd'] = "That password is way too long.";
  } 


  if ((is_blank($row['meet_url']) && is_blank($row['meet_addr']) && is_blank($row['meet_desc'])) && ((isset($fn1) && $fn1 != '') || (isset($fn2) && $fn2 != '') || (isset($fn3) && $fn3 != '') || (isset($fn4) && $fn4 != ''))) {
    $errors['meet_url'] = "You need either an Online URL or Physical Address to host a meeting.";
    if (isset($fn1) && $fn1 != '') {
      $errors['name_link1'] = "Restore file selection in position 1.";
    }
    if (isset($fn2) && $fn2 != '') {
      $errors['name_link2'] = "Restore file selection in position 2";
    }
    if (isset($fn3) && $fn3 != '') {
      $errors['name_link3'] = "Restore file selection in position 3";
    }
    if (isset($fn4) && $fn4 != '') {
      $errors['name_link4'] = "Restore file selection in position 4";
    }

  } else if (is_blank($row['meet_url']) && is_blank($row['meet_addr']) && is_blank($row['meet_desc'])) {
    $errors['meet_url'] = "You need either an Online URL or Physical Address to host a meeting.";
  }


  if ((!is_blank($row['meet_addr']) && has_length_greater_than($row['meet_addr'], 255)) && ((isset($fn1) && $fn1 != '') || (isset($fn2) && $fn2 != '') || (isset($fn3) && $fn3 != '') || (isset($fn4) && $fn4 != ''))) {
    $errors['meet_addr'] = "255 Character limit on physical address";
    if (isset($fn1) && $fn1 != '') {
      $errors['name_link1'] = "Restore file selection in position 1.";
    }
    if (isset($fn2) && $fn2 != '') {
      $errors['name_link2'] = "Restore file selection in position 2";
    }
    if (isset($fn3) && $fn3 != '') {
      $errors['name_link3'] = "Restore file selection in position 3";
    }
    if (isset($fn4) && $fn4 != '') {
      $errors['name_link4'] = "Restore file selection in position 4";
    }

  } else if (!is_blank($row['meet_addr']) && has_length_greater_than($row['meet_addr'], 255)) {
    $errors['meet_addr'] = "255 Character limit on physical address";
  }


  if ((!is_blank($row['meet_desc']) && has_length_greater_than($row['meet_desc'], 255)) && ((isset($fn1) && $fn1 != '') || (isset($fn2) && $fn2 != '') || (isset($fn3) && $fn3 != '') || (isset($fn4) && $fn4 != ''))) {
    $errors['meet_addr'] = "255 Character limit on descriptive location";
    if (isset($fn1) && $fn1 != '') {
      $errors['name_link1'] = "Restore file selection in position 1.";
    }
    if (isset($fn2) && $fn2 != '') {
      $errors['name_link2'] = "Restore file selection in position 2";
    }
    if (isset($fn3) && $fn3 != '') {
      $errors['name_link3'] = "Restore file selection in position 3";
    }
    if (isset($fn4) && $fn4 != '') {
      $errors['name_link4'] = "Restore file selection in position 4";
    }

  } else if (!is_blank($row['meet_desc']) && has_length_greater_than($row['meet_desc'], 255)) {
    $errors['meet_addr'] = "255 Character limit on descriptive location";
  }


  if ((is_blank($row['meet_addr']) && (!is_blank($row['meet_desc']))) && ((isset($fn1) && $fn1 != '') || (isset($fn2) && $fn2 != '') || (isset($fn3) && $fn3 != '') || (isset($fn4) && $fn4 != ''))) {
    $errors['meet_addr'] = "You need location information for your map.";
    if (isset($fn1) && $fn1 != '') {
      $errors['name_link1'] = "Restore file selection in position 1.";
    }
    if (isset($fn2) && $fn2 != '') {
      $errors['name_link2'] = "Restore file selection in position 2";
    }
    if (isset($fn3) && $fn3 != '') {
      $errors['name_link3'] = "Restore file selection in position 3";
    }
    if (isset($fn4) && $fn4 != '') {
      $errors['name_link4'] = "Restore file selection in position 4";
    }

  } else if (is_blank($row['meet_addr']) && (!is_blank($row['meet_desc'])) ) {
    $errors['meet_addr'] = "You need location information for your map.";
  }


  if ((( $row['dedicated_om']    == "0"   && 
          $row['code_o']          == "0"   && 
          $row['code_w']          == "0"   && 
          $row['code_m']          == "0"   && 
          $row['code_c']          == "0"   && 
          $row['code_beg']        == "0"   && 
          $row['code_h']          == "0"   && 
          $row['code_d']          == "0"   && 
          $row['code_b']          == "0"   && 
          $row['code_ss']         == "0"   && 
          $row['code_sp']         == "0"   && 
          $row['month_speaker']   == "0"   && 
          $row['potluck']         == "0"   )) && ((isset($fn1) && $fn1 != '') || (isset($fn2) && $fn2 != '') || (isset($fn3) && $fn3 != '') || (isset($fn4) && $fn4 != ''))) {
    $errors['meeting_type'] = "Select at least ONE value for the type of meeting. Your meeting is either Open or Closed at least.";
    if (isset($fn1) && $fn1 != '') {
      $errors['name_link1'] = "Restore file selection in position 1.";
    }
    if (isset($fn2) && $fn2 != '') {
      $errors['name_link2'] = "Restore file selection in position 2";
    }
    if (isset($fn3) && $fn3 != '') {
      $errors['name_link3'] = "Restore file selection in position 3";
    }
    if (isset($fn4) && $fn4 != '') {
      $errors['name_link4'] = "Restore file selection in position 4";
    }

  } else if (( $row['dedicated_om']    == "0"   && 
        $row['code_o']          == "0"   && 
        $row['code_w']          == "0"   && 
        $row['code_m']          == "0"   && 
        $row['code_c']          == "0"   && 
        $row['code_beg']        == "0"   && 
        $row['code_h']          == "0"   && 
        $row['code_d']          == "0"   && 
        $row['code_b']          == "0"   && 
        $row['code_ss']         == "0"   && 
        $row['code_sp']         == "0"   && 
        $row['month_speaker']   == "0"   && 
        $row['potluck']         == "0"   )) {
    $errors['meeting_type'] = "Select at least ONE value for the type of meeting. Your meeting is either Open or Closed at least.";
  }


  if (($row['dedicated_om'] == "1" && $row['meet_url'] == '') && ((isset($fn1) && $fn1 != '') || (isset($fn2) && $fn2 != '') || (isset($fn3) && $fn3 != '') || (isset($fn4) && $fn4 != ''))) {
    $errors['url_or_phy'] = "If it's a Dedicated Online meeting you need a URL.";
    if (isset($fn1) && $fn1 != '') {
      $errors['name_link1'] = "Restore file selection in position 1.";
    }
    if (isset($fn2) && $fn2 != '') {
      $errors['name_link2'] = "Restore file selection in position 2";
    }
    if (isset($fn3) && $fn3 != '') {
      $errors['name_link3'] = "Restore file selection in position 3";
    }
    if (isset($fn4) && $fn4 != '') {
      $errors['name_link4'] = "Restore file selection in position 4";
    }

  } else if ($row['dedicated_om'] == "1" && $row['meet_url'] == '') {
    $errors['url_or_phy'] = "If it's a Dedicated Online meeting you need a URL.";
  }


  if (($row['dedicated_om'] == "1" && $row['meet_addr'] != '') && ((isset($fn1) && $fn1 != '') || (isset($fn2) && $fn2 != '') || (isset($fn3) && $fn3 != '') || (isset($fn4) && $fn4 != ''))) {
    $errors['url_and_phy'] = "If it's a Dedicated Online meeting you don't need a physical address.";
    if (isset($fn1) && $fn1 != '') {
      $errors['name_link1'] = "Restore file selection in position 1.";
    }
    if (isset($fn2) && $fn2 != '') {
      $errors['name_link2'] = "Restore file selection in position 2";
    }
    if (isset($fn3) && $fn3 != '') {
      $errors['name_link3'] = "Restore file selection in position 3";
    }
    if (isset($fn4) && $fn4 != '') {
      $errors['name_link4'] = "Restore file selection in position 4";
    }

  } else if ($row['dedicated_om'] == "1" && $row['meet_addr'] != '') {
    $errors['url_and_phy'] = "If it's a Dedicated Online meeting you don't need a physical address.";
  }




  // begin file errors for new meeting page

  if ((isset($fn1) && ($fn1 != '')) && is_blank($row['link1'])) {
    $errors['name_link1'] = "You did not name your link in position 1. Please restore file selection.";
  }
  if ((!isset($fn1) || ($fn1 == '')) && (trim($row['link1']) != '')) {
    $errors['name_link1'] = "There's a name but no file to upload in position 1. Please restore file selection.";
  }
  if (((isset($fn1) && $fn1 != '') && ($nf1 == ''))) {
    $errors['name_link1'] = "File upload in Position 1 needs attention. Please restore file selection.";
  }


  if ((isset($fn2) && ($fn2 != '')) && is_blank($row['link2'])) {
    $errors['name_link2'] = "You did not name your link in position 2. Please restore file selection.";
  }
  if ((!isset($fn2) || ($fn2 == '')) && (trim($row['link2']) != '')) {
    $errors['name_link2'] = "There's a name but no file to upload in position 2. Please restore file selection.";
  }
  if (((isset($fn2) && $fn2 != '') && ($nf2 == ''))) {
    $errors['name_link2'] = "File upload in Position 2 needs attention. Please restore file selection.";
  }


  if ((isset($fn3) && ($fn3 != '')) && is_blank($row['link3'])) {
    $errors['name_link3'] = "You did not name your link in position 3. Please restore file selection.";
  }
  if ((!isset($fn3) || ($fn3 == '')) && (trim($row['link3']) != '')) {
    $errors['name_link3'] = "There's a name but no file to upload in position 3. Please restore file selection.";
  }
  if (((isset($fn3) && $fn3 != '') && ($nf3 == ''))) {
    $errors['name_link3'] = "File upload in Position 3 needs attention. Please restore file selection.";
  }


  if ((isset($fn4) && ($fn4 != '')) && is_blank($row['link4'])) {
    $errors['name_link4'] = "You did not name your link in position 4. Please restore file selection.";
  }
  if ((!isset($fn4) || ($fn4 == '')) && (trim($row['link4']) != '')) {
    $errors['name_link4'] = "There's a name but no file to upload in position 4. Please restore file selection.";
  }
  if (((isset($fn4) && $fn4 != '') && ($nf4 == ''))) {
    $errors['name_link4'] = "File upload in Position 4 needs attention. Please restore file selection.";
  }

  // end file errors for new meeting page


  if ((!is_blank($row['add_note']) && has_length_greater_than($row['add_note'], 1000)) && ((isset($fn1) && $fn1 != '') || (isset($fn2) && $fn2 != '') || (isset($fn3) && $fn3 != '') || (isset($fn4) && $fn4 != ''))) {
    if (isset($fn1) && $fn1 != '') {
      $errors['name_link1'] = "Restore file selection in position 1.";
    }
    if (isset($fn2) && $fn2 != '') {
      $errors['name_link2'] = "Restore file selection in position 2";
    }
    if (isset($fn3) && $fn3 != '') {
      $errors['name_link3'] = "Restore file selection in position 3";
    }
    if (isset($fn4) && $fn4 != '') {
      $errors['name_link4'] = "Restore file selection in position 4";
    }  
    $errors['add_note'] = "You've got more than 1,000 characters in your note.";
    
  } else if (!is_blank($row['add_note']) && has_length_greater_than($row['add_note'], 1000)) {
    $errors['add_note'] = "You've got more than 1,000 characters in your note.";
  }  

  return $errors; 
}


// different validation function for new meetings because here you have to account for $row['value']
// that might be in field and also to compare $_POST['value'] in case there's a difference.
// it's a cluster but trust yourself - this is right... unless it's not.
function validate_update($row, $nf1, $fn1, $nf2, $fn2, $nf3, $fn3, $nf4, $fn4) {
// need a separate validation function because of file uploads
  $errors = [];

  if (is_blank($row['group_name']) && ((isset($fn1) && $fn1 != '') || (isset($fn2) && $fn2 != '') || (isset($fn3) && $fn3 != '') || (isset($fn4) && $fn4 != ''))) {
    $errors['group_name'] = "Name your Meeting! Under 50 characters, please.";
    if (isset($fn1) && $fn1 != '') {
      $errors['name_link1'] = "Restore file selection in position 1.";
    }
    if (isset($fn2) && $fn2 != '') {
      $errors['name_link2'] = "Restore file selection in position 2";
    }
    if (isset($fn3) && $fn3 != '') {
      $errors['name_link3'] = "Restore file selection in position 3";
    }
    if (isset($fn4) && $fn4 != '') {
      $errors['name_link4'] = "Restore file selection in position 4";
    }
    
  } else if (is_blank($row['group_name'])) {
    $errors['group_name'] = "Name your Meeting! Under 50 characters, please.";
    if (isset($fn1) && $fn1 != '') {
      $errors['name_link1'] = "Restore file selection in position 1.";
    }
    if (isset($fn2) && $fn2 != '') {
      $errors['name_link2'] = "Restore file selection in position 2";
    }
    if (isset($fn3) && $fn3 != '') {
      $errors['name_link3'] = "Restore file selection in position 3";
    }
    if (isset($fn4) && $fn4 != '') {
      $errors['name_link4'] = "Restore file selection in position 4";
    }


  } else if (!has_length($row['group_name'], ['min' => 1, 'max' => 50])) {
    $errors['group_name'] = "Meeting Name needs to be less than 50 characters.";
    if (isset($fn1) && $fn1 != '') {
      $errors['name_link1'] = "Restore file selection in position 1.";
    }
    if (isset($fn2) && $fn2 != '') {
      $errors['name_link2'] = "Restore file selection in position 2";
    }
    if (isset($fn3) && $fn3 != '') {
      $errors['name_link3'] = "Restore file selection in position 3";
    }
    if (isset($fn4) && $fn4 != '') {
      $errors['name_link4'] = "Restore file selection in position 4";
    }


  }


  if (( $row['sun'] == "0" && 
        $row['mon'] == "0" && 
        $row['tue'] == "0" && 
        $row['wed'] == "0" && 
        $row['thu'] == "0" && 
        $row['fri'] == "0" && 
        $row['sat'] == "0"  ) && ((isset($fn1) && $fn1 != '') || (isset($fn2) && $fn2 != '') || (isset($fn3) && $fn3 != '') || (isset($fn4) && $fn4 != ''))) {
    $errors['pick_a_day'] = "Pick a day or days for your meeting.";
    if (isset($fn1) && $fn1 != '') {
      $errors['name_link1'] = "Restore file selection in position 1.";
    }
    if (isset($fn2) && $fn2 != '') {
      $errors['name_link2'] = "Restore file selection in position 2";
    }
    if (isset($fn3) && $fn3 != '') {
      $errors['name_link3'] = "Restore file selection in position 3";
    }
    if (isset($fn4) && $fn4 != '') {
      $errors['name_link4'] = "Restore file selection in position 4";
    }

  } else if (( $row['sun'] == "0" && 
        $row['mon'] == "0" && 
        $row['tue'] == "0" && 
        $row['wed'] == "0" && 
        $row['thu'] == "0" && 
        $row['fri'] == "0" && 
        $row['sat'] == "0"  )) {
    $errors['pick_a_day'] = "Pick a day or days for your meeting.";
  }

   if (is_blank($row['meet_time']) && ((isset($fn1) && $fn1 != '') || (isset($fn2) && $fn2 != '') || (isset($fn3) && $fn3 != '') || (isset($fn4) && $fn4 != ''))) {
    $errors['meet_time'] = "Please set a time.";
    if (isset($fn1) && $fn1 != '') {
      $errors['name_link1'] = "Restore file selection in position 1.";
    }
    if (isset($fn2) && $fn2 != '') {
      $errors['name_link2'] = "Restore file selection in position 2";
    }
    if (isset($fn3) && $fn3 != '') {
      $errors['name_link3'] = "Restore file selection in position 3";
    }
    if (isset($fn4) && $fn4 != '') {
      $errors['name_link4'] = "Restore file selection in position 4";
    }

  } else if (is_blank($row['meet_time'])) {
    $errors['meet_time'] = "Please set a time.";
  }


  if ((!is_blank($row['meet_phone']) && has_length_less_than($row['meet_phone'], 10)) && ((isset($fn1) && $fn1 != '') || (isset($fn2) && $fn2 != '') || (isset($fn3) && $fn3 != '') || (isset($fn4) && $fn4 != ''))) {
    $errors['meet_phone'] = "Only 10-digit phone numbers.";
    if (isset($fn1) && $fn1 != '') {
      $errors['name_link1'] = "Restore file selection in position 1.";
    }
    if (isset($fn2) && $fn2 != '') {
      $errors['name_link2'] = "Restore file selection in position 2";
    }
    if (isset($fn3) && $fn3 != '') {
      $errors['name_link3'] = "Restore file selection in position 3";
    }
    if (isset($fn4) && $fn4 != '') {
      $errors['name_link4'] = "Restore file selection in position 4";
    }

  } else if (!is_blank($row['meet_phone']) && has_length_less_than($row['meet_phone'], 10)) {
    $errors['meet_phone'] = "Only 10-digit phone numbers.";
  }


  if ((!is_blank($row['meet_phone']) && has_length_greater_than($row['meet_phone'], 10)) && ((isset($fn1) && $fn1 != '') || (isset($fn2) && $fn2 != '') || (isset($fn3) && $fn3 != '') || (isset($fn4) && $fn4 != ''))) {
    $errors['meet_phone'] = "You've got too many numbers in your phone number.";
    if (isset($fn1) && $fn1 != '') {
      $errors['name_link1'] = "Restore file selection in position 1.";
    }
    if (isset($fn2) && $fn2 != '') {
      $errors['name_link2'] = "Restore file selection in position 2";
    }
    if (isset($fn3) && $fn3 != '') {
      $errors['name_link3'] = "Restore file selection in position 3";
    }
    if (isset($fn4) && $fn4 != '') {
      $errors['name_link4'] = "Restore file selection in position 4";
    }

  } else if (!is_blank($row['meet_phone']) && has_length_greater_than($row['meet_phone'], 10)) {
    $errors['meet_phone'] = "You've got too many numbers in your phone number.";
  }


  if ((!is_blank($row['meet_id']) && has_length_greater_than($row['meet_id'], 15)) && ((isset($fn1) && $fn1 != '') || (isset($fn2) && $fn2 != '') || (isset($fn3) && $fn3 != '') || (isset($fn4) && $fn4 != ''))) {
    $errors['meet_id'] = "Meeting ID's aren't that long! C'mon man.";
    if (isset($fn1) && $fn1 != '') {
      $errors['name_link1'] = "Restore file selection in position 1.";
    }
    if (isset($fn2) && $fn2 != '') {
      $errors['name_link2'] = "Restore file selection in position 2";
    }
    if (isset($fn3) && $fn3 != '') {
      $errors['name_link3'] = "Restore file selection in position 3";
    }
    if (isset($fn4) && $fn4 != '') {
      $errors['name_link4'] = "Restore file selection in position 4";
    }

  } else if (!is_blank($row['meet_id']) && has_length_greater_than($row['meet_id'], 15)) {
    $errors['meet_id'] = "Meeting ID's aren't that long! C'mon man.";
  } 


  if ((!is_blank($row['meet_pswd']) && has_length_greater_than($row['meet_pswd'], 30)) && ((isset($fn1) && $fn1 != '') || (isset($fn2) && $fn2 != '') || (isset($fn3) && $fn3 != '') || (isset($fn4) && $fn4 != ''))) {
    $errors['meet_pswd'] = "That password is way too long.";
    if (isset($fn1) && $fn1 != '') {
      $errors['name_link1'] = "Restore file selection in position 1.";
    }
    if (isset($fn2) && $fn2 != '') {
      $errors['name_link2'] = "Restore file selection in position 2";
    }
    if (isset($fn3) && $fn3 != '') {
      $errors['name_link3'] = "Restore file selection in position 3";
    }
    if (isset($fn4) && $fn4 != '') {
      $errors['name_link4'] = "Restore file selection in position 4";
    }

  } else if (!is_blank($row['meet_pswd']) && has_length_greater_than($row['meet_pswd'], 30)) {
    $errors['meet_pswd'] = "That password is way too long.";
  } 


  if ((is_blank($row['meet_url']) && is_blank($row['meet_addr']) && is_blank($row['meet_desc'])) && ((isset($fn1) && $fn1 != '') || (isset($fn2) && $fn2 != '') || (isset($fn3) && $fn3 != '') || (isset($fn4) && $fn4 != ''))) {
    $errors['meet_url'] = "You need either an Online URL or Physical Address to host a meeting.";
    if (isset($fn1) && $fn1 != '') {
      $errors['name_link1'] = "Restore file selection in position 1.";
    }
    if (isset($fn2) && $fn2 != '') {
      $errors['name_link2'] = "Restore file selection in position 2";
    }
    if (isset($fn3) && $fn3 != '') {
      $errors['name_link3'] = "Restore file selection in position 3";
    }
    if (isset($fn4) && $fn4 != '') {
      $errors['name_link4'] = "Restore file selection in position 4";
    }

  } else if (is_blank($row['meet_url']) && is_blank($row['meet_addr']) && is_blank($row['meet_desc'])) {
    $errors['meet_url'] = "You need either an Online URL or Physical Address to host a meeting.";
  }


  if ((!is_blank($row['meet_addr']) && has_length_greater_than($row['meet_addr'], 255)) && ((isset($fn1) && $fn1 != '') || (isset($fn2) && $fn2 != '') || (isset($fn3) && $fn3 != '') || (isset($fn4) && $fn4 != ''))) {
    $errors['meet_addr'] = "255 Character limit on physical address";
    if (isset($fn1) && $fn1 != '') {
      $errors['name_link1'] = "Restore file selection in position 1.";
    }
    if (isset($fn2) && $fn2 != '') {
      $errors['name_link2'] = "Restore file selection in position 2";
    }
    if (isset($fn3) && $fn3 != '') {
      $errors['name_link3'] = "Restore file selection in position 3";
    }
    if (isset($fn4) && $fn4 != '') {
      $errors['name_link4'] = "Restore file selection in position 4";
    }

  } else if (!is_blank($row['meet_addr']) && has_length_greater_than($row['meet_addr'], 255)) {
    $errors['meet_addr'] = "255 Character limit on physical address";
  }


  if ((!is_blank($row['meet_desc']) && has_length_greater_than($row['meet_desc'], 255)) && ((isset($fn1) && $fn1 != '') || (isset($fn2) && $fn2 != '') || (isset($fn3) && $fn3 != '') || (isset($fn4) && $fn4 != ''))) {
    $errors['meet_addr'] = "255 Character limit on descriptive location";
    if (isset($fn1) && $fn1 != '') {
      $errors['name_link1'] = "Restore file selection in position 1.";
    }
    if (isset($fn2) && $fn2 != '') {
      $errors['name_link2'] = "Restore file selection in position 2";
    }
    if (isset($fn3) && $fn3 != '') {
      $errors['name_link3'] = "Restore file selection in position 3";
    }
    if (isset($fn4) && $fn4 != '') {
      $errors['name_link4'] = "Restore file selection in position 4";
    }

  } else if (!is_blank($row['meet_desc']) && has_length_greater_than($row['meet_desc'], 255)) {
    $errors['meet_addr'] = "255 Character limit on descriptive location";
  }


  if ((is_blank($row['meet_addr']) && (!is_blank($row['meet_desc']))) && ((isset($fn1) && $fn1 != '') || (isset($fn2) && $fn2 != '') || (isset($fn3) && $fn3 != '') || (isset($fn4) && $fn4 != ''))) {
    $errors['meet_addr'] = "You need location information for your map.";
    if (isset($fn1) && $fn1 != '') {
      $errors['name_link1'] = "Restore file selection in position 1.";
    }
    if (isset($fn2) && $fn2 != '') {
      $errors['name_link2'] = "Restore file selection in position 2";
    }
    if (isset($fn3) && $fn3 != '') {
      $errors['name_link3'] = "Restore file selection in position 3";
    }
    if (isset($fn4) && $fn4 != '') {
      $errors['name_link4'] = "Restore file selection in position 4";
    }

  } else if (is_blank($row['meet_addr']) && (!is_blank($row['meet_desc'])) ) {
    $errors['meet_addr'] = "You need location information for your map.";
  }


  if ((( $row['dedicated_om']    == "0"   && 
          $row['code_o']          == "0"   && 
          $row['code_w']          == "0"   && 
          $row['code_m']          == "0"   && 
          $row['code_c']          == "0"   && 
          $row['code_beg']        == "0"   && 
          $row['code_h']          == "0"   && 
          $row['code_d']          == "0"   && 
          $row['code_b']          == "0"   && 
          $row['code_ss']         == "0"   && 
          $row['code_sp']         == "0"   && 
          $row['month_speaker']   == "0"   && 
          $row['potluck']         == "0"   )) && ((isset($fn1) && $fn1 != '') || (isset($fn2) && $fn2 != '') || (isset($fn3) && $fn3 != '') || (isset($fn4) && $fn4 != ''))) {
    $errors['meeting_type'] = "Select at least ONE value for the type of meeting. Your meeting is either Open or Closed at least.";
    if (isset($fn1) && $fn1 != '') {
      $errors['name_link1'] = "Restore file selection in position 1.";
    }
    if (isset($fn2) && $fn2 != '') {
      $errors['name_link2'] = "Restore file selection in position 2";
    }
    if (isset($fn3) && $fn3 != '') {
      $errors['name_link3'] = "Restore file selection in position 3";
    }
    if (isset($fn4) && $fn4 != '') {
      $errors['name_link4'] = "Restore file selection in position 4";
    }

  } else if (( $row['dedicated_om']    == "0"   && 
        $row['code_o']          == "0"   && 
        $row['code_w']          == "0"   && 
        $row['code_m']          == "0"   && 
        $row['code_c']          == "0"   && 
        $row['code_beg']        == "0"   && 
        $row['code_h']          == "0"   && 
        $row['code_d']          == "0"   && 
        $row['code_b']          == "0"   && 
        $row['code_ss']         == "0"   && 
        $row['code_sp']         == "0"   && 
        $row['month_speaker']   == "0"   && 
        $row['potluck']         == "0"   )) {
    $errors['meeting_type'] = "Select at least ONE value for the type of meeting. Your meeting is either Open or Closed at least.";
  }


  if (($row['dedicated_om'] == "1" && $row['meet_url'] == '') && ((isset($fn1) && $fn1 != '') || (isset($fn2) && $fn2 != '') || (isset($fn3) && $fn3 != '') || (isset($fn4) && $fn4 != ''))) {
    $errors['url_or_phy'] = "If it's a Dedicated Online meeting you need a URL.";
    if (isset($fn1) && $fn1 != '') {
      $errors['name_link1'] = "Restore file selection in position 1.";
    }
    if (isset($fn2) && $fn2 != '') {
      $errors['name_link2'] = "Restore file selection in position 2";
    }
    if (isset($fn3) && $fn3 != '') {
      $errors['name_link3'] = "Restore file selection in position 3";
    }
    if (isset($fn4) && $fn4 != '') {
      $errors['name_link4'] = "Restore file selection in position 4";
    }

  } else if ($row['dedicated_om'] == "1" && $row['meet_url'] == '') {
    $errors['url_or_phy'] = "If it's a Dedicated Online meeting you need a URL.";
  }


  if (($row['dedicated_om'] == "1" && $row['meet_addr'] != '') && ((isset($fn1) && $fn1 != '') || (isset($fn2) && $fn2 != '') || (isset($fn3) && $fn3 != '') || (isset($fn4) && $fn4 != ''))) {
    $errors['url_and_phy'] = "If it's a Dedicated Online meeting you don't need a physical address.";
    if (isset($fn1) && $fn1 != '') {
      $errors['name_link1'] = "Restore file selection in position 1.";
    }
    if (isset($fn2) && $fn2 != '') {
      $errors['name_link2'] = "Restore file selection in position 2";
    }
    if (isset($fn3) && $fn3 != '') {
      $errors['name_link3'] = "Restore file selection in position 3";
    }
    if (isset($fn4) && $fn4 != '') {
      $errors['name_link4'] = "Restore file selection in position 4";
    }

  } else if ($row['dedicated_om'] == "1" && $row['meet_addr'] != '') {
    $errors['url_and_phy'] = "If it's a Dedicated Online meeting you don't need a physical address.";
  }



  // begin file errors for update/edit pages

  if ((isset($fn1) && ($fn1 != '')) && is_blank($row['link1'])) {
    $errors['name_link1'] = "You did not name your link in position 1. Please restore file selection.";
  }
  if (((isset($fn1) && $fn1 != '') && ($nf1 == ''))) {
    $errors['name_link1'] = "File upload in Position 1 needs attention. Please restore file selection.";
  }
  if ((!isset($fn1) || ($fn1 == '') && $row['hid_f1'] == '') && (trim($row['link1']) != '')) {
    $errors['name_link1'] = "You set a name but no file in position 1. Please restore file selection.";
  }


  if ((isset($fn2) && ($fn2 != '')) && is_blank($row['link2'])) {
    $errors['name_link2'] = "You did not name your link in position 2. Please restore file selection.";
  }
  if (((isset($fn2) && $fn2 != '') && ($nf2 == ''))) {
    $errors['name_link2'] = "File upload in Position 2 needs attention. Please restore file selection.";
  }
  if ((!isset($fn2) || ($fn2 == '') && $row['hid_f2'] == '') && (trim($row['link2']) != '')) {
    $errors['name_link2'] = "You set a name but no file in position 2. Please restore file selection.";
  }


  if ((isset($fn3) && ($fn3 != '')) && is_blank($row['link3'])) {
    $errors['name_link3'] = "You did not name your link in position 3. Please restore file selection.";
  }
  if (((isset($fn3) && $fn3 != '') && ($nf3 == ''))) {
    $errors['name_link3'] = "File upload in Position 3 needs attention. Please restore file selection.";
  }
  if ((!isset($fn3) || ($fn3 == '') && $row['hid_f3'] == '') && (trim($row['link3']) != '')) {
    $errors['name_link3'] = "You set a name but no file in position 3. Please restore file selection.";
  }


  if ((isset($fn4) && ($fn4 != '')) && is_blank($row['link4'])) {
    $errors['name_link4'] = "You did not name your link in position 4. Please restore file selection.";
  }
  if (((isset($fn4) && $fn4 != '') && ($nf4 == ''))) {
    $errors['name_link4'] = "File upload in Position 4 needs attention. Please restore file selection.";
  }
  if ((!isset($fn4) || ($fn4 == '') && $row['hid_f4'] == '') && (trim($row['link4']) != '')) {
    $errors['name_link4'] = "You set a name but no file in position 4. Please restore file selection.";
  }

  // end file errors for update/edit pages


  if ((!is_blank($row['add_note']) && has_length_greater_than($row['add_note'], 1000)) && ((isset($fn1) && $fn1 != '') || (isset($fn2) && $fn2 != '') || (isset($fn3) && $fn3 != '') || (isset($fn4) && $fn4 != ''))) {
    if (isset($fn1) && $fn1 != '') {
      $errors['name_link1'] = "Restore file selection in position 1.";
    }
    if (isset($fn2) && $fn2 != '') {
      $errors['name_link2'] = "Restore file selection in position 2";
    }
    if (isset($fn3) && $fn3 != '') {
      $errors['name_link3'] = "Restore file selection in position 3";
    }
    if (isset($fn4) && $fn4 != '') {
      $errors['name_link4'] = "Restore file selection in position 4";
    }  
    $errors['add_note'] = "You've got more than 1,000 characters in your note.";
    
  } else if (!is_blank($row['add_note']) && has_length_greater_than($row['add_note'], 1000)) {
    $errors['add_note'] = "You've got more than 1,000 characters in your note.";
  } 

  return $errors; 
}

function validate_url($url) {
    $path = parse_url($url, PHP_URL_PATH);
    $encoded_path = array_map('urlencode', explode('/', $path));
    $url = str_replace($path, implode('/', $encoded_path), $url);

    return filter_var($url, FILTER_VALIDATE_URL) ? true : false;
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

