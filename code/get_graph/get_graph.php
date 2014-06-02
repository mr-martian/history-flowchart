<?php session_start(); ?>
<html>
  <body>
    <?php
      //add more stuff, directions, etc.
      $file = tempnam("blah/blah/graphs", session_name());
      chmod($file, 0777);
      exec(join(" ", array("graph.exe", $file, $_GET['u'], $_GET['lv'], $_GET['e'])));
      $graph = fopen($file, "r") or die("Unable to open file!");
      echo fgets($graph);
      fclose($graph);
    ?>
  </body>
</html>
