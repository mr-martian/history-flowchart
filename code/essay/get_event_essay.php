<html>
  <body>
    <?php
      $DB = mysqli_connect("flowcharthistory.com", "user", "password", "flowchart_data");
      $search = "SELECT * FROM Events WHERE Universe='" . $_GET['u'] . "' and Name='" . $_GET['e'] . "';";
      $stuff = mysqli_query($con, $search);
      $list = array();
      while($row = mysqli_fetch_array($stuff)) {
        array_push($list, $row);
      }
      if (count($list) == 0){
        echo "<H1>ERROR: no events found matching Universe=", $_GET['u'], ", Name=", $_GET['e'], "</H2>";
      }
      elseif (count($list) == 1){
        echo "<iframe src='display_event.php?n=", $list[0]['PID'], "'></iframe>";
      }
      else{
        echo "<p>Found multiple events, please select one.</p><br />";
        echo "<table border='1'>";
        echo "<tr><th>Select</th><th>Universe</th><th>Name</th><th>Level</th><th>Date</th><th>Location</th></tr>";
        foreach ($list as $event) {
          echo "<tr>";
          echo "<td><a href='display_event.php?n=", $event['PID'], "' target='mainframe'>select</a></td>";
          echo "<td>", $row['Universe'], "</td>";
          echo "<td>", $row['Name'], "</td>";
          echo "<td>", $row['Level'], "</td>";
          echo "<td>", $row['Date'], "</td>";
          echo "<td>", $row['Location'], "</td>";
          echo "</tr>";
        }

        echo "</table>";
        echo "<iframe src='about:blank' name='mainframe'></iframe>";
      }
      mysqli_close($con);
    ?>
  </body>
</html>
