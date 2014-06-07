<html>
  <body>
    <?php
      include 'universe_list.php';
      include 'path/to/data/' . $UNIVERSES[$_GET['u']][0] . '/settings.php';
      function ev2svg($event) {
        $s0 = '<circle r="5" stroke="black" stroke-width="1" cx="';
        $s1 = '" cy="';
        $s2 = '" fill="';
        $s3 = '" onclick="window.open(\'';
        $s4 = '\')"><title>';
        $s5 = '</title></circle>';
        $rs0 = $s0 . get_time_coord($event) . $s1 . get_space_coord($event) . $s2;
        $rs1 = get_color($event) . $s3 . 'path/to/get_essay.php?u=' . $UNIVERSES[$_GET['u']][0] . '&e=' . $event[0];
        return $rs0 . $rs1 . $s4 . $event[0] . $s5;
      }
    ?>
  </body>
</html>
