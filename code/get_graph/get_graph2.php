<html>
  <body>
    <?php
      include "universe_list.php";
      foreach($UNIVERSES as $u){
        echo "<a href='show_levels.php?u=", $u[0], "' target='lframe'>", $u[0], ": ", $u[1], "</a><br>";
      }
    ?>
    <iframe src="show_levels.php?u=Human&target=eframe" name="lframe"></iframe>
    <iframe src="show_events.php?u=Human&target=_parent" name="eframe"></iframe>
  </body>
</html>
