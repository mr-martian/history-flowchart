<?php
  $UNIVERSES = array(
    "Human" => "Recorded human history",
    "Natural" => "History of the universe prior to the advent of human civilization"
  );
  function get_universe_path($name, $root=false) {
    if ($root) {
      return "settings/".$name.".php";
    }
    else {
      return "../settings/".$name.".php";
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
  function get_event($name=null, $universe=null, $id=null, $date=null, $location=null, $array=false) {
    $con = connect();
    $str = ' WHERE';
    if ($name) {
      if (is_valid_name($name)) {
        $str .= " Name = '" . $name . "'";
      }
      else {
        return null;
      }
    }
    if ($universe) {
      if (array_key_exists($universe, $UNIVERSES)) {
        $str .= " Universe = '" . $universe . "'";
      }
      else {
        return null;
      }
    }
    if ($id) {
      $str .= ' PID = ' . strval(intval($id));
    }
    if ($date) {
      $str .= " Date = '" . mysqli_real_escape_string($con, $date) . "'";
    }
    if ($location) {
      $str .= " Location = '" . mysqli_real_escape_string($con, $location) . "'";
    }
    $ret = mysqli_query($con, "SELECT * FROM Events" . ($str != ' WHERE' ? $str : ''));
    mysqli_close($con);
    return ($array ? mysqli_fetch_array($ret) : $ret);
  }
  function get_effect($universe=null, $id=null, $cause=null, $effect=null, $type=null, $array=false) {
    $con = connect();
    $str = ' WHERE';
    if ($universe) {
      if (array_key_exists($universe, $UNIVERSES)) {
        $str .= " Universe = '" . $universe . "'";
      }
      else {
        return null;
      }
    }
    if ($id) {
      $str .= ' PID = ' . strval(intval($id));
    }
    if ($cause) {
      $str .= " Cause = " . strval(intval($cause));
    }
    if ($effect) {
      $str .= ' Effect = ' . strval(intval($effect));
    }
    if ($type) {
      $str .= " Location = '" . mysqli_real_escape_string($con, $type) . "'";
    }
    $ret = mysqli_query($con, "SELECT * FROM Effects" . ($str != ' WHERE' ? $str : ''));
    mysqli_close($con);
    return ($array ? mysqli_fetch_array($ret) : $ret);
  }
  function effect_summary($id) {
    $ef = get_effect($id=$id, $array=true);
    $f = get_event($name=$ef['Cause'], $array=true);
    $t = get_event($name=$ef['Effect'], $array=true);
    echo "<table><tr><th></th><th>Cause</th><th>Effect</th></tr>";
    echo "<tr><th>Event</th><td>", $f['Name'], "</td><td>", $t['Name'], "</td></tr>";
    echo "<tr><th>Date</th><td>", $f['Date'], "</td><td>", $t['Date'], "</td></tr>";
    echo "<tr><th>Location</th><td>", $f['Location'], "</td><td>", $t['Location'], "</td></tr>";
    echo "<tr><th>Universe</th><td colspan=\"2\">", $ef['Universe'], "</td></tr>";
    echo "<tr><th>Type</th></td colspan=\"2\">", $ef['Type'], "</td></tr></table>";
  }
  function event_summary($id) {
    $ev = get_event($id=$id, $array=true);
    echo "<table><tr><th>Name</th><td>", $ev['Name'], "</td></tr>";
    echo "<tr><th>Date</th><td>", $ev['Date'], "</td></tr>";
    echo "<tr><th>Location</th><td>", $ev['Location'], "</td></tr>";
    echo "<tr><th>Universe</th><td>", $ev['Universe'], "</td></tr></table>";
  }
?>
