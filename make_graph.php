<html>
  <body>
    <?php
      include 'globals.php';
      include get_universe_path($_GET['u'], $root=true);

      function ev2svg($event) {
        $s0 = '<circle r="5" stroke="black" stroke-width="1" cx="';
        $s1 = '" cy="';
        $s2 = '" fill="';
        $s3 = '" onclick="window.open(\'';
        $s4 = '\')"><title>';
        $s5 = '</title></circle>';
        $rs0 = $s0 . get_time_coord($event) . $s1 . get_space_coord($event) . $s2;
        $rs1 = get_event_color($event) . $s3 . 'get_essay/get_essay.php?type=v&id=' . $event['PID'];
        return $rs0 . $rs1 . $s4 . $event['Name'] . $s5;
      }
      function ef2svg($effect) {
        $con = connect();
        $f = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM Events WHERE PID = " . $effect['Cause']));
        $t = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM Events WHERE PID = " . $effect['Effect']));
        $s0 = '<line x1="' . get_time_coord($f);
        $s1 = '" y1="' . get_space_coord($f);
        $s2 = '" x2="' . get_time_coord($t);
        $s3 = '" y2="' . get_space_coord($t);
        $s4 = '" stroke-width="3" stroke="' . get_effect_color($effect);
        $s5 = '" onclick="window.open(\'' . 'get_essay/get_essay.php?type=f&id=' . $effect['PID'];
        $s6 = '\')" marker-end="url(#triangle)"><title>' . $f['Name'] . ' to ' . $t['Name'];
        return $s0 . $s1 . $s2 . $s3 . $s4 . $s5 . $s6 . '</title></line>';
      }
      function allev2svg($ls) {
        foreach ($ls as $v) {
          echo ev2svg($v);
        }
      }
      function allef2svg($ls) {
        foreach ($ls as $f) {
          echo ef2svg($f);
        }
      }
      function graph() {
        $con = connect();
        if($_GET['e'] == '*') {
          foreach (mysqli_fetch_all(mysqli_query($con, "SELECT * FROM Events WHERE Universe = '" . $_GET['u'] . "'"), $resulttype = MYSQLI_ASSOC) as $v) {
            echo ev2svg($v);
          }
          foreach (mysqli_fetch_all(get_effect($universe=$_GET['u']), $resulttype = MYSQLI_ASSOC) as $f) {
            echo ef2svg($f);
          }
          return true;
        }
        elseif (is_numeric($_GET['e'])) {
          echo ev2svg(mysqli_fetch_assoc(get_event($id=intval($_GET['e']), $universe=$_GET['u'])));
          $af = mysqli_fetch_all(get_effect($universe=$_GET['u'], $cause=intval($_GET['e'])), $resulttype = MYSQLI_ASSOC);
          $av = array();
          $bf = mysqli_fetch_all(get_effect($universe=$_GET['u'], $effect=intval($_GET['e'])), $resulttype = MYSQLI_ASSOC);
          $bv = array();
          while ($av or $af) {
            foreach ($af as $a) {
              array_push($av, mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM Events WHERE Universe = '" . $_GET['u'] . "' and PID = " . $a['Cause'])));
            }
            allef2svg($af);
            $af = array();
            foreach ($av as $a) {
              array_merge($af, mysqli_fetch_all(get_effect($universe=$_GET['u'], $cause=$a['PID']), $resulttype = MYSQLI_ASSOC));
            }
            allev2svg($av);
            $av = array();
          }
          while ($bv or $bf) {
            foreach ($bf as $b) {
              array_push($bv, mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM Events WHERE Universe = '" . $_GET['u'] . "' and PID = " . $b['Effect'])));
            }
            allef2svg($bf);
            $af = array();
            foreach ($bv as $b) {
              array_merge($bf, mysqli_fetch_all(get_effect($universe=$_GET['u'], $effect=$b['PID']), $resulttype = MYSQLI_ASSOC));
            }
            allev2svg($bv);
            $av = array();
          }
        }
        else {
          return true;
        }
      }
      echo '<svg ' . $svg . '>';
      echo '<marker xmlns="http://www.w3.org/2000/svg" id="triangle" viewBox="0 0 10 10" refX="7" refY="5" markerUnits="strokeWidth" markerWidth="4" markerHeight="3" orient="auto">
      <path d="M 0 0 L 10 5 L 0 10 z"/></marker>';
      graph();
      echo '</svg>';
    ?>
  </body>
</html>
