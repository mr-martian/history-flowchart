<?php
  include "settings/general.php";
  $result = get_event($universe=$_GET['u']);
echo "<a href='" . $_GET['url'] . "?u=" . $_GET['u'] . "&e=*'>All of the below</a>";
echo "<p>Control-f is recommended for finding things on this list.</p>";
echo "<table>
<tr>
<th>Name</th>
<th>Date</th>
<th>Location</th>
</tr>";

$str = "<td><a href='" . $_GET['url'] . "?u=" . $_GET['u'] . "&e=";

while($row = mysqli_fetch_array($result)) {
  echo "<tr>";
  echo $str . $row['Name'] . "' target='_parent'>" . $row['Name'] . "</a></td>";
  echo "<td>" . $row['Date'] . "</td>";
  echo "<td>" . $row['Location'] . "</td>";
  echo "</tr>";
}

echo "</table>";
?>
