<html>
  <head>
    <style>
      #mousepos {
        position: fixed;
        top: 0px;
        left: 25px;
        border: solid;
        padding: 3px;
      }
      #graph {
        border-width: 0px;
        padding: 0px;
        margin: 0px;
      }
      div {
        border-width: 1px;
        border: solid;
      }
      #color {
        width: 420px;
      }
      circle {
        stroke: black;
        stroke-width: 1;
        fill: red;
      }
      line {
        stroke-width: 2.5px;
        stroke: blue;
      }
      line.mark {
        stroke-width: 4px;
      }
    </style>
  </head>
  <body>
    <?php
      include 'globals.php';

      function ev2svg($event) {
        $x = get_time_coord($event);
        $y = get_space_coord($event);
        $c = implode(" ", geteventtags($event['PID']));
        $id = $event['PID'];
        $n = $event['Name'];
        return "<circle r='3.5' cx='$x' cy='$y' class='$c' onclick='window.open(\"get_essay/get_essay.php?type=v&id=$id\")'><title>$n</title></circle>\n";
      }
      function ef2svg($effect) {
        $f = get_event_array($effect['Cause']);
        $t = get_event_array($effect['Effect']);
        $fx = get_time_coord($f);
        $fy = get_space_coord($f);
        $tx = get_time_coord($t);
        $ty = get_space_coord($t);
        $c = implode(" ", geteventtags($effect['Cause'])) . " " . implode(" ", geteventtags($effect['Effect']));
        $s0 = "<line x1='$fx' y1='$fy' x2='$tx' y2='$ty' class='$c'";
        $s1 = " onclick='window.open(\"get_essay/get_essay.php?type=f&id=" . $effect['PID'];
        $s2 = "\")' marker-end='url(#triangle)'><title>" . $f['Name'] . ' to ' . $t['Name'];
        return $s0 . $s1 . $s2 . '</title></line>\n';
      }
      function graph_causes($event) {
        $ls = get_effects_by_effect($event['PID']);
        $els = array();
        while ($f = mysqli_fetch_assoc($ls)) {
          echo ef2svg($f);
          array_push($els, $f['Cause']);
        }
        while ($v = array_pop($els)) {
          $ve = get_event_array($v);
          echo ev2svg($ve);
          graph_causes($ve);
        }
      }
      function graph_effects($event) {
        $ls = get_effects_by_cause($event['PID']);
        $els = array();
        $efs = array();
        while ($f = mysqli_fetch_assoc($ls)) {
          array_push($efs, ef2svg($f));
          array_push($els, $f['Effect']);
        }
        while ($v = array_pop($els)) {
          $ve = get_event_array($v);
          echo ev2svg($ve);
          graph_effects($ve);
        }
        while ($p = array_pop($efs)) {
          echo $p;
        }
      }
      function graph() {
        if (is_numeric($_GET['e']) == 1) {
          $e = get_event_array($_GET['e']);
          echo ev2svg($e);
          graph_causes($e);
          graph_effects($e);
        }
        else {
          $av = get_event();
          while ($v = mysqli_fetch_assoc($av)) {
            echo ev2svg($v);
          }
          $af = get_effect();
          while ($f = mysqli_fetch_assoc($af)) {
            echo ef2svg($f);
          }
        }
      }
      echo '<svg id="graph" height="390" width="7100" zoomAndPan="magnify">';
      echo '<marker xmlns="http://www.w3.org/2000/svg" id="triangle" viewBox="0 0 10 10" refX="8" refY="5" markerUnits="strokeWidth" markerWidth="4" markerHeight="3" orient="auto">
      <path d="M 0 0 L 10 5 L 0 10 z"/></marker><g transform="translate(5000, 180)">\n';
      graph();
      echo '</g>';
      for ($x = 0; $x < 7100; $x += 100) {
        echo "<line class='mark' x1='$x' y1='360' x2='$x' y2='375' /><text x='$x' y='385'>";
        $y = $x - 5000;
        if ($y == 0) {echo "AD 1"; }
        elseif ($y < 1) { echo strval(-$y) . " BC"; }
        else { echo "AD " . strval($y); }
        echo "</text>\n";
      }
      echo '</svg>';
      echo '<p id="mousepos">0,0</p>';
      $x = getalltags();
      echo "<table id='controls'><tr><td><div id='hide'><h4>Hide events with tags:</h4>";
      foreach ($x as $i) {
        echo "<input type='checkbox' id='$i' value='$i'><label for='$i'>$i</label></input>\n";
      }
      echo "<br><button id='update' onclick='dochecks();'>Update</button></div></td>";
      echo '<td><div id="color"></div></td></tr></table>';
    ?>
    <script type="text/javascript" src="graph_mouse.js"></script>
    <script type="text/javascript" src="graph_filter.js"></script>
    <script type="text/javascript" src="graph_color.js"></script>
  </body>
</html>
