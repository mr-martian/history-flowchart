<html>
  <body>
    <?php
      include "../globals.php";
      $con = connect();
      $w = ($_POST['type'] == 'v' ? 'Vessays' : 'Fessays');
      $title = mysqli_real_escape_string($con, $_POST['title']);
      $id = mysqli_real_escape_string($con, $_POST['id']);
      $name = mysqli_real_escape_string($con, $_POST['name']);
      $a = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM $w WHERE Title = '$title' and About = '$id' and Name = '$name'"));
      if ($a) { echo "Please try a different title, that one is already taken."; }
      else {
        mysqli_query($con, "INSERT INTO $w (Title, About, Name) VALUES ('$title', '$id', '$name');");
        $a = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM $w WHERE Title = '$title' and About = '$id' and Name = '$name'"));
        $int = strval($a['PID']);
        file_put_contents("../essays/" . ($_POST['type'] == 'v' ? 'events' : 'effects') . "/$int.txt", htmlspecialchars($_POST['essay']) . "\n\n" . "<h3>SOURCES</h3>\n" . htmlspecialchars($_POST['sources']));
        echo "<h2>record succesfully added.</h2>";
      }
    ?>
  </body>
</html>
