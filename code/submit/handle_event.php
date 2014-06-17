<?php
  include "settings/" . $_POST['universe'] . ".php";
  
  $con=mysqli_connect("example.com","peter","abc123","my_db");
  // Check connection
  if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  
  if(!ctype_alnum(str_replace(' ', '', $_POST['name'])) or strlen($_POST['name']) > 30) { 
    echo 'The name you entered is invalid, please only use letters, numbers, and spaces.'; 
  }
  elseif(mysqli_fetch_array(mysqli_query($con,"SELECT * FROM Events WHERE Name = " . sqlite_escape_string($_POST['name']) . " and Universe = " . $_POST['universe']))){
    echo 'Sorry, that name is already taken. Please try something slightly more descriptive.';
  }
  elseif(! is_valid_date($_POST['date'])) {
    echo 'Sorry, your date string is invalid. Please read the <a href="formatting.html">formatting directions</a> and try again.';
  }
  elseif(! is_valid_place($_POST['location'])) {
    echo 'Sorry, your location string is invalid. Please read the <a href="formatting.html">formatting directions</a> and try again.';
  }
  elseif(! is_int($_POST['level']) or $_POST['level'] < 1) {
    echo 'Sorry, your level number is not an integer greater than or equal to 1. Please try again.';
  }
  else {
    $str = $_POST['name'] . "', '" . $_POST['universe'] . "', " . $_POST['level'] . ", '" . $_POST['date'] . "', '" . $_POST['location'] . ")"
    mysqli_query($con,"INSERT INTO Events (Name, Universe, Level, Date, Location) VALUES ('" . $str);
    $int = mysqli_fetch_array(mysqli_query("SELECT * FROM Events WHERE Universe = " . $_POST['universe'] . " and Name = " . $_POST['name']))[0]['PID'];
    $file = fopen("essays/events/" . $int . ".html", "x");
    if ($file) {
      fwrite($file, "<html><body><a href='mailto:flowcharthistory@googlegroups.com?Subject=" . $_POST['name'] . "'>Report this essay</a>");
      fwrite($file, "<br><h1>" . $_POST['name'] . "</h1><br><p>Universe: " . $_POST['universe'] . "</p><p>Level: " . $_POST['level'] . "</p>");
      fwrite($file, "<p>Date: " . $_POST['date'] . "</p><p>Location: " . $_POST['location'] . "</p><pre>" . htmlspecialchars($_POST['essay']) . "</pre>");
      fwrite($file, "<p><b>Sources</b></p><pre>" . htmlspecialchars($_POST['sources']) . "</pre></body></html>");
      echo "<h1>Record Added Successfully!</h1><br><p>Please close this window.</p>";
    }
  }
?>
