<?php
  //error file can be found at /var/log/apache2/error.log
  function is_valid_name($name) {
    return ctype_alnum(str_replace(' ', '', $name)) and strlen($name) < 30;
  }
  function connect($usedb = true) {
    if ($usedb) {
      $con=mysqli_connect("localhost", "root", "password", "flowchart_data"); //change password, username later
    }
    else {
      $con=mysqli_connect("localhost", "root", "password");
    }
    // Check connection
    if (!$con) {
      die("Connection failed: " . mysqli_connect_error());
    }
    else {
      return $con;
    }
  }
  function get_event($name=null, $universe=null, $id=null, $date=null, $location=null) {
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
    $ret = mysqli_query($con, "SELECT * FROM Events" . (!$added ? '' : $str) . ';');
    mysqli_close($con);
    return $ret;
  }
  function get_event_array($id) {
    $con = connect();
    $ret = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM Events WHERE PID = " . strval(intval($id)) . ";"));
    mysqli_close($con);
    return $ret;
  }
  function get_effect($universe=null, $id=null, $cause=null, $effect=null, $type=null) {
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
    return $ret;
  }
  function get_effects_by_cause($cause) {
    $con = connect();
    $ret = mysqli_query($con, "SELECT * FROM Effects WHERE Cause = " . strval(intval($cause)) . ";");
    mysqli_close($con);
    return $ret;
  }
  function get_effects_by_effect($effect) {
    $con = connect();
    $ret = mysqli_query($con, "SELECT * FROM Effects WHERE Effect = " . strval(intval($effect)) . ";");
    mysqli_close($con);
    return $ret;
  }
  function location_link($str) {
    $ar = sscanf($str, "(%f, %f)");
    return "http://www.openstreetmap.org/?mlat=" . $ar[0] . "&mlon=" . strval(-1 * intval($ar[1])) . "&zoom=6#layers=T";
  }
  function event_summary($eid) {
    $ev = get_event_array($eid);
    echo "<table><tr><th>Name</th><td>", $ev['Name'], "</td></tr>";
    echo "<tr><th>Date</th><td>", $ev['Date'], "</td></tr>";
    echo "<tr><th>Location</th><td><a target='_blank' href='" . location_link($ev['Location']) . "'>" . $ev['Location'] . "</a></td></tr></table>";
  }
  function effect_summary($id) {
    $ef = mysqli_fetch_assoc(get_effect($id=$id));
    echo "<table border='1'><tr><th>Cause</th><th>Effect</th><th>Type</th></tr><tr><td>";
    event_summary($ef['Cause']);
    echo "</td><td>";
    event_summary($ef['Effect']);
    echo "</td><td>" . $ef['Type'] . "</td></tr></table>";
  }
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
    return sscanf($event['Location'], "(%f, %f)")[1];
  }
  function get_time_coord_old($event) {
    //return sscanf($event['Date'], "%f")[0] + 5000;
    //sscanf($event['Date'], "%i/%i/%i", $m, $d, $y);
    $date = date_parse($event['Date']);
    $m = $date['month'];
    $d = $date['day'];
    $y = $date['year'];
    $months = array(1 => 0, 2 => 31, 3 => 59, 4 => 90, 5 => 120, 6 => 151, 7 => 181, 8 => 212, 9 => 243, 10 => 273, 11 => 304, 12 => 334, 13 => 365);
    if ($y % 4 == 0 and ($y % 100 != 0 or $y % 400)) {
      $months = array(1 => 0, 2 => 31, 3 => 60, 4 => 91, 5 => 121, 6 => 152, 7 => 182, 8 => 213, 9 => 244, 10 => 274, 11 => 305, 12 => 335, 13 => 366);
    }
    print_r($m);
    $yp = $months[$m] + $d - 1;
    if ($y < 0) {
      $y++;
    }
    return $y + ($yp/$months[13]);
  }
  function get_time_coord_2($event) {
    list($m, $d, $y) = split('[/]', $event['Date']);
    $months = array(0, 0, 31, 59, 90, 120, 151, 181, 212, 243, 273, 304, 334, 365);
    if ($y % 4 == 0 && ($y % 100 != 0 || $y % 400)) {
      for ($i = 3; $i <= 13; $i++) { $months[$i]++; }
    }
    $yp = $months[$m] + $d - 1;
    if ($y < 0) { $y++; }
    return $y + ($yp / $months[13]);
  }
  function get_time_coord($event) {
    sscanf($event['Date'], "%i/%i/%i", $m, $d, $y);
    return intval($y);
  }
  function event_list($url, $target, $allok=false) {
    $result = get_event();
    echo "<script>
      function showhide() {
        var start = parseInt(document.getElementById('StartDate').value);
        var end = parseInt(document.getElementById('EndDate').value);
        var lst = document.getElementsByClassName('date');
        for (var i = 0; i < lst.length; i++) {
          var year = parseInt(lst[i].innerHTML.split('/')[2]);
          if (start <= year && year <= end) {
            lst[i].parentNode.style.visibility = 'visible';
          }
          else {
            lst[i].parentNode.style.visibility = 'hidden';
          }
        }
      }
    </script>";
    if ($allok) {echo "<a href='$url*' target='$target'>All of the below</a><br>";}
    echo "Start Year: <input id='StartDate' type='number'></input>";
    echo "End Year: <input id='EndDate' type='number'></input>";
    echo "<button onclick='showhide()'>Update</button>";
    echo "<table>
<tr>
<th>Name</th>
<th>Date</th>
<th>Location</th>
</tr>";

    $str = "<td><a href='$url";

    while($row = mysqli_fetch_array($result)) {
      echo "<tr>";
      echo "<td><a href='$url" . $row['PID'] . "' target='$target'>" . $row['Name'] . "</a></td>";
      echo "<td class='date'>" . $row['Date'] . "</td>";
      echo "<td>" . $row['Location'] . "</td>";
      echo "</tr>";
    }

    echo "</table>";
  }
  function effect_list($url, $target, $allok=false) {
    $result = get_effect();
    echo "<script>
      function showhide() {
        var start = parseInt(document.getElementById('StartDate').value);
        var end = parseInt(document.getElementById('EndDate').value);
        var lst = document.getElementsByClassName('date');
        for (var i = 0; i < lst.length; i++) {
          var year = parseInt(lst[i].innerHTML.split('/')[2]);
          if (start <= year && year <= end) {
            lst[i].parentNode.style.visibility = 'visible';
          }
          else {
            lst[i].parentNode.style.visibility = 'hidden';
          }
        }
      }
    </script>";
    if ($allok) {echo "<a href='$url*' target='$target'>All of the below</a><br>";}
    //echo "Start Year: <input id='StartDate' type='number'></input>";
    //echo "End Year: <input id='EndDate' type='number'></input>";
    //echo "<button onclick='showhide()'>Update</button>";
    echo "<table>
<tr>
<th></th>
<th>Cause</th>
<th>Effect</th>
<th>Type</th>
</tr>";

    $str = "<td><a href='$url";

    while($row = mysqli_fetch_assoc($result)) {
      echo "<tr>";
      echo "<td><a href='$url" . $row['PID'] . "' target='$target'>" . $row['PID'] . "</a></td>";
      echo "<td>" . $row['Cause'] . "</td>";
      echo "<td>" . $row['Effect'] . "</td>";
      echo "<td>" . $row['Type'] . "</td>";
      echo "</tr>";
    }

    echo "</table>";
  }
?>
