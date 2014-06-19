<?php
  include "settings/general.php";
  $u = 0;
  foreach ($UNIVERSES as $ul){
    if ($ul[0] == $_GET['u']){
      $u = $ul;
    };
  };
  for ($n = 0; $n < count($u[2]); $n++){
    echo "<a href='show_events.php?u=", $_GET['u'], "&level=", $n + 1, "' target='eframe'>Level ", $n + 1, ": ", $u[2][$n], "</a><br>";
  };
?>
