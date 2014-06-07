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
        $rs1 = get_event_color($event) . $s3 . 'path/to/v_essay.php?u=' . $UNIVERSES[$_GET['u']][0] . '&e=' . $event[0];
        return $rs0 . $rs1 . $s4 . $event[0] . $s5;
      }
      function ef2svg($effect) {
        $f = find_event($effect[0]);
        $t = find_event($effect[1]);
        $s0 = '<line x1="' . get_time_coord($f);
        $s1 = '" y1="' . get_space_coord($f);
        $s2 = '" x2="' . get_time_coord($t);
        $s3 = '" y2="' . get_space_coord($t);
        $s4 = '" color="' . get_effect_color($effect);
        $s5 = '" onclick="window.open(\'' . 'path/to/f_essay.php?u=' . $UNIVERSES[$_GET['u']][0];
        $s6 = '&f=' . $f[0] . '&t=' . $t[0]; '\')"><title>' . $f[0] . ' to ' . $t[0];
        return $s0 . $s1 . $s2 . $s3 . $s4 . $s5 . $s6 . '</title></line>';
      }
      function get_vfs() {
        return array(0,0); //(events, effects) from $_GET
      }
      $stuff = get_vfs();
      echo '<svg>';
      foreach ($stuff[0] as $ev) {
        echo ev2svg($ev);
      }
      foreach ($stuff[1] as $ef) {
        echo ef2svg($ef);
      }
      echo '</svg>'
    ?>
  </body>
</html>
