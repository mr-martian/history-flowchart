<html>
  <body>
    <?php
      include "settings/general.php";
      $con = connect();
      $ef = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM Effects WHERE PID = " . $_GET['id']))[0];
      echo "<h1>", $ef['Cause'], " to ", $ef['Effect'], "</h1>";
      echo "<form action='handle_event_essay.php'" . $_GET['id'] . " method='POST'>";
      echo "<input type='text' maxlength='50' name='title'>Title</input>"
      echo "<textarea rows='100' cols='80' required name='essay'>Please herein describe the details of how";
      echo $ef['Cause'], " led to ", $ef['Effect'], ".</textarea>";
      echo "<textarea rows='15' cols='80' required name='sources'>Sources go here!</textarea>";
      echo "</form>";
    ?>
  </body>
</html>
