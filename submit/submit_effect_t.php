<?php
  include "../globals.php";
  foreach (array_keys($types) as $key) {
    echo "<a href='handle_effect.php?c=", $_GET['c'], "&e=", $_GET['e'], "&t=", $key, "' target='result'>", $key, "</a><br>";
  }
?>
