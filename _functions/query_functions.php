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

    $sql = "SELECT m.id_mtg, m.visible, m.sun, m.mon, m.tue, m.wed, m.thu, m.fri, m.sat, m.meet_time, m.group_name, m.address, m.city, m.state, m.zip, m.address_url, m.meet_phone, m.meet_id, m.meet_pswd, m.meet_url, m.meet_addr, m.meet_desc, m.dedicated_om, m.code_b, m.code_d, m.code_o, m.code_w, m.code_beg, m.code_h, m.code_sp, m.code_c, m.code_m, m.code_ss, m.month_speaker, m.potluck, m.link1, m.file1, m.link2, m.file2, m.link3, m.file3, m.link4, m.file4, m.add_note, u.id_user, u.username, u.email, u.admin FROM meetings as m ";
    $sql .= "LEFT JOIN users as u ON u.id_user=m.id_user ";
    $sql .= "WHERE m." . $today . " != 0 ";
    $sql .= "AND m.visible != 0 ";
    $sql .= "AND m.visible != 1 ";
    $sql .= "AND m.visible != 2 ";
    $sql .= "ORDER BY m.meet_time;";
    // echo $sql; 
    $result = mysqli_query($db, $sql); 
    return $result;
}

function get_all_public_and_private_meetings_for_today($today, $id_user) {
    global $db;

    $sql = "SELECT m.id_mtg, m.visible, m.sun, m.mon, m.tue, m.wed, m.thu, m.fri, m.sat, m.meet_time, m.group_name, m.address, m.city, m.state, m.zip, m.address_url, m.meet_phone, m.meet_id, m.meet_pswd, m.meet_url, m.meet_addr, m.meet_desc, m.dedicated_om, m.code_b, m.code_d, m.code_o, m.code_w, m.code_beg, m.code_h, m.code_sp, m.code_c, m.code_m, m.code_ss, m.month_speaker, m.potluck, m.link1, m.file1, m.link2, m.file2, m.link3, m.file3, m.link4, m.file4, m.add_note, u.id_user, u.username, u.email, u.admin FROM meetings as m ";
    $sql .= "LEFT JOIN users as u ON u.id_user=m.id_user ";
    $sql .= "WHERE (m." . $today . " != 0 ";
    $sql .= "AND m.visible != 0 ";
    $sql .= "AND m.visible != 1) ";
    $sql .= "OR ";
    $sql .= "(m." . $today . " != 0 ";
    $sql .= "AND m.visible = 1 ";
    $sql .= "AND u.id_user='" . db_escape($db, $id_user) . "') ";
    $sql .= "ORDER BY m.meet_time;";
    // echo $sql; 
    $result = mysqli_query($db, $sql); 
    return $result;
}

function get_all_public_and_private_meetings_for_admin($today, $user_id) {
    global $db;

    $sql = "SELECT m.id_mtg, m.visible, m.sun, m.mon, m.tue, m.wed, m.thu, m.fri, m.sat, m.meet_time, m.group_name, m.address, m.city, m.state, m.zip, m.address_url, m.meet_phone, m.meet_id, m.meet_pswd, m.meet_url, m.meet_addr, m.meet_desc, m.dedicated_om, m.code_b, m.code_d, m.code_o, m.code_w, m.code_beg, m.code_h, m.code_sp, m.code_c, m.code_m, m.code_ss, m.month_speaker, m.potluck, m.link1, m.file1, m.link2, m.file2, m.link3, m.file3, m.link4, m.file4, m.add_note, u.id_user, u.username, u.email, u.admin FROM meetings as m ";
    $sql .= "LEFT JOIN users as u ON u.id_user=m.id_user ";
    $sql .= "WHERE (m." . $today . " != 0 ";
    $sql .= "AND m.visible != 0 ";
    $sql .= "AND m.visible != 1) ";
    $sql .= "OR ";
    $sql .= "(m." . $today . " != 0 ";
    $sql .= "AND m.visible = 1 ";
    $sql .= "AND u.id_user='" . db_escape($db, $user_id) . "') ";
    $sql .= "ORDER BY m.meet_time;";
    // echo $sql; 
    $result = mysqli_query($db, $sql); 
    return $result;
}

function verify_this_user($id) {
  global $db;

  $sql = "SELECT admin, mode FROM users WHERE ";
  $sql .= "id_user='" . db_escape($db, $id) . "' ";
 
  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  return $result;   
}

function get_all_public_and_private_meetings_for_odin($today) {
    global $db;

    $sql = "SELECT m.id_mtg, m.id_user, m.visible, m.sun, m.mon, m.tue, m.wed, m.thu, m.fri, m.sat, m.meet_time, m.group_name, m.address, m.city, m.state, m.zip, m.address_url, m.meet_phone, m.meet_id, m.meet_pswd, m.meet_url, m.meet_addr, m.meet_desc, m.dedicated_om, m.code_b, m.code_d, m.code_o, m.code_w, m.code_beg, m.code_h, m.code_sp, m.code_c, m.code_m, m.code_ss, m.month_speaker, m.potluck, m.link1, m.file1, m.link2, m.file2, m.link3, m.file3, m.link4, m.file4, m.add_note, u.username, u.email, u.admin FROM meetings as m ";
    $sql .= "LEFT JOIN users as u ON u.id_user=m.id_user ";
    $sql .= "WHERE m." . $today . " != 0 ";
    $sql .= "AND m.visible != 0 ";
    $sql .= "ORDER BY m.meet_time;";
    // echo $sql; 
    $result = mysqli_query($db, $sql); 
    return $result;
}

function suspend_user_info($id) {
    global $db;

    $sql = "SELECT m.id_mtg, m.visible, m.sun, m.mon, m.tue, m.wed, m.thu, m.fri, m.sat, m.meet_time, m.group_name, m.address, m.city, m.state, m.zip, m.address_url, m.meet_phone, m.meet_id, m.meet_pswd, m.meet_url, m.meet_addr, m.meet_desc, m.dedicated_om, m.code_b, m.code_d, m.code_o, m.code_w, m.code_beg, m.code_h, m.code_sp, m.code_c, m.code_m, m.code_ss, m.month_speaker, m.potluck, m.link1, m.file1, m.link2, m.file2, m.link3, m.file3, m.link4, m.file4, m.add_note, u.id_user, u.username, u.email, u.admin, u.sus_notes FROM meetings as m ";
    $sql .= "LEFT JOIN users as u ON u.id_user=m.id_user ";
    $sql .= "WHERE m.id_mtg='" . db_escape($db, $id) . "' ";
    $sql .= "LIMIT 1";
    // echo $sql; 
    $result = mysqli_query($db, $sql); 
    confirm_result_set($result);
    $row = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $row; 
}

function suspended_msg($user_id) {
  global $db;

  $sql = "SELECT * FROM users WHERE ";
  $sql .= "id_user='" . db_escape($db, $user_id) . "' ";
 
  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  return $result;   
}

function suspend_user_total($role, $reason, $user_id) {
  global $db;

  $one = "UPDATE users u ";
  $one .= "JOIN meetings m ON u.id_user=m.id_user ";
  $one .= "SET u.admin='"  . db_escape($db, $role) . "', ";
  $one .= "u.sus_notes='"  . db_escape($db, $reason) . "', ";
  $one .= "u.mode=0, ";
  $one .= "m.visible=0 ";
  $one .= "WHERE u.id_user='"  . db_escape($db, $user_id) . "'";

  $result = mysqli_query($db, $one);
  return $result; 
}

function suspend_user_partial($role, $reason, $user_id) {
  global $db;

  $one = "UPDATE users ";
  // $one .= "JOIN meetings m ON u.id_user=m.id_user ";
  $one .= "SET admin='"  . db_escape($db, $role) . "', ";
  $one .= "mode=0, ";
  $one .= "sus_notes='"  . db_escape($db, $reason) . "' ";
  $one .= "WHERE id_user='"  . db_escape($db, $user_id) . "'";

  $result = mysqli_query($db, $one);
  return $result; 
}

function change_user_role($user_id, $role, $mode) {
  global $db;

  $one = "UPDATE users ";
  // $one .= "JOIN meetings m ON u.id_user=m.id_user ";
  $one .= "SET admin='"  . db_escape($db, $role) . "', ";
  $one .= "mode='"  . db_escape($db, $mode) . "', ";
  $one .= "sus_notes='' ";
  $one .= "WHERE id_user='"  . db_escape($db, $user_id) . "'";

  $result = mysqli_query($db, $one);
  return $result; 
}

function update_admin_mode($id, $mode) {
  global $db;

  $one = "UPDATE users ";
  $one .= "SET mode='"  . db_escape($db, $mode) . "' ";
  $one .= "WHERE id_user='"  . db_escape($db, $id) . "'";

  $result = mysqli_query($db, $one);
  return $result; 
}

function update_sus_note($reason, $user) {
  global $db;

  $sql = "UPDATE users ";
  $sql .= "SET sus_notes='"  . db_escape($db, $reason) . "' ";
  $sql .= "WHERE id_user='"  . db_escape($db, $user) . "'";

  $result = mysqli_query($db, $sql);
  return $result; 
}

function get_user_by_id($id) {
    global $db;

    $sql = "SELECT * FROM users ";
    $sql .= "WHERE id_user='"  . db_escape($db, $id) . "' ";
    $sql .= "LIMIT 1";
    // echo $sql; 
    $result = mysqli_query($db, $sql); 
    confirm_result_set($result);
    $row = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $row; 
}

function create_new_meeting($row, $nf1, $fn1, $nf2, $fn2, $nf3, $fn3, $nf4, $fn4) {
  global $db;

    $errors = validate_meeting($row, $nf1, $fn1, $nf2, $fn2, $nf3, $fn3, $nf4, $fn4);
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

  $errors = validate_meeting($row, $nf1, $fn1, $nf2, $fn2, $nf3, $fn3, $nf4, $fn4);
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
  $sql .= "LIMIT 1";

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

function transfer_meeting($id) {
  global $db;

  $sql = "SELECT m.id_mtg, m.sun, m.mon, m.tue, m.wed, m.thu, m.fri, m.sat, m.meet_time, m.group_name, u.id_user, u.username, u.email FROM meetings as m ";
  $sql .= "LEFT JOIN users as u ON u.id_user=m.id_user ";
  $sql .= "WHERE m.id_mtg='" . db_escape($db, $id) . "' ";
  $sql .= "LIMIT 1";
  // echo $sql;
  $result = mysqli_query($db, $sql);
  $row = mysqli_fetch_assoc($result);
  mysqli_free_result($result);
  return $row;   
}

function find_all_users() {
  global $db;

  $sql  = "SELECT * FROM users ";
  $sql .= "WHERE id_user != 1 ";  
  $sql .= "AND id_user != 13 ";
  $sql .= "ORDER BY LOWER(username) ASC";
  // echo $sql;
  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  return $result;
}

// for dropdown list on user_management.php
// and mailing lists: email_everyone_BCC.php
function find_all_users_to_manage($user_id) {
  global $db;

  $sql  = "SELECT joined, id_user, username, email  FROM users ";
  $sql .= "WHERE id_user != 1 ";
  $sql .= "AND id_user != 13 ";
  $sql .= "AND id_user != '" . $user_id . "' ";
  $sql .= "ORDER BY LOWER(username) ASC";
  // echo $sql;
  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  return $result;
}


// transfer host
function find_new_host($email) {
  global $db;

  $sql  = "SELECT * FROM users ";
  $sql .= "WHERE LOWER(email) LIKE LOWER('" . db_escape($db, $email) . "') ";
  $sql .= "LIMIT 1";
  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  return $result;
}
function update_host($mtgid, $new_host) {
  global $db;

  $sql = "UPDATE meetings SET id_user = '" . $new_host . "' ";
  $sql .= "WHERE id_mtg = '" . $mtgid . "' ";
  $sql .= "LIMIT 1";

  $result = mysqli_query($db, $sql);
  return $result;
}

function get_host_address($mtgid) {
  global $db;

  $sql  = "SELECT u.username, u.email ";
  $sql .= "FROM meetings as m ";
  $sql .= "LEFT JOIN users as u ON u.id_user=m.id_user ";
  $sql .= "WHERE m.id_mtg='" . db_escape($db, $mtgid) . "' ";
  $sql .= "LIMIT 1";
  // echo $sql;
  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  return $result;
}



























function get_mb_posts() {
  global $db;

  $sql = "SELECT mb.opened, mb.idt_topic, mb.idt_user, mb.mb_header, mb.mb_body, u.username, u.email, u.mode, u.admin FROM mb_topics as mb ";
  $sql .= "LEFT JOIN users as u ON u.id_user=mb.idt_user ";
  $sql .= "ORDER by opened DESC";

  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  return $result;
}
function add_new_post($row) {
  global $db;

  $sql = "INSERT INTO mb_topics ";
  $sql .= "(idt_user, mb_header, mb_body) VALUES ";
  $sql .= "('" . $row['id_user'] . "', ";
  $sql .= "'" . db_escape($db, $row['mb_header']) . "', ";
  $sql .= "'" . db_escape($db, $row['mb_body']) . "')";

  $result = mysqli_query($db, $sql);
  if ($result) {
    return true;
  } else {
    echo mysqli_error($db);
    db_disconnect($db);
    exit;
  }
}

function delete_post($row) { // This is the TOPIC
  global $db;

  $sql = "DELETE FROM mb_topics ";
  $sql .= "WHERE idt_topic='" . db_escape($db, $row['id_topic']) . "' ";
  $sql .= "AND idt_user='" . db_escape($db, $row['id_user']) . "' ";
  $sql .= "LIMIT 1";

  $result = mysqli_query($db, $sql);

  if($result) {
    return true;
  } else {
    echo mysqli_error($db);
    db_disconnect($db);
    exit;
  }
}

function delete_reply($row) { // this is a REPLY POST
  global $db;

  $sql = "DELETE FROM mb_replies ";
  $sql .= "WHERE id_reply='" . db_escape($db, $row['id_reply']) . "' ";
  $sql .= "AND idr_user='" . db_escape($db, $row['id_user']) . "' ";
  $sql .= "LIMIT 1";

  $result = mysqli_query($db, $sql);

  if($result) {
    return true;
  } else {
    echo mysqli_error($db);
    db_disconnect($db);
    exit;
  }
}

function add_mb_reply($row) {
  global $db;

  $sql = "INSERT INTO mb_replies ";
  $sql .= "(idr_topic, idr_user, reply) VALUES ";
  $sql .= "('" . $row['mb_topic'] . "', ";
  $sql .= "'" . $row['id_user'] . "', ";
  $sql .= "'" . db_escape($db, $row['mb_reply']) . "')";

  $result = mysqli_query($db, $sql);
  if ($result) {
    return true;
  } else {
    echo mysqli_error($db);
    db_disconnect($db);
    exit;
  }
}
function get_this_post($post) {
  global $db;

  $sql = "SELECT mb.opened, mb.idt_topic, mb.idt_user, mb.mb_header, mb.mb_body, u.username, u.email, u.mode, u.admin FROM mb_topics as mb ";
  $sql .= "LEFT JOIN users as u ON u.id_user=mb.idt_user ";
  $sql .= "WHERE idt_topic='" . $post . "' ";
  $sql .= "LIMIT 1";

  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  return $result;
}
function get_mb_replies($post) {
  global $db;

  $sql = "SELECT mbr.replied, mbr.id_reply, mbr.idr_topic, mbr.idr_user, mbr.reply, u.username, u.email, u.mode, u.admin FROM mb_replies as mbr ";
  $sql .= "LEFT JOIN users as u ON u.id_user=mbr.idr_user ";
  $sql .= "WHERE idr_topic='" . $post . "' ";
  $sql .= "ORDER BY mbr.replied ASC";

  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  return $result;
}



























function find_all_meetings() {
  global $db;

  $sql =  "SELECT * FROM meetings ";
  $sql .= "ORDER BY id ASC";
  // echo $sql;
  $result = mysqli_query($db, $sql);
  confirm_result_set($result);
  return $result;
}

function find_meetings_by_id($id) {
  global $db;

  $sql = "SELECT * FROM meetings WHERE ";
  $sql .= "id_user='" . db_escape($db, $id) . "' ";
  // echo $sql;
  $result = mysqli_query($db, $sql);
  confirm_result_set($result);  
  return $result; // returns an assoc. array  
}

function find_meetings_for_manage_page($id) {
  global $db;

  $sql = "SELECT m.id_mtg, m.id_user, m.visible, m.sun, m.mon, m.tue, m.wed, m.thu, m.fri, m.sat, m.meet_time, m.group_name, m.address, m.city, m.state, m.zip, m.address_url, m.meet_phone, m.meet_id, m.meet_pswd, m.meet_url, m.meet_addr, m.meet_desc, m.dedicated_om, m.code_b, m.code_d, m.code_o, m.code_w, m.code_beg, m.code_h, m.code_sp, m.code_c, m.code_m, m.code_ss, m.month_speaker, m.potluck, m.link1, m.file1, m.link2, m.file2, m.link3, m.file3, m.link4, m.file4, m.add_note, u.username, u.email, u.admin FROM meetings as m ";
  $sql .= "LEFT JOIN users as u ON u.id_user=m.id_user ";
  $sql .= "WHERE m.id_user='" . db_escape($db, $id) . "' ";
  $sql .= "GROUP BY m.group_name ";
  $sql .= "ORDER BY m.meet_time;";
  // echo $sql;
  $result = mysqli_query($db, $sql);
  confirm_result_set($result);  
  return $result; // returns an assoc. array  
}

// just for Suspended Users list on user_management.php
function user_manage_page_glance() {
  global $db;

  $sql = "SELECT * FROM users ";
  $sql .= "WHERE admin=85 OR admin=86 ";
  $sql .= "GROUP BY username ";
  $sql .= "ORDER BY LOWER(username) ASC;";

  $result = mysqli_query($db, $sql);
  confirm_result_set($result);  
  return $result;  
}

// just for Current Administrators on user_management.php
function find_users_for_admin_glance() {
  global $db;

  $sql = "SELECT * FROM users ";
  $sql .= "WHERE admin=2 OR admin=3 ";
  $sql .= "GROUP BY username ";
  $sql .= "ORDER BY LOWER(username) ASC;";

  $result = mysqli_query($db, $sql);
  confirm_result_set($result);  
  return $result;
}

function user_manage_page_details($userz_id) {
  global $db;

  $sql = "SELECT m.id_mtg, m.id_user, m.visible, m.sun, m.mon, m.tue, m.wed, m.thu, m.fri, m.sat, m.meet_time, m.group_name, m.address, m.city, m.state, m.zip, m.address_url, m.meet_phone, m.meet_id, m.meet_pswd, m.meet_url, m.meet_addr, m.meet_desc, m.dedicated_om, m.code_b, m.code_d, m.code_o, m.code_w, m.code_beg, m.code_h, m.code_sp, m.code_c, m.code_m, m.code_ss, m.month_speaker, m.potluck, m.link1, m.file1, m.link2, m.file2, m.link3, m.file3, m.link4, m.file4, m.add_note, u.username, u.email, u.admin FROM meetings as m ";
  $sql .= "LEFT JOIN users as u ON u.id_user=m.id_user ";
  $sql .= "WHERE m.id_user='" . db_escape($db, $userz_id) . "' ";
  $sql .= "AND (m.visible=2 OR m.visible=3) ";
  // $sql .= "GROUP BY u.username ";
  $sql .= "ORDER BY m.meet_time;";
  // echo $sql;
  $result = mysqli_query($db, $sql);
  confirm_result_set($result);  
  return $result; // returns an assoc. array  
}

function find_meetings_by_id_today($id, $today) {
  global $db;

  $sql = "SELECT * FROM meetings WHERE ";
  $sql .= "id_user='" . db_escape($db, $id) . "' AND " . $today . " !=0 ";
  $sql .= "ORDER BY meet_time;";
  // echo $sql;
  $result = mysqli_query($db, $sql);
  confirm_result_set($result);  
  return $result; // returns an assoc. array  
}

function validate_meeting($row, $nf1, $fn1, $nf2, $fn2, $nf3, $fn3, $nf4, $fn4) {
  $errors = [];

  if (is_blank($row['group_name'])) {
    $errors['group_name'] = "Name your Meeting! Under 50 characters, please.";
  } else if (!has_length($row['group_name'], ['min' => 1, 'max' => 50])) {
    $errors['group_name'] = "Meeting Name needs to be less than 50 characters.";
  }

  if (( $row['sun'] == "0" && 
        $row['mon'] == "0" && 
        $row['tue'] == "0" && 
        $row['wed'] == "0" && 
        $row['thu'] == "0" && 
        $row['fri'] == "0" && 
        $row['sat'] == "0"  )) {
    $errors['pick_a_day'] = "Pick a day or days for your meeting.";
  }

   if (is_blank($row['meet_time'])) {
    $errors['meet_time'] = "Please set a time.";
  }

  if (!is_blank($row['meet_phone']) && has_length_less_than($row['meet_phone'], 10)) {
    $errors['meet_phone'] = "Only 10-digit phone numbers.";
  }

  if (!is_blank($row['meet_phone']) && has_length_greater_than($row['meet_phone'], 10)) {
    $errors['meet_phone'] = "You've got too many numbers in your phone number.";
  }

  if (!is_blank($row['meet_id']) && has_length_greater_than($row['meet_id'], 15)) {
    $errors['meet_id'] = "Meeting ID's aren't that long! C'mon man.";
  }

  if (!is_blank($row['meet_pswd']) && has_length_greater_than($row['meet_pswd'], 25)) {
    $errors['meet_pswd'] = "That password is way too long.";
  } 

  if (is_blank($row['meet_url']) && is_blank($row['meet_addr']) && is_blank($row['meet_desc'])) {
    $errors['meet_url'] = "You need either an Online URL or Physical Address to host a meeting.";
  }

  if (!is_blank($row['meet_addr']) && has_length_greater_than($row['meet_addr'], 255)) {
    $errors['meet_addr'] = "255 Character limit on physical address";
  }

  if (!is_blank($row['meet_desc']) && has_length_greater_than($row['meet_desc'], 255)) {
    $errors['meet_addr'] = "255 Character limit on descriptive location";
  }

  if (is_blank($row['meet_addr']) && (!is_blank($row['meet_desc'])) ) {
    $errors['meet_addr'] = "You need location information for your map.";
  }

  if (( $row['dedicated_om']    == "0"   && 
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

  if ($row['dedicated_om'] == "1" && $row['meet_url'] == '') {
    $errors['url_or_phy'] = "If it's a Dedicated Online meeting you need a URL.";
  }

  if ($row['dedicated_om'] == "1" && $row['meet_addr'] != '') {
    $errors['url_and_phy'] = "If it's a Dedicated Online meeting you don't need a physical address.";
  }

  // begin file errors for update/edit pages
  // BEGIN POSITION 1 - Notes for all positions' validation explanations contained within position 1
  // ...it's good & complicated so there are a lot of notes.
  // 1st - check for stand-along issue (this is the only error on page). Each 1 of the 4 potential errors for files can either exist by itself or in conjunction with other errors on the page. If any other error on the page exists then you need to check for it here. 

  // because file selections do not persist across a page refresh it needs to catch when you haven't made an error in the file area but an error exists somewhere else on the page. the whole point here is to keep error messages in order.
  if ((isset($fn1) && ($fn1 != '')) && is_blank($row['link1'])) {
    $errors['name_link1'] = "You did not name your link in position 1. Please restore file selection.";
  }
  if ((isset($fn1) && $fn1 != '') && $nf1 == '') {
    $errors['name_link1'] = "File upload in Position 1 needs attention. Please restore file selection.";
  }
  /* difference between new and update right here... this one's for 'new' -> if new file is not set but there's a name/label present, let them know. In the update version they are allowed to change the name because it sees that a hidden field with the file name is present. */
  if (((!isset($fn1) || $fn1 == '') && (trim($row['link1']) != '')) && $row['hid_f1'] == '') {
    $errors['name_link1'] = "There's a name but no file to upload in position 1. Please restore file selection.";
  }  
  /* this one's for 'update' -> this allows you to rename a label. it says, even though you are not uploading a file, I see that you already have one here so go ahead and rename it. (If they hit "Remove" it deletes the hidden value (via .js) from the DB + if they delete the label, it deletes the hidden value (on submit - see #3 if condition after (is_post_request()) in manage_edit.php) from the DB. I kind of covered the bases on this one.) */
  if ((!isset($fn1) || ($fn1 == '') && $row['hid_f1'] == '') && (trim($row['link1']) != '')) {
    $errors['name_link1'] = "You set a name but no file in position 1. Please restore file selection.";
  }
  /* finally, to catch the possibility that there were no errors with the file/label area but there was another error on the page when you have hoped to upload a file, you now need to address the broken file selection. the notes (at the very bottom of the error checking stack, gets its own special if() function to manage this.) */
  if (!empty($errors) && (isset($fn1) && $fn1 != '')) {
    $errors['name_link1'] = "Restore file selection in position 1.";
  }
  // END POSITION 1


  if ((isset($fn2) && ($fn2 != '')) && is_blank($row['link2'])) {
    $errors['name_link2'] = "You did not name your link in position 2. Please restore file selection.";
  }
  if ((isset($fn2) && $fn2 != '') && $nf2 == '') {
    $errors['name_link2'] = "File upload in Position 2 needs attention. Please restore file selection.";
  }
  // for 'new'
  if (((!isset($fn2) || ($fn2 == '')) && (trim($row['link2']) != '')) && $row['hid_f2'] == '') {
    $errors['name_link2'] = "There's a name but no file to upload in position 2. Please restore file selection.";
  }
  // for 'update'
  if ((!isset($fn2) || ($fn2 == '') && $row['hid_f2'] == '') && (trim($row['link2']) != '')) {
    $errors['name_link2'] = "You set a name but no file in position 2. Please restore file selection.";
  }
  if (!empty($errors) && (isset($fn2) && $fn2 != '')) {
    $errors['name_link2'] = "Restore file selection in position 2.";
  }  


  if ((isset($fn3) && ($fn3 != '')) && is_blank($row['link3'])) {
    $errors['name_link3'] = "You did not name your link in position 3. Please restore file selection.";
  }
  if ((isset($fn3) && $fn3 != '') && $nf3 == '') {
    $errors['name_link3'] = "File upload in Position 3 needs attention. Please restore file selection.";
  }
  // for 'new'
  if (((!isset($fn3) || ($fn3 == '')) && (trim($row['link3']) != '')) && $row['hid_f3'] == '') {
    $errors['name_link3'] = "There's a name but no file to upload in position 3. Please restore file selection.";
  }
  // for 'update'
  if ((!isset($fn3) || ($fn3 == '') && $row['hid_f3'] == '') && (trim($row['link3']) != '')) {
    $errors['name_link3'] = "You set a name but no file in position 3. Please restore file selection.";
  }
  if (!empty($errors) && (isset($fn3) && $fn3 != '')) {
    $errors['name_link3'] = "Restore file selection in position 3.";
  }  


  if ((isset($fn4) && ($fn4 != '')) && is_blank($row['link4'])) {
    $errors['name_link4'] = "You did not name your link in position 4. Please restore file selection.";
  }
  if ((isset($fn4) && $fn4 != '') && $nf4 == '') {
    $errors['name_link4'] = "File upload in Position 4 needs attention. Please restore file selection.";
  }
  // for 'new'
  if (((!isset($fn4) || ($fn4 == '')) && (trim($row['link4']) != '')) && $row['hid_f4'] == '') {
    $errors['name_link4'] = "There's a name but no file to upload in position 4. Please restore file selection.";
  }
  // for 'update'
  if ((!isset($fn4) || ($fn4 == '') && $row['hid_f4'] == '') && (trim($row['link4']) != '')) {
    $errors['name_link4'] = "You set a name but no file in position 4. Please restore file selection.";
  }
  if (!empty($errors) && (isset($fn4) && $fn4 != '')) {
    $errors['name_link4'] = "Restore file selection in position 4.";
  }  

  // end file errors for update/edit pages

  /* notes gets it's own special version of error checking since it's last. in case this is the ony error on the page and they had everything correct in the file upload area,  you still want to show the file error first since combing down the page the files come before the notes. */
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
    $errors['add_note'] = "You've got more than 1,000 characters in your note. Dial it down to 1,000 or less please.";
    
  } else if (!is_blank($row['add_note']) && has_length_greater_than($row['add_note'], 1000)) {
    $errors['add_note'] = "You've got more than 1,000 characters in your note. Dial it down to 1,000 or less please.";
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

