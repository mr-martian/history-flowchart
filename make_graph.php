<html>
  <head>
    <script type="text/javascript">
      function readMouseMove(e){
        var result = document.getElementById('mousepos');
        var x = e.clientX - 5000;
        var y = e.clientY - 180;
var element = document.getElementById('graph');
var rX = 0;
var rY = 0;
if (element.pageYOffset)
   {
   rX=element.pageXOffset;
   rY=element.pageYOffset;
   }
if (document.body)
   {
   rX=document.body.scrollLeft;
   rY=document.body.scrollTop;
   }
if (document.documentElement && document.documentElement.scrollTop)
   {
   rX=document.documentElement.scrollLeft;
   rY=document.documentElement.scrollTop;
   }
x+=rX;
y+=rY;
        if (x < 1) { var xtxt = (1 - x) + " BC"; }
        else { var xtxt = "AD " + x; }
        if (y < 0) { var ytxt = (-1 * y) + "&deg;E"; }
        else { var ytxt = y + "&deg;W"; }
        result.innerHTML = "Your mouse location: " + xtxt + ", " + ytxt;
      }
      document.onmousemove = readMouseMove;
    </script>
    <style>
      #mousepos {
        position: fixed;
        top: 400px;
        left: 25px;
        border: solid;
        padding: 3px;
      }
    </style>
  </head>
  <body>
    <?php
      include 'globals.php';

      function ev2svg($event) {
        $s0 = '<circle r="5" stroke="black" stroke-width="1" cx="';
        $s1 = '" cy="';
        $s2 = '" fill="';
        $s3 = '" onclick="window.open(\'';
        $s4 = '\')"><title>';
        $s5 = '</title></circle>\n';
        $rs0 = $s0 . get_time_coord($event) . $s1 . get_space_coord($event) . $s2;
        $rs1 = get_event_color($event) . $s3 . 'get_essay/get_essay.php?type=v&id=' . $event['PID'];
        return $rs0 . $rs1 . $s4 . $event['Name'] . $s5;
      }
      function ef2svg($effect) {
        $f = get_event_array($effect['Cause']);
        $t = get_event_array($effect['Effect']);
        $s0 = '<line x1="' . get_time_coord($f);
        $s1 = '" y1="' . get_space_coord($f);
        $s2 = '" x2="' . get_time_coord($t);
        $s3 = '" y2="' . get_space_coord($t);
        $s4 = '" stroke-width="3" stroke="' . get_effect_color($effect);
        $s5 = '" onclick="window.open(\'' . 'get_essay/get_essay.php?type=f&id=' . $effect['PID'];
        $s6 = '\')" marker-end="url(#triangle)"><title>' . $f['Name'] . ' to ' . $t['Name'];
        return $s0 . $s1 . $s2 . $s3 . $s4 . $s5 . $s6 . '</title></line>\n';
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
      echo '<marker xmlns="http://www.w3.org/2000/svg" id="triangle" viewBox="0 0 10 10" refX="10" refY="5" markerUnits="strokeWidth" markerWidth="4" markerHeight="3" orient="auto">
      <path d="M 0 0 L 10 5 L 0 10 z"/></marker><g transform="translate(5000, 180)">\n';
      graph();
      echo '</g>';
      for ($x = 0; $x < 7100; $x += 100) {
        echo "<line x1='$x' y1='360' x2='$x' y2='375' stroke-width='5' stroke='blue' /><text x='$x' y='385'>";
        $y = $x - 5000;
        if ($y == 0) {echo "AD 1"; }
        elseif ($y < 1) { echo strval(-$y) . " BC"; }
        else { echo "AD" . strval($y); }
        echo "</text>\n";
      }
      echo '</svg>';
    ?>
  <p id="mousepos">0,0</p>
  </body>
</html>
