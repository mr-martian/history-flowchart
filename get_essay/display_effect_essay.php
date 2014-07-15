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
      effect_summary($es['About']);
      
      $myfile = fopen("essays/events/" . $es['PID'] . ".txt", "r") or die("Unable to open file!");
      echo "<pre>" . htmlspecialchars(fread($myfile,filesize("essays/events/" . $es['PID'] . ".txt"))) . "</pre>";
      fclose($myfile);
    ?>
  </body>
</html>
