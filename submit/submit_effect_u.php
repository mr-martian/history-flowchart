<?php
  include "settings/general.php";
  
  foreach (array_keys($UNIVERSES) as $u){
    echo "<a href='submit_effect_c.php?u=", $u, "' target='cause'>", $u, "</a>";
  };
  
  echo "<iframe id='cause'></iframe>";
  echo "<iframe id='effect'></iframe>";
  echo "<iframe id='type'></iframe>";
?>
