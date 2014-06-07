<html>
  <body>
    <H2>Enter Event Name</H2>
    <p>Enter the name of the event you want the graph centered around.</p>
    <p>If you enter nothing, or something that the graph maker does not recognize, it will assume you mean everything</p>
    <form method="get" action=<?php echo "get_date.php?u=", $_GET['u'], '&lv=', $_GET['lv'] ?>>
      Event: <input type="text" name="e">
      <input type="submit" />
    </form>
  </body>
</html>
