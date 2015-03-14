<?php
  include "../globals.php";
  
  $con = connect();
  $c = mysqli_real_escape_string($con, strval(intval($_GET['c'])));
  $e = mysqli_real_escape_string($con, strval(intval($_GET['e'])));
  
  if(mysqli_num_rows(get_effect($cause=$c, $effect=$e)) != 0){
    echo 'Sorry, that cause & effect chain has already been entered. Please add something new.';
  }
  elseif(get_time_coord(get_event_array($c)) > get_time_coord(get_event_array($e))) {
    echo 'The cause you have selected occurred after the effect you selected. Our grapher is not equipped to handle time travel, so we are forced to reject your submission.';
  }
  else {
    if (mysqli_query($con,"INSERT INTO Effects (Cause, Effect) VALUES ('$c', '$e');")) {
      $int = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM Effects WHERE Cause='$c' and Effect='$e';"))['PID'];
      echo "<h1>Record Added Successfully!</h1><br><p>Click <a href='submit_essay.php?type=f&id=$int' target='submit'>here</a> to add an extended description.</p>\n";
    }
    else {
      echo "<h1>There was an error, please try again.</h1>";
    }
  }
?>
