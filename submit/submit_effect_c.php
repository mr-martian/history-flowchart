<?php
  include "settings/general.php";
  $con = connect();
  $result = mysqli_query($con, "SELECT * FROM Events WHERE Universe = " . $_GET['u']);
  while($row = mysqli_fetch_array($result)) {
    echo "<br><a href='submit_effect_e.php?u=", $_GET['u'], "&c=", $row['PID'], "' target='effect'>", $row['Name'], "</a>";
  }
?>
