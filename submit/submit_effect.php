<html>
  <body>
    <form action="handle_effect.php" method="post" target="_blank">
      <?php
        include "settings/general.php";
        echo "<select required name='universe'>";
        foreach (array_keys($UNIVERSES) as $u){
          echo "<option value='", $u, "'>", $u, "</option>";
        };
        //echo "<option value='Multi'>Multi</option>";
        echo "</select>";
      ?>
      <br>
      <input type="text" required maxlength="30" name="from">  Cause</input>
      <br>
      <input type="text" required maxlength="30" name="to">  Effect</input>
      <br>
      <input type="text" required maxlength="15" name="type"> Type</input>
      <br>
      <p>Please ensure that you have read the <a href="formatting.html">formatting instructions</a> before proceeding.</p>
      <br>
      <input type="submit"></input>
  </body>
</html>
