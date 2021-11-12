<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
<?php 
function converted_time($time, $tz) {
  $utc = 'UTC';
  $from_tz_obj = new DateTimeZone($utc);
  $to_tz_obj = new DateTimeZone($tz);

  $ct = new DateTime($time, $from_tz_obj);
  $ct->setTimezone($to_tz_obj);
  $nct = $ct->format('g:i A');

  return $nct;
}

$nct = converted_time('0100', 'America/Denver');
echo $nct . '<br />'; // checks out

// ------------------------------------

function apply_offset_to_edit($time) {
  // $utc = 'UTC';
  $from_tz_obj = new DateTimeZone('UTC');
  $to_tz_obj = new DateTimeZone($time['tz']);

  // $ct = new DateTime($time['ut'], $from_tz_obj);
  // $ct->setTimezone($to_tz_obj);


    $csun = new DateTime('Sunday ' . $time['ut'], $from_tz_obj);
    $csun->setTimezone($to_tz_obj);
    $nsun = $csun->format('l Hi');

return $nsun;

}


$time = [];
$time['tz'] = 'America/Denver';
$time['ut'] = '0100';

$nsun = apply_offset_to_edit($time);
echo $nsun . '<br />'; // checks out

?>

</body>
</html>