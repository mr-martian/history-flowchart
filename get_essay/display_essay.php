<html>
  <body>
    <?php
      include "../globals.php";
      $con = connect();
      $q = mysqli_query($con,"SELECT * FROM " . ($_GET['type'] == 'v' ? 'V' : 'F') . "essays WHERE PID = " . $_GET['id'] . ';');
      $es = mysqli_fetch_assoc($q);
      echo "<h1>" . $es['Title'] . "</h1>";
      echo "<h3>" . $es['Name'] . "</h3>";
      if ($_GET['type'] == 'v') {
        $p = "events/";
        event_summary($es['About']);
      }
      else {
        $p = "effects/";
        effect_summary($es['About']);
      }
      
      echo "<pre>";
      readfile("../essays/$p" . $es['PID'] . ".txt");
      echo "</pre>";
    ?>
  </body>
</html>
