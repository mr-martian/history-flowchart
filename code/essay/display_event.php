<?php
  $path = "essays/events/" . $_GET['n'] . "/";
  $list = scandir($path);
  foreach ($list as $fp){
    $file = fopen($fp, "r");
    echo fgets($file);
    echo "<hr>";
  }
?>
