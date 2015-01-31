<?php
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
  function get_event_array($id) {
    $con = connect();
    return mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM Events WHERE PID = $id"));
  }
  function get_event($name=null, $universe=null, $id=null, $date=null, $location=null, $array=false) {
    $con = connect();
    $str = ' WHERE';
    $added = false;
    if ($name) {
      if (is_valid_name($name)) {
        $str .= " Name = '" . $name . "'";
        $added = true;
      }
    }
    if ($id) {
      $str .= ($added ? ' AND' : '') . ' PID = ' . strval(intval($id));
      $added = true;
    }
    if ($date) {
      $str .= ($added ? ' AND' : '') . " Date = '" . mysqli_real_escape_string($con, $date) . "'";
      $added = true;
    }
    if ($location) {
      $str .= ($added ? ' AND' : '') . " Location = '" . mysqli_real_escape_string($con, $location) . "'";
      $added = true;
    }
    $ret = mysqli_query($con, "SELECT * FROM Events" . ($added ? $str : ''));
    mysqli_close($con);
    if ($array) {
      return mysqli_fetch_assoc($ret);
    }
    else {
      return $ret;
    }
  }
  function get_effect($universe=null, $id=null, $cause=null, $effect=null, $type=null, $array=false) {
    $con = connect();
    $str = ' WHERE';
    $added = false;
    if ($id) {
      $str .= ($added ? ' AND' : '') . ' PID = ' . strval(intval($id));
      $added = true;
    }
    if ($cause) {
      $str .= ($added ? ' AND' : '') . " Cause = " . strval(intval($cause));
      $added = true;
    }
    if ($effect) {
      $str .= ($added ? ' AND' : '') . ' Effect = ' . strval(intval($effect));
      $added = true;
    }
    if ($type) {
      $str .= ($added ? ' AND' : '') . " Location = '" . mysqli_real_escape_string($con, $type) . "'";
      $added = true;
    }
    $ret = mysqli_query($con, "SELECT * FROM Effects" . ($added ? $str : ''));
    mysqli_close($con);
    if ($array) {
      return mysqli_fetch_assoc($ret);
    }
    else {
      return $ret;
    }
  }
  function effect_summary($id) {
    $ef = get_effect($id=$id, $array=true);
    $f = get_event($id=$ef['Cause'], $array=true);
    $t = get_event($id=$ef['Effect'], $array=true);
    echo "<table><tr><th></th><th>Cause</th><th>Effect</th></tr>";
    echo "<tr><th>Event</th><td>", $f['Name'], "</td><td>", $t['Name'], "</td></tr>";
    echo "<tr><th>Date</th><td>", $f['Date'], "</td><td>", $t['Date'], "</td></tr>";
    echo "<tr><th>Location</th><td>", $f['Location'], "</td><td>", $t['Location'], "</td></tr>";
    echo "<tr><th>Type</th></td colspan=\"2\">", $ef['Type'], "</td></tr></table>";
  }
  function event_summary($id) {
    $ev = get_event($id=$id, $array=true);
    echo "<table><tr><th>Name</th><td>", $ev['Name'], "</td></tr>";
    echo "<tr><th>Date</th><td>", $ev['Date'], "</td></tr>";
    echo "<tr><th>Location</th><td>", $ev['Location'], "</td></tr></table>";
  }
  $svg = 'height="360" width="7100"';// viewPort="-5000 -180 7100 360"';
  $types = array('political' => 'red',
                 'ideological' => 'blue'); //must be less than 15 chars
  function is_valid_date($string) {
    //return preg_match("/^-?\d+(\.\d+)?$/", $string) == 1;
    return preg_match("/^\d{1,2}\/\d{1,2}\/\d{1,5}$/", $string) == 1;
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
    $months = array(0, 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 31, 31);
    if ($y % 4 == 0 and ($y % 100 != 0 or $y % 400)) {
      $months[2] += 1;
    }
    for ($i = 1; $i < 12; $i++) {
      $months[$i] += $months[$i-1];
    }
    $yp = $months[$m - 1] + $d - 1;
    if ($y < 0) {
      $y++;
    }
    return $y + ($yp/$months[12]);
  }
?>
