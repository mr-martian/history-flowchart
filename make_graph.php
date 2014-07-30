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
      function graph_causes($event) {
        $con = connect();
        $ls = mysqli_fetch_all(get_effect($universe=$_GET['u'], $effect=$event), $resulttype = MYSQLI_ASSOC);
        $els = array();
        while ($f = array_pop($ls)) {
          echo ef2svg($f);
          array_push($els, $f['Cause']);
        }
        while ($v = array_pop($ls)) {
          echo ev2svg(get_event($universe=$_GET['u'], $id=$v, $array=true));
          graph_causes($v);
        }
      }
      function graph_effects($event) {
        $con = connect();
        $ls = mysqli_fetch_all(get_effect($universe=$_GET['u'], $cause=$event), $resulttype = MYSQLI_ASSOC);
        $els = array();
        while ($f = array_pop($ls)) {
          echo ef2svg($f);
          array_push($els, $f['Effect']);
        }
        while ($v = array_pop($ls)) {
          echo ev2svg(get_event($universe=$_GET['u'], $id=$v, $array=true));
          graph_causes($v);
        }
      }
      function graph() {
        $con = connect();
        if (is_numeric($_GET['e'])) {
          echo ev2svg(get_event($universe=$_GET['u'], $id=$_GET['e'], $array=true));
          graph_causes($_GET['e']);
          graph_effects($_GET['e']);
        }
        else {
          foreach (mysqli_fetch_all(mysqli_query($con, "SELECT * FROM Events WHERE Universe = '" . $_GET['u'] . "'"), $resulttype = MYSQLI_ASSOC) as $v) {
            echo ev2svg($v);
          }
          foreach (mysqli_fetch_all(get_effect($universe=$_GET['u']), $resulttype = MYSQLI_ASSOC) as $f) {
            echo ef2svg($f);
          }
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
