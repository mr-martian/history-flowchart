<html>
  <body>
    <?php
      //add more stuff, directions, etc.
      $file = tempnam("blah/blah/graphs", "graph116"); //make better names somehow, time maybe
      chmod($file, 0777);
      exec(join(" ", array("graph.exe", $file, $_GET['event'], $_GET['start'], $_GET['end'])));
      $graph = fopen($file, "r") or die("Unable to open file!");
      echo fgets($graph);
      fclose($graph);
    ?>
  </body>
</html>
