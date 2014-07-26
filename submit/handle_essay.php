<html>
  <body>
    <?php
      include "../globals.php";
      $con = connect();
      $w = ($_GET['type'] == 'v' ? 'Vessays' : 'Fessays');
      mysqli_query($con,"INSERT INTO " . $w . " (Title, About) VALUES ('" . $_POST['title'] . "', " . $_GET['id'] . ")");
      $int = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM " . $w . " WHERE Title = " . $_POST['title'] . " and About = " . $_GET['id']))[0]['PID'];
      $file = fopen("essays/" . ($_GET['type'] == 'v' ? 'events' : 'effects') . "/" . $int . ".txt", "x");
      if ($file) {
        fwrite($file, htmlspecialchars($_POST['essay']) . "\n\n");
        fwrite($file, "<h3>SOURCES</h3>\n" . htmlspecialchars($_POST['sources']));
        echo "record succesfully added.";
      }
    ?>
  </body>
</html>
