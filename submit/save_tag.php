<?php
  include "../globals.php";
  if (settag($_GET['id'], $_GET['tag'], $_GET['type'])) {
    echo "<H1>SUCCESS</H1><p>Tag added.</p>";
  }
  else {
    echo "<H1>Something Went Wrong</H1><p>Please double check your input (must be &lte; 20 characters, numbers, letters, and spaces only) and try again.</p>";
  }
?>
