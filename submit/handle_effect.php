<?php
  include "../globals.php";
  include get_universe_path($_GET['u']);
  
  $con = connect();
  $c = mysqli_real_escape_string($con, strval(intval($_GET['c'])));
  $e = mysqli_real_escape_string($con, strval(intval($_GET['e'])));
  $t = mysqli_real_escape_string($con, $_GET['t']);
  $u = mysqli_real_escape_string($con, $_GET['u']);
  
  if(mysqli_num_rows(get_effect($cause=$c, $effect=$e, $type=$t)) != 0){
    echo 'Sorry, that cause & effect chain has already been entered. Please add something new.';
  }
  elseif(!is_valid_type($t)) {
    echo 'Type invalid, please try resubmitting the form.';
  }
  else {
    if (mysqli_query($con,"INSERT INTO Effects (Cause, Effect, Type, Universe) VALUES ('$c', '$e', '$t', '$u');")) {
      $int = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM Effects WHERE Cause='$c' and Effect='$e' and Type='$t' and Universe='$u'"))['PID'];
      echo "<h1>Record Added Successfully!</h1><br><p>Click <a href='submit_essay.php?type=f&id=$int' target='submit'>here</a> to add an extended description.</p>\n";
    }
    else {
      echo "<h1>There was an error, please try again.</h1>";
    }
  }
?>
