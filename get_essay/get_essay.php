<?php
  include "settings/general.php";
  $con = connect();
  $result = mysqli_query($con,"SELECT * FROM " . ($_GET['type'] == 'v' ? 'V' : 'F') . "essays WHERE About = " . $_GET['id']);
  if ($_GET['type'] == 'v') {event_summary($_GET['id']);}
  else {effect_summary($_GET['id']);}

while($row = mysqli_fetch_array($result)) {
  echo "<br><a href='display_essay.php?id=", $row['PID'], "&type=", $_GET['type'], "'>", $row['Title'], "</a>";
}
echo "<hr>";
echo "<a href='submit/submit_essay?id=", $_GET['id'], "&type=", $_GET['type'], "'>Submit your own</a>";
?>
