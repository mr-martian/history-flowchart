<?php
  include "settings/general.php";
  get_universe($_GET['u']);
  
  if(get_effect($cause=$_GET['c'], $effect=$_GET['e'], $type=$_GET['t'], $array=true)){
    echo 'Sorry, that cause & effect chain has already been entered. Please add something new.';
  }
  elseif(!is_valid_type($_GET['t'])) {
    echo 'Type invalid, please try resubmitting the form.'
  }
  else {
    $str = intval($_GET['c']) . ", " . intval($_GET['e']) . ", '" . $_GET['t'] . "', '" . $_GET['u'] . "')"
    mysqli_query($con,"INSERT INTO Events (Cause, Effect, Type, Universe) VALUES (" . $str);
    $int = get_effect($cause=intval($_GET['c']), $effect=intval($_GET['e']), $universe =$_GET['u'], $type=$_GET['t'], $array=true)['PID'];
    echo "<h1>Record Added Successfully!</h1><br><p>Click <a href='submit_essay.php?type=f&id=" . $int . "' target='submit'>here</a> to add an extended description.</p>";
  }
?>
