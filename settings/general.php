<?php
  $UNIVERSES = array(
    "Human" => "Recorded human history",
    "Natural" => "History of the universe prior to the advent of human civilization"
  );
  function get_universe($name) {
    if (array_key_exists($name, $UNIVERSES)) {
      include "settings/".$name.".php";
    }
  }
  function is_valid_name($name) {
    return ctype_alnum(str_replace(' ', '', $name)) and strlen($name) < 30;
  }
  function connect($usedb = true) {
    if ($usedb) {
      $con=mysqli_connect("localhost", "root", "", "flowchart_data"); //change password, username later
    }
    else {
      $con=mysqli_connect("localhost", "root", "");
    }
    // Check connection
    if (mysqli_connect_errno()) {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    else {
      return $con;
    }
  }
?>
