<?php
  include 'settings/general.php';
  get_universe($_GET['u']);
  for (array_keys($types) as $key) {
    echo "<a href='handle_effect.php?u=", $_GET['u'], "&c=", $_GET['c'], "&e=", $_GET['e'], "&t=", $key, "' target='result'>", $key, "</a>";
  }
?>
