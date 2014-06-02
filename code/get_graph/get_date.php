<?php session_start(); ?>
<html>
  <body>
    <h3>Select Date</h3>
    <?php
      echo 'Sorry, we haven't implemented date selection yet. Click ';
      echo '<a href="get_graph.php?u=', $_GET['u'], '&lv=', $_GET['lv'], '&e=', $_GET['e'], '&', htmlspecialchars(SID), '">here</a>';
      echo ' to continue.';
    ?>
  </body>
</html>
