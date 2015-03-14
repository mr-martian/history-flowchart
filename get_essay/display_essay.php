<html>
  <body>
    <?php
      include "../globals.php";
      $con = connect();
      $q = mysqli_query($con,"SELECT * FROM " . ($_GET['type'] == 'v' ? 'V' : 'F') . "essays WHERE PID = " . $_GET['id'] . ';');
      $es = mysqli_fetch_assoc($q);
      echo "<h1>" . $es['Title'] . "</h1>";
      echo "<h3>" . $es['Name'] . "</h3>";
      echo "<table border='1'><tr><td colspan='2'>";
      if ($_GET['type'] == 'v') {
        $p = "events/";
        event_summary($es['About']);
        echo "</td><td><table><tr><th>Essay Tags</th></tr><tr><td>";
        echo implode(", ", geteventessaytags($_GET['id'])) ?: "[No Tags]";
        $t = 3;
      }
      else {
        $p = "effects/";
        effect_summary($es['About']);
        echo "</td><td><table><tr><th>Essay Tags</th></tr><tr><td>";
        echo implode(", ", geteffectessaytags($_GET['id'])) ?: "[No Tags]";
        $t = 4;
      }
      echo "<br><a href='../submit/add_tag.php?id=" . $_GET['id'] . "&type=$t'>Add More</a></td></tr></table></td></tr></table>";
      
      echo "<pre>";
      readfile("../essays/$p" . $es['PID'] . ".txt");
      echo "</pre>";
    ?>
  </body>
</html>
