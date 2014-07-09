<html>
  <head>
    <title><?php
      include "settings/general.php";
      $con = connect();
      $es = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM Fessays WHERE PID = " . $_GET['id']));
      echo $es['Title'];
    ?></title>
  </head>
  <body>
    <?php
      include "settings/general.php";
      $con = connect();
      $es = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM Fessays WHERE PID = " . $_GET['id']));
      echo "<h1>", $es['Title'] "</h1>";
      $ef = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM Effects WHERE PID = " . $es['About']));
      $f = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM Events WHERE Name = '" . $ef['Cause']));
      $t = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM Events WHERE Name = '" . $ef['Effect']));
      echo "<table><tr><th></th><th>Cause</th><th>Effect</th></tr>";
      echo "<tr><td>Event</td><td>", $f['Name'], "</td><td>", $t['Name'], "</td></tr>";
      echo "<tr><td>Universe</td><td>", $f['Universe'], "</td><td>", $t['Universe'], "</td></tr>";
      echo "<tr><td>Date</td><td>", $f['Date'], "</td><td>", $t['Date'], "</td></tr>";
      echo "<tr><td>Location</td><td>", $f['Location'], "</td><td>", $t['Location'], "</td></tr>";
      echo "</table><p>Type: ", $ef['Type'], "</p>";
      
      $myfile = fopen("essays/events/" . $es['PID'] . ".txt", "r") or die("Unable to open file!");
      echo "<pre>" . htmlspecialchars(fread($myfile,filesize("essays/events/" . $es['PID'] . ".txt"))) . "</pre>";
      fclose($myfile);
    ?>
  </body>
</html>
