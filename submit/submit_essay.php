<html>
  <body>
    <?php
      include "../globals.php";
      $con = connect();
      if ($_GET['type'] == 'v') {
        event_summary($_GET['id']);
        $title = get_event_array($_GET['id'])['Name'];
        $essay = $title . " and its importance.";
      }
      else {
        effect_summary($_GET['id']);
        $ef = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM Effects WHERE PID = " . $_GET['id']));
        $title = $ef['Cause'] . " to " . $ef['Effect'];
        $essay = "the details of how " . $ef['Cause'] . " led to " . $ef['Effect'] . ".";
      }
      
      echo "<h1>$title</h1>";
      echo "<p>Scroll down to submit.</p>";
      echo "<form action='handle_essay.php' method='POST' target='result'>";
      echo "<input type='hidden' name='id' value='" . $_GET['id'] . "'></input><br>";
      echo "<input type='hidden' name='type' value='" . $_GET['type'] . "'></input><br>";
      echo "<input type='text' maxlength='50' name='title'>Title of this Document</input><br>";
      echo "<input type='text' maxlength='30' name='name'>Your Name</input><br>";
      echo "<textarea rows='20' cols='80' required name='essay'>Please herein describe $essay</textarea>";
      echo "<textarea rows='15' cols='80' required name='sources'>Sources go here!</textarea>";
      echo "<button type='submit'>Submit</button>";
      echo "</form>";
    ?>
  </body>
</html>
