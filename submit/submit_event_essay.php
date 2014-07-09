<html>
  <body>
    <?php
      include "settings/general.php";
      $con = connect();
      echo "<h1>", mysqli_fetch_array(mysqli_query($con,"SELECT * FROM Events WHERE PID = " . $_GET['id'])), "</h1>";
      echo "<form action='handle_event_essay.php'" . $_GET['id'] . " method='POST'>";
      echo "<input type='text' maxlength='50' name='title'>Title</input>"
      echo "<textarea rows='100' cols='80' required name='essay'>Please herein describe the event and its importance.</textarea>";
      echo "<textarea rows='15' cols='80' required name='sources'>Sources go here!</textarea>";
      echo "</form>";
    ?>
  </body>
</html>
