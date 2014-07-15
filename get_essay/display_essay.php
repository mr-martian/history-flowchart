<html>
  <head>
    <title><?php
      include "settings/general.php";
      $con = connect();
      $es = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM " . ($_GET['type'] == 'v' ? 'V' : 'F') . "essays WHERE PID = " . $_GET['id']));
      echo $es['Title'];
    ?></title>
  </head>
  <body>
    <?php
      include "settings/general.php";
      $con = connect();
      $es = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM " . ($_GET['type'] == 'v' ? 'V' : 'F') . "essays WHERE PID = " . $_GET['id']));
      echo "<h1>", $es['Title'] "</h1>";
      if ($_GET['type'] == 'v') {
        $p = "events/";
        event_summary($es['About']);
      }
      else {
        $p = "effects/";
        effect_summary($es['About']);
      }
      
      $myfile = fopen("essays/" . $p . $es['PID'] . ".txt", "r") or die("Unable to open file!");
      echo "<pre>" . fread($myfile,filesize("essays/" . $p . $es['PID'] . ".txt")) . "</pre>";
      fclose($myfile);
    ?>
  </body>
</html>
