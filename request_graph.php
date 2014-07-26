<html>
  <body>
    <?php
      include "settings/general.php";
      foreach(array_keys($UNIVERSES) as $u){
        echo "<a href='show_events.php?u=", $u, "' target='eframe'>", $u, ": ", $UNIVERSES[$u], "</a><br>";
      };
    ?>
    <iframe src="about:blank" name="eframe"></iframe>
  </body>
</html>
