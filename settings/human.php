<?php
  $types = array('political' => 'red',
                 'ideological' => 'blue'); //must be less than 15 chars
  function is_valid_date($string) {
    $s = sscanf($string, "%d");
    return $string == sprintf("%d", $s[0]);
  }
  function is_valid_place($string) {
    $s = sscanf($string, "(%d, %d)");
    return $string == sprintf("(%d, %d)", $s[0], $s[1]);
  }
  function is_valid_type($string) {
    return array_key_exists($string, $types);
  }
  function get_effect_color($effect) {
    return $types[$effect['type']];
  }
  function get_event_color($event) {
    return 'red';
  }
  function get_space_coord($event) {
    return sscanf($event['location'], "(%d, %d)")[1];
  }
  function get_time_coord($event) {
    return sscanf($event['date'], "%d")[0];
  }
?>
