<?php
  $svg = 'height="360" width="7100" viewPort="-5000 -180 7100 360"';
  $types = array('political' => 'red',
                 'ideological' => 'blue'); //must be less than 15 chars
  function is_valid_date($string) {
    return preg_match("/^-?\d+(\.\d+)?$/", $string) == 1;
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
    return sscanf($event['Location'], "(%f, %f)")[1];
  }
  function get_time_coord($event) {
    return sscanf($event['Date'], "%f")[0];
  }
?>
