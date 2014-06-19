<html>
  <body>
    <?php
      include "settings/general.php";
      foreach($UNIVERSES as $u){
        echo "<a href='show_levels.php?u=", $u[0], "' target='lframe'>", $u[0], ": ", $u[1], "</a><br>";
      };
    ?>
    <iframe src="show_levels.php?u=Human" name="lframe"></iframe>
    <iframe src="show_events.php?u=Human&level=1" name="eframe"></iframe>
  </body>
</html>
