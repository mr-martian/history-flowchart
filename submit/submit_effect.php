<html>
  <body>
    <form action="handle_effect.php" method="post" target="_blank">
      <?php
        include "universe_list.php";
        echo "<select required name='universe'>";
        foreach ($UNIVERSES as $u){
          echo "<option value='", $u[0], "'>", $u[0], "</option>";
        };
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
      <textarea rows="100" cols="80" required name="essay">Please herein describe the details of how From caused To.</textarea>
      <textarea rows="15" cols="80" required name="sources">Sources go here! MLA please, we recommend easybib.com if you don't know how to do that.</textarea>
      <input type="submit"></input>
  </body>
</html>
