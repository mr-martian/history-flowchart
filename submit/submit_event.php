<html>
  <body>
    <form action="handle_event.php" method="post" target="_blank">
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
      <p>Please ensure that you have read the <a href="formatting.html">formatting instructions</a> before proceeding.</p>
      <textarea rows="100" cols="80" required name="essay">Please herein describe the event and its importance.</textarea>
      <textarea rows="15" cols="80" required name="sources">Sources go here! MLA please, we recommend easybib.com if you don't know how to do that.</textarea>
      <input type="submit"></input>
  </body>
</html>
