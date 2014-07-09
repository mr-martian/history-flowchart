<html>
  <body>
    <?php
      include "settings/general.php";
      $con = connect();
      $int = mysqli_fetch_array(mysqli_query("SELECT * FROM Events WHERE PID = " . $_POST['universe'] . " and Name = " . $_POST['name']))[0]['PID'];
      $file = fopen("essays/events/" . $_GET['id'] . ".txt", "x");
      if ($file) {
        fwrite($file, htmlspecialchars($_POST['essay']) . "\n\n");
        fwrite($file, "SOURCES" . htmlspecialchars($_POST['sources']));
      }
    ?>
  </body>
</html>
