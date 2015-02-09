<?php
  include "../globals.php";
  if ($_GET['m'] == 'v') { event_list("get_essay.php?type=v&id=", ''); }
  else { effect_list("get_essay.php?type=f&id=", ''); }
?>
