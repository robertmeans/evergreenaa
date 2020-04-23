<?php

function get_meetings_for_today($today) {
    global $db;

    $sql = "SELECT * FROM meetings WHERE ";
    $sql .= "" . $today . " != 0 ORDER BY meet_time;";
    // echo $sql; 
    $result = mysqli_query($db, $sql); 
    return $result;

}


function edit_meeting($id) {
    global $db;

    $sql = "SELECT * FROM meetings WHERE ";
    $sql .= "id_mtg='" . $_GET['id'] . "' ORDER BY meet_time;";
    // echo $sql; 
    $result = mysqli_query($db, $sql); 
    return $result;

}

function find_all_users() {
	global $db;

	$sql 			= 	"SELECT * FROM users ";
	$sql 			.= 	"ORDER BY id ASC";
	// echo $sql;
	$result 		= 	mysqli_query($db, $sql);
	confirm_result_set($result);
	return $result;
}

function find_all_meetings() {
	global $db;

	$sql 			= 	"SELECT * FROM meetings ";
	$sql 			.= 	"ORDER BY id ASC";
	// echo $sql;
	$result 		= 	mysqli_query($db, $sql);
	confirm_result_set($result);
	return $result;
}

function find_meeting_by_id($id) {
	global $db;

	$sql = "SELECT * FROM meetings ";
	$sql .= "WHERE id_user='" . $id . "'";
	$result = mysqli_query($db, $sql);
	confirm_result_set($result);
	$meeting = mysqli_fetch_assoc($result);
	mysqli_free_result($result);	
	return $meeting; // returns an assoc. array	
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

