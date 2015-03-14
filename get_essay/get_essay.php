<?php
  include "../globals.php";
  $con = connect();
  $result = mysqli_query($con,"SELECT * FROM " . ($_GET['type'] == 'v' ? 'V' : 'F') . "essays WHERE About = " . $_GET['id']);
  if ($_GET['type'] == 'v') {event_summary($_GET['id'], true);}
  else {effect_summary($_GET['id'], true);}

while($row = mysqli_fetch_assoc($result)) {
  echo "<br><a href='display_essay.php?id=", $row['PID'], "&type=", $_GET['type'], "' target=\"result\">", $row['Title'], "</a>";
}
echo "<hr>";
echo "<a href='../submit/submit_essay.php?id=", $_GET['id'], "&type=", $_GET['type'], "'>Submit your own</a>";
?>
