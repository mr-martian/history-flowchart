<html>
  <body>
    <?php
      include 'settings/general.php';
      include 'settings/' . $_GET['universe'] . '.php';
      
      $con=connect();

      function ev2svg($event) {
        $s0 = '<circle r="5" stroke="black" stroke-width="1" cx="';
        $s1 = '" cy="';
        $s2 = '" fill="';
        $s3 = '" onclick="window.open(\'';
        $s4 = '\')" marker-end="url(#triangle)"><title>';
        $s5 = '</title></circle>';
        $rs0 = $s0 . get_time_coord($event) . $s1 . get_space_coord($event) . $s2;
        $rs1 = get_event_color($event) . $s3 . 'essays/events/' . $event['PID'] . '.html';
        return $rs0 . $rs1 . $s4 . $event['Name'] . $s5;
      }
      function get_event($name) {
        global $con;
        return mysqli_fetch_array(mysqli_query($con,"SELECT * FROM Events WHERE Universe = '" . $_GET['u'] . "' and Name = '" . $name . "'"));
      }
      function ef2svg($effect) {
        $f = get_event($effect['Cause']);
        $t = get_event($effect['Effect']);
        $s0 = '<line x1="' . get_time_coord($f);
        $s1 = '" y1="' . get_space_coord($f);
        $s2 = '" x2="' . get_time_coord($t);
        $s3 = '" y2="' . get_space_coord($t);
        $s4 = '" color="' . get_effect_color($effect);
        $s5 = '" onclick="window.open(\'' . 'essays/effects/' . $effect['PID'] . '.html';
        $s6 = '\')"><title>' . $f['Name'] . ' to ' . $t['Name'];
        return $s0 . $s1 . $s2 . $s3 . $s4 . $s5 . $s6 . '</title></line>';
      }
      function get_vfs() {
        global $con;
        if($_GET['e'] == '*') {
          return array(mysqli_fetch_all(mysqli_query($con,"SELECT * FROM Events WHERE Universe = '". $_GET['u'] . "'")),
                       mysqli_fetch_all(mysqli_query($con,"SELECT * FROM Effects WHERE Universe = '". $_GET['u'] . "'")));
        }
        elseif(ctype_alnum(str_replace(' ', '', $_GET['e'])) and strlen($_GET['e']) <= 30) {
          $v = array(get_event($_GET['e']));
          $f = array();
          $af = mysqli_fetch_all(mysqli_query($con, "SELECT * FROM Effects WHERE Universe = '" . $_GET['u'] . "' and Cause = '" . $_GET['e'] . "'"));
          $av = array();
          $bf = mysqli_fetch_all(mysqli_query($con, "SELECT * FROM Effects WHERE Universe = '" . $_GET['u'] . "' and Effect = '" . $_GET['e'] . "'"));
          $bv = array();
          while ($av or $af) {
            foreach ($af as $a) {
              array_push($av, get_event($a['To']));
            }
            array_merge($f, $af);
            $af = array();
            foreach ($av as $a) {
              array_merge($af, mysqli_fetch_all(mysqli_query($con, "SELECT * FROM Effects WHERE Universe = '" . $_GET['u'] . "' and Cause = '" . $a['Name'] . "'")));
            }
            array_merge($v, $av);
            $av = array();
          }
          while ($bv or $bf) {
            foreach ($bf as $b) {
              array_push($bv, get_event($b['To']));
            }
            array_merge($f, $bf);
            $af = array();
            foreach ($bv as $b) {
              array_merge($bf, mysqli_fetch_all(mysqli_query($con, "SELECT * FROM Effects WHERE Universe = '" . $_GET['u'] . "' and Effect = '" . $b['Name'] . "'")));
            }
            array_merge($v, $bv);
            $av = array();
          }
          return array($v, $f);
        }
        else {
          return array(array(), array());
        }
      }
      $stuff = get_vfs();
      echo '<svg>';
      echo '<marker xmlns="http://www.w3.org/2000/svg" id="triangle" viewBox="0 0 10 10" refX="0" refY="5" markerUnits="strokeWidth" markerWidth="4" markerHeight="3" orient="auto">
      <path d="M 0 0 L 10 5 L 0 10 z"/></marker>'
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
