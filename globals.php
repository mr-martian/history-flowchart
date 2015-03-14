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
  function get_effect($universe=null, $id=null, $cause=null, $effect=null) {
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
  function bytag($tag, $type) {
    $con = connect();
    $ls = mysqli_query($con, "SELECT * from Tags WHERE Tag = '" . mysqli_real_escape_string($con, $tag) . "' AND Category = '" . strval(intval($type)) . "';");
    $ret = array();
    while ($row = mysqli_fetch_assoc($ls)) {
      array_push($ret, $row["PID"]);
    }
    mysqli_close($con);
    return $ret;
  }
  function eventsbytag($tag) { return bytag($tag, 0); }
  function effectsbytag($tag) { return bytag($tag, 1); }
  function eventessaysbytag($tag) { return bytag($tag, 2); }
  function effectessaysbytag($tag) { return bytag($tag, 3); }
  function gettags($pid, $type) {
    $con = connect();
    $ls = mysqli_query($con, "SELECT * from Tags WHERE PID = '" . strval(intval($pid)) . "' AND Category = '" . strval(intval($type)) . "';");
    $ret = array();
    while ($row = mysqli_fetch_assoc($ls)) {
      array_push($ret, $row["Tag"]);
    }
    mysqli_close($con);
    return $ret;
  }
  function geteventtags($pid) { return gettags($pid, 0); }
  function geteffecttags($pid) { return gettags($pid, 1); }
  function geteventessaytags($pid) { return gettags($pid, 2); }
  function geteffectessaytags($pid) { return gettags($pid, 3); }
  function getalltags($type=0) {
    $con = connect();
    $ls = mysqli_query($con, "SELECT DISTINCT Tag FROM Tags WHERE Category = '" . strval(intval($type)) . "';");
    $ret = array();
    while ($row = mysqli_fetch_assoc($ls)) {
      array_push($ret, $row["Tag"]);
    }
    mysqli_close($con);
    return $ret;
  }
  function settag($pid, $tag, $type) {
    if (in_array($pid, bytag($tag, $type))) {
      return true;
    }
    else {
      $con = connect();
      $type = strval(intval($type));
      $pid = strval(intval($pid));
      if (ctype_alnum(str_replace(' ', '', $tag)) and
          strlen($tag) < 20 and
          mysqli_query($con,"INSERT INTO Tags (Tag, PID, Category) VALUES ('" . mysqli_real_escape_string($con,$tag) . "', '" . $pid . "', '" . $type . "');")) {
        mysqli_close($con);
        return true;
      }
      else {
        mysqli_close($con);
        return false;
      }
    }
  }
  function seteventstag($pid, $tag) { return settag($pid, $tag, 0); }
  function seteffectstag($pid, $tag) { return settag($pid, $tag, 1); }
  function seteventessaystag($pid, $tag) { return settag($pid, $tag, 2); }
  function seteffectessaystag($pid, $tag) { return settag($pid, $tag, 3); }
  function event_summary($eid, $up=false) {
    $w = $up ? "." : "";
    $ev = get_event_array($eid);
    echo "<table border='1'><tr><th>Name</th><td>", $ev['Name'], "</td></tr>";
    echo "<tr><th>Date</th><td>", $ev['Date'], "</td></tr>";
    echo "<tr><th>Location</th><td><a target='_blank' href='" . location_link($ev['Location']) . "'>" . $ev['Location'] . "</a></td></tr>";
    echo "<tr><th>Tags</th><td>";
    echo implode(", ", geteventtags($eid)) ?: "[No Tags]";
    echo "<br><a href='$w./submit/add_tag.php?id=$eid&type=0'>Add More</a></td></tr></table>";
  }
  function effect_summary($id, $up=false) {
    $w = $up ? "." : "";
    $ef = mysqli_fetch_assoc(get_effect($id=$id));
    echo "<table border='1'><tr><th>Cause</th><th>Effect</th></tr><tr><td>";
    event_summary($ef['Cause']);
    echo "</td><td>";
    event_summary($ef['Effect']);
    echo "</td></tr><tr><th>Tags</th><td>";
    $x = geteffecttags($id);
    if ($x) { echo implode(", ", $x); }
    else { echo "[No Tags]"; }
    echo "<br><a href='$w./submit/add_tag.php?id=$id&type=1'>Add More</a>";
    echo "</td></tr></table>";
  }
  function is_valid_date($string) {
    //return preg_match("/^-?\d+(\.\d+)?$/", $string) == 1;
    //$match = "/^\d{1,2}\/\d{1,2}\/\d{1,5}$/";
    $match = "/^(0?\d|1\d)\/(0?\d|(1|2)\d|3(0|1))\/-?\d{1,5}$/";
    return preg_match($match, $string) == 1;
  }
  function is_valid_place($string) {
    return preg_match("/^\(-?\d+(\.\d+)?, -?\d+(\.\d+)?\)$/", $string) == 1;
  }
  function get_space_coord($event) {
    return sscanf($event['Location'], "(%f, %f)")[1];
  }
  function get_time_coord($event) {
    list($m, $d, $y) = split('[/]', $event['Date']);
    $months = array(0, 0, 31, 59, 90, 120, 151, 181, 212, 243, 273, 304, 334, 365);
    if ($y % 4 == 0 && ($y % 100 != 0 || $y % 400)) {
      for ($i = 3; $i <= 13; $i++) { $months[$i]++; }
    }
    $yp = $months[$m] + $d - 1;
    if ($y < 0) { $y++; }
    return $y + ($yp / $months[13]);
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
      echo "</tr>";
    }

    echo "</table>";
  }
?>
