<html>
  <body>
    <?php
      echo "<form action='handle_event_essay.php'" . $_GET['id'] . " method='POST'>";
      echo "<textarea rows='100' cols='80' required name='essay'>Please herein describe the event and its importance.</textarea>";
      echo "<textarea rows='15' cols='80' required name='sources'>Sources go here!</textarea>";
      echo "</form>";
    ?>
  </body>
</html>
