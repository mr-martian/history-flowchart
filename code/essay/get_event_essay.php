<html>
  <body>
    <?php
      $file = fopen("essays/".$_GET['u']."/".$_GET['e'],"r");
      echo fgets($file);
      fclose($file);
    ?>
  </body>
</html>
