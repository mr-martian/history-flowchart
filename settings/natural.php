<?php
  $svg = 'height="50" width="4500" viewPort="0 0 4500 50"';
  $places = array('universe' => 5,
                  'milky way' => 10);
  $types = array('evolution' => 'blue'); //must be less than 15 chars
  function is_valid_date($string) {
    return preg_match("/^\d+$/", $string) == 1;
  }
  function is_valid_place($string) {
    array_key_exists($string, $places);
  }
  function is_valid_type($string) {
    array_key_exists($string, $types);
  }
  function get_effect_color($effect) {
    return $types[$effect['type']];
  }
  function get_event_color($event) {
    return 'red';
  }
  function get_space_coord($event) {
    global $places;
    return $places[$event['location']];
  }
  function get_time_coord($event) {
    return sscanf($event['date'], "%d");
  }
?>
