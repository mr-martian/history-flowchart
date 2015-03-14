<html>
  <head>
    <style>
      iframe {
        width: 100%;
        height: 75%;
      }
    </style>
  </head>
  <body>
<?php
  include "../globals.php";
  echo "<form method='GET' action='save_tag.php'>";
  echo "<input type='hidden' name='id' value='" . $_GET['id'] . "'></input><br>";
  echo "<input type='hidden' name='type' value='" . $_GET['type'] . "'></input><br>";
  echo "<input type='text' maxlength='20' name='tag'>Tag</input><br>";
  echo "<button type='submit'>Submit</button>";
  echo "</form>";
  if ($_GET['type'] == 0) {
    event_summary($_GET['id']);
  }
  else if ($_GET['type'] == 1) {
    effect_summary($_GET['id']);
  }
  else if ($_GET['type'] == 2) {
    echo "<iframe src='../get_essay/display_essay.php?id=" . $_GET['id'] . "&type=v'>";
  }
  else {
    echo "<iframe src='../get_essay/display_essay.php?id=" . $_GET['id'] . "&type=f'>";
  }
?>
  </body>
</html>
