<html>
  <head>
    <script>
      function showhide() {
        var start = document.getElementById("StartDate").value;
        var end = document.getElementById("EndDate").value;
        var lst = document.getElementsByTagName("tr");
        for (var i = 1; i < lst.length; i++) {
          var y = lst[i].childNodes[1].innerHTML;
          var year = y.substr(y.lastIndexOf('/'))
          if (start <= year <= end) {
            lst[i].style.visibility = 'visible';
          }
          else {
            lst[i].style.visibility = 'hidden';
          }
        }
      }
    </script>
  </head>
  <body>
<?php
  include "globals.php";
  $result = get_event();
  $url = $_GET['url'];
echo "<a href='$url?e=*'>All of the below</a>";
echo "<p>Control-f is recommended for finding things on this list.</p>";
echo "<form action='showhide()'>";
echo "Start Year: <input id='StartDate type='number'></input>";
echo "End Year: <input id='EndDate' type='number'></input>";
echo "<input type='submit'>Update</input></form>";
echo "<table>
<tr>
<th>Name</th>
<th>Date</th>
<th>Location</th>
</tr>";

$str = "<td><a href='$url?e=";

while($row = mysqli_fetch_array($result)) {
  echo "<tr>";
  echo $str . $row['Name'] . "' target='_parent'>" . $row['Name'] . "</a></td>";
  echo "<td>" . $row['Date'] . "</td>";
  echo "<td>" . $row['Location'] . "</td>";
  echo "</tr>";
}

echo "</table>";
?>
</body>
</html>
