<html>
  <body>
    <?php
      include "settings/general.php";
      $con = connect();
      mysqli_query($con,"INSERT INTO Vessays (Title, About) VALUES ('" . $_POST['title'] . "', " . $_POST['id'] . ")");
      $int = mysqli_fetch_array(mysqli_query("SELECT * FROM Vessays WHERE Title = " . $_POST['title'] . " and About = " . $_POST['id']))[0]['PID'];
      $file = fopen("essays/events/" . $int . ".txt", "x");
      if ($file) {
        fwrite($file, htmlspecialchars($_POST['essay']) . "\n\n");
        fwrite($file, "SOURCES" . htmlspecialchars($_POST['sources']));
        echo "record succesfully added.";
      }
    ?>
  </body>
</html>
