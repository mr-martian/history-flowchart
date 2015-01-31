<?php
  include "../globals.php";
  
  $con=connect();
  
  if(!is_valid_name($_GET['name'])) { 
    echo 'The name you entered is invalid, please only use letters, numbers, and spaces.'; 
  }
  elseif(mysqli_fetch_array(mysqli_query($con,"SELECT COUNT(*) FROM Events WHERE Name = '" . $_GET['name'] . "'"))[0] != 0){
    echo 'Sorry, that name is already taken. Please try something slightly more descriptive.';
  }
  elseif(! is_valid_date($_GET['date'])) {
    echo 'Sorry, your date string is invalid. Please read the <a href="formatting.html">formatting directions</a> and try again.';
  }
  elseif(! is_valid_place($_GET['location'])) {
    echo 'Sorry, your location string is invalid. Please read the <a href="formatting.html">formatting directions</a> and try again.';
  }
  else {
    $str = $_GET['name'] . "', '" . $_GET['universe'] . "', '" . $_GET['date'] . "', '" . $_GET['location'] . "')";
    mysqli_query($con,"INSERT INTO Events (Name, Date, Location) VALUES ('" . $str);
    $int = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM Events WHERE Name = '" . $_GET['name'] . "'"))['PID'];
    echo "<h1>Record Added Successfully!</h1><br><p>Click <a href='submit_essay.php?type=v&id=$int' target='submit'>here</a> to add an extended description.</p>\n";
  }
?>
