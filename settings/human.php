<?php
  function is_valid_date($string) { //NOT SURE IF THIS WILL DO...
    $a = date_parse_from_format("m/j/Y", $string);
    return checkdate($a['month'], $a['day'], $a['year']);
  }
  function is_valid_place($string) {
    4; //FINISH
  }
  function get_effect_color($effect) {
    return 'green';
  }
  function get_event_color($event) {
    return 'red';
  }
  function get_space_coord($event) {
    $s = explode(' ', str_replace(')', ' ', $event['Location']))[1];
    return parse_str($s);
  }
  function get_time_coord($event) {
    return 5; //FINISH
  }
?>
