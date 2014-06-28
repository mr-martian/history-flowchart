<?php
  $UNIVERSES = array( //array(name, description, levels) levels = array(level_1_description, level_2_description, ...)
    array("Human", "Recorded human history", array("level 1", "level 2", "level 3", "level 4", "level 5")),
    array("Natural", "History of the universe prior to the advent of human civilization", array("level 1", "level 2"))
  );
  function is_valid_name($name) {
    return ctype_alnum(str_replace(' ', '', $name)) and strlen($name) < 30;
  }
  function connect() {
    $con=mysqli_connect("localhost", "root", "", "flowchart_data"); //change password, username later
    // Check connection
    if (mysqli_connect_errno()) {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    else {
      return $con;
    }
  }
?>
