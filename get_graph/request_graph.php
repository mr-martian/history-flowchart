<html>
  <body>
    <?php
      include "settings/general.php";
      foreach(array_keys($UNIVERSES) as $u){
        echo "<a href='show_levels.php?u=", $u, "' target='eframe'>", $u, ": ", $UNIVERSES[$u], "</a><br>";
      };
    ?>
    <iframe src="show_events.php?u=Human" name="eframe"></iframe>
  </body>
</html>
