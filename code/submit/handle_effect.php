<?php
  include "settings/" . $_POST['universe'] . ".php";
  
  $con=mysqli_connect("example.com","peter","abc123","my_db");
  // Check connection
  if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  
  if(!ctype_alnum(str_replace(' ', '', $_POST['from'])) or strlen($_POST['from']) > 30) { 
    echo "The 'From' you entered is invalid, please only use letters, numbers, and spaces."; 
  }
  elseif(!ctype_alnum(str_replace(' ', '', $_POST['to'])) or strlen($_POST['to']) > 30) { 
    echo "The 'To' you entered is invalid, please only use letters, numbers, and spaces."; 
  }
  elseif(!ctype_alnum(str_replace(' ', '', $_POST['type'])) or strlen($_POST['type']) > 15) { 
    echo "The 'Type' you entered is invalid, please only use letters, numbers, and spaces."; 
  }
  elseif(mysqli_fetch_array(mysqli_query($con,"SELECT * FROM Effects WHERE From = " . sqlite_escape_string($_POST['from']) . " and To = " . sqlite_escape_string($_POST['to']) . " and Universe = " . $_POST['universe']))){
    echo 'Sorry, that cause & effect chain has already been entered. Please add something new.';
  }
  else {
    $str = $_POST['from'] . "', '" . $_POST['to'] . "', '" . $_POST['universe'] . "', '" . $_POST['type'] . "')"
    mysqli_query($con,"INSERT INTO Events (From, To, Universe, Type) VALUES ('" . $str);
    $int = mysqli_fetch_array(mysqli_query("SELECT * FROM Events WHERE Universe = " . $_POST['universe'] . " and Name = " . $_POST['name']))[0]['PID'];
    $file = fopen("essays/events/" . $int . ".html", "x");
    if ($file) {
      fwrite($file, "<html><body><a href='mailto:flowcharthistory@googlegroups.com?Subject=" . $_POST['from'] . "+to+" . $_POST['to'] . "'>Report this essay</a>");
      fwrite($file, "<br><h1>" . $_POST['from'] . ' to ' . $_POST['to'] . "</h1><br><p>Universe: " . $_POST['universe'] . "</p>");
      fwrite($file, "<p>Type: " . $_POST['type'] . "</p><pre>" . htmlspecialchars($_POST['essay']) . "</pre>");
      fwrite($file, "<p><b>Sources</b></p><pre>" . htmlspecialchars($_POST['sources]) . "</pre></body></html>");
      echo "<h1>Record Added Successfully!</h1><br><p>Please close this window.</p>";
    }
  }
?>
