<?php
  $places = array('universe' => 5,
                  'milky way' => 10);
  function is_valid_date($string) {
    $n = sscanf($string, "%d");
    return $string == sprintf("%d", $n);
  }
  function is_valid_place($string) {
    array_key_exists($string, $places);
  }
  function get_effect_color($effect) {
    return 'green';
  }
  function get_event_color($event) {
    return 'red';
  }
  function get_space_coord($event) {
    return $places[$event['location']];
  }
  function get_time_coord($event) {
    return sscanf($event['date'], "%d");
  }
?>
