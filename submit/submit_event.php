<html>
  <body>
    <form action="handle_event.php" method="post" target="result">
      <?php
        include "settings/general.php";
        echo "<select required name='universe'>";
        foreach (array_keys($UNIVERSES) as $u){
          echo "<option value='", $u, "'>", $u, "</option>";
        };
        echo "</select>";
      ?>
      <br>
      <input type="text" required maxlength="30" name="name">  Name</input>
      <br>
      <input type="text" required maxlength="15" name="date">  Date</input>
      <input type="text" required maxlength="15" name="location">  Location</input>
      <br>
      <p>Please ensure that you have read the <a href="formatting.html" target='result'>formatting instructions</a> before proceeding.</p>
      <input type="submit"></input>
  </body>
</html>
