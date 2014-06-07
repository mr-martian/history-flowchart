<html>
  <body>
    <h3>Select Level</h3>
    <?php
      include 'universe_list.php';
      $lv=$UNIVERSES[$_GET['u']][2];
      for($x=0;$x<count($lv);$x++){
        echo '<br /><a href="get_event.php?u=', $_GET['u'], '&lv=', $x+1, '">', $x+1, ': ', $lv[$x], '</a>';
      }
    ?>
  </body>
</html>
