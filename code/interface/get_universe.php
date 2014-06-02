<?php session_start(); ?>
<html>
  <body>
    <h3>Select Universe</h3>
    <?php
      include 'universe_list.php';
      for($x=0;$x<count($UNIVERSES);$x++){
        echo '<br /><a href="get_level.php?u=', $x, '&', htmlspecialchars(SID) '">', $UNIVERSES[$x][0], ': ', $UNIVERSES[$x][1], '</a>';
      }
    ?>
  </body>
</html>
