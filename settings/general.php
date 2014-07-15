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
  function effect_summary($id) {
    $con = connect();
    $ef = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM Effects WHERE PID = " . $id));
    $f = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM Events WHERE Name = '" . $ef['Cause']));
    $t = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM Events WHERE Name = '" . $ef['Effect']));
    echo "<table><tr><th></th><th>Cause</th><th>Effect</th></tr>";
    echo "<tr><th>Event</th><td>", $f['Name'], "</td><td>", $t['Name'], "</td></tr>";
    echo "<tr><th>Date</th><td>", $f['Date'], "</td><td>", $t['Date'], "</td></tr>";
    echo "<tr><th>Location</th><td>", $f['Location'], "</td><td>", $t['Location'], "</td></tr>";
    echo "<tr><th>Universe</th><td colspan=\"2\">", $ef['Universe'], "</td></tr>";
    echo "<tr><th>Type</th></td colspan=\"2\">", $ef['Type'], "</td></tr></table>";
  }
  function event_summary($id) {
    $con = connect();
    $ev = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM Events WHERE PID = " . $id));
    echo "<table><tr><th>Name</th><td>", $ev['Name'], "</td></tr>";
    echo "<tr><th>Date</th><td>", $ev['Date'], "</td></tr>";
    echo "<tr><th>Location</th><td>", $ev['Location'], "</td></tr>";
    echo "<tr><th>Universe</th><td>", $ev['Universe'], "</td></tr></table>";
  }
?>
