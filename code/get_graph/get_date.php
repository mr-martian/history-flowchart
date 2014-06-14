<html>
  <body>
    <h3>Select Date</h3>
    <?php
      echo '<form method="get" action="get_graph.php?u=', $_GET['u'], '&lv=', $_GET['lv'], '&e=', $_GET['e'], '">';
      echo 'Begin in <input type="number" name="start">';
      echo '<input type="radio" name="sbc" value="bc">BC';
      echo '<input type="radio" name="sbc" value="ad">AD<br>';
      //consider sending date of event to be initial contents of input box
      echo 'End in <input type="number" name="end">';
      echo '<input type="radio" name="ebc" value="bc">BC';
      echo '<input type="radio" name="ebc" value="ad">AD<br>';
      echo '<input type="submit">';
      echo '</form>';
    ?>
  </body>
</html>
