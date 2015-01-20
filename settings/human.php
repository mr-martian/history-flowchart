<?php
  $svg = 'height="360" width="7100"';// viewPort="-5000 -180 7100 360"';
  $types = array('political' => 'red',
                 'ideological' => 'blue'); //must be less than 15 chars
  function is_valid_date($string) {
    //return preg_match("/^-?\d+(\.\d+)?$/", $string) == 1;
    return preg_match("/^\d{1,2}//\d{1,2}//d{1,5}$/", $string) == 1;
  }
  function is_valid_place($string) {
    return preg_match("/^\(-?\d+(\.\d+)?, -?\d+(\.\d+)?\)$/", $string) == 1;
  }
  function is_valid_type($string) {
    global $types;
    return array_key_exists($string, $types);
  }
  function get_effect_color($effect) {
    global $types;
    return $types[$effect['Type']];
  }
  function get_event_color($event) {
    return 'red';
  }
  function get_space_coord($event) {
    return sscanf($event['Location'], "(%f, %f)")[1] + 180;
  }
  function get_time_coord($event) {
    //return sscanf($event['Date'], "%f")[0] + 5000;
    sscanf($event['Date'], "%i/%i/%i", $m, $d, $y);
    $months = array(0, 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 31);
    if ($y % 4 == 0 and ($y % 100 != 0 or $y % 400)) {
      $months[2] += 1;
    }
    for ($i = 1; $i < 12; $i++) {
      $months[$i] += $months[$i-1];
    }
    $yp = $months[$m-1] + $d - 1;
    if ($y < 0) {
      $y++;
    }
    return $y + ($yp/$months[12]);
  }
?>
