<html>
  <body>
    <?php
      include "settings/general.php";
      $con = connect();
      if ($_GET['type'] == 'v') {
        event_summary($_GET['id']);
        $title = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM Events WHERE PID = " . $_GET['id']))[0]['Name'];
        $essay = $title . " and its importance.";
      }
      else {
        effect_summary($_GET['id']);
        $ef = mysqli_fetch_array(mysqli_query($con,"SELECT * FROM Effects WHERE PID = " . $_GET['id']))[0];
        $title = $ef['Cause'] . " to " . $ef['Effect'];
        $essay = "the details of how" . $ef['Cause'] . " led to " . $ef['Effect'] . ".";
      }
      
      echo "<h1>", $title, "</h1>";
      echo "<form action='handle_essay.php?id=", $_GET['id'], "&type=", $_GET['type'], " method='POST'>";
      echo "<input type='text' maxlength='50' name='title'>Title</input>"
      echo "<textarea rows='100' cols='80' required name='essay'>Please herein describe ", $essay, "</textarea>";
      echo "<textarea rows='15' cols='80' required name='sources'>Sources go here!</textarea>";
      echo "<button type='submit'>Submit</button>";
      echo "</form>";
    ?>
  </body>
</html>
