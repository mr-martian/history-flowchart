<html>
  <body>
    <form action="handle_event.php" method="post">
      <?php
        include "universe_list.php";
        echo "<select required>";
        foreach ($UNIVERSES as $u){
          echo "<option value='", $u[0], "'>", $u[0], "</option>";
        };
        echo "</select>";
      ?>
      <br>
      <input type="text" required maxlength="30">  Name</input>
      <br>
      <input type="number" required>  Level</input>
      <br>
      <input type="text" required maxlength="15">  Date</input>
      <input type="text" required>  Location</input>
      <br>
      <p>Please ensure that you have read the <a href="formatting.html">formatting instructions</a> before proceeding.</p>
      <textarea rows="100" cols="80" required>Please herein describe the event and its importance.</textarea>
      <textarea rows="15" cols="80" required>Sources go here! MLA please, we recommend easybib.com if you don't know how to do that.</textarea>
      <input type="submit"></input>
  </body>
</html>
