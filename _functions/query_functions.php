<?php

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