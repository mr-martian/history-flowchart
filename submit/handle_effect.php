<?php
  include "settings/general.php";
  get_universe($_POST['universe']);
  
  $con=connect();
  
  if(!is_valid_name($_POST['from'])) { 
    echo "The 'Cause' you entered is invalid, please only use letters, numbers, and spaces."; 
  }
  elseif(!is_valid_name($_POST['to'])) { 
    echo "The 'Effect' you entered is invalid, please only use letters, numbers, and spaces."; 
  }
  elseif(!is_valid_type($_POST['type'])) { 
    echo "The 'Type' you entered is invalid, please only use letters, numbers, and spaces."; 
  }
  elseif(mysqli_fetch_array(mysqli_query($con,"SELECT * FROM Effects WHERE Cause = " . sqlite_escape_string($_POST['from']) . " and Effect = " . sqlite_escape_string($_POST['to']) . " and Type = " . $_POST['type']))){
    echo 'Sorry, that cause & effect chain has already been entered. Please add something new.';
  }
  else {
    $str = $_POST['from'] . "', '" . $_POST['to'] . "', '" . $_POST['type'] . "', '" . $_POST['Universe'] . "')"
    mysqli_query($con,"INSERT INTO Events (Cause, Effect, Type, Universe) VALUES ('" . $str);
    $int = mysqli_fetch_array(mysqli_query("SELECT * FROM Events WHERE  Cause = " . $_POST['from'] . " and Effect = " . $_POST['to'] . " and Universe = " . $_POST['universe']))[0]['PID'];
    echo "<h1>Record Added Successfully!</h1><br><p>Click <a href='submit_effect_essay.php?id=" . $int . "'>here</a> to add an extended description.</p>";
  }
?>
