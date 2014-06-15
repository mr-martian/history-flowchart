<?php
  $con=mysqli_connect("example.com","peter","abc123","my_db");
  // Check connection
  if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

  $result = mysqli_query($con,"SELECT * FROM Events WHERE Universe='" . $_GET['u'] . "' and Level='" . $_GET['level'] . "'");

echo "<table>
<tr>
<th>Name</th>
<th>Date</th>
<th>Location</th>
</tr>";

$str = "<td><a href='get_graph.php?u=" . $_GET['u'] . "&lv=" . $_GET['level'] . "&e=";

while($row = mysqli_fetch_array($result)) {
  echo "<tr>";
  echo $str . $row['Name'] . "' target='_parent'>" . $row['Name'] . "</a></td>";
  echo "<td>" . $row['Date'] . "</td>";
  echo "<td>" . $row['Location'] . "</td>";
  echo "</tr>";
}

echo "</table>";

mysqli_close($con);
?>
