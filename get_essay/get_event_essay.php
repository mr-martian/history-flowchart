<?php
  include "settings/general.php";
  $con = connect();
  $ev = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM Events WHERE PID = " . $_GET['id']));
  $es = mysqli_query($con,"SELECT * FROM Vessays WHERE About = " . $_GET['id']);
  echo "<h1>", $ev['Name'], "</h1>";

while($row = mysqli_fetch_array($result)) {
  echo "<br><a href='display_event_essay.php?id=", $row['PID'], "'>", $row['Title'], "</a>";
}
echo "<hr>";
echo "<a href='submit/submit_event_essay?id=", $_GET['id'], "'>Submit your own</a>";
?>
