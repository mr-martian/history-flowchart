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

while($row = mysqli_fetch_array($result)) {
  echo "<tr>";
  echo "<td>" . $row['Name'] . "</td>";
  echo "<td>" . $row['Date'] . "</td>";
  echo "<td>" . $row['Location'] . "</td>";
  echo "</tr>";
}

echo "</table>";

mysqli_close($con);
?>
