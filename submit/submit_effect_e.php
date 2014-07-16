<?php
  include 'settings/general.php';
  $result = get_event($universe=$_GET['u']);
  while($row = mysqli_fetch_array($result)) {
    echo "<br><a href='submit_effect_e.php?u=", $_GET['u'], "&c=", $_GET['c'], "&e=", $row['PID'], "' target='effect'>", $row['Name'], "</a>";
  }
?>
