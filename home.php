<html>
  <head>
    <title>Flowcharthistory.com</title>
  </head>
  <body>
    <a href='request_graph.php'>Make a graph</a>
    <br>
    <!-- Herein describe this project and its reason for existence. -->
    <br>
    <?php
      include "globals.php";
      $con = connect();
      echo "<p>When you loaded this page, our database contained ";
      echo mysqli_fetch_array(mysqli_query($con, "SELECT Count(*) FROM Events"))[0], " events, ";
      echo mysqli_fetch_array(mysqli_query($con, "SELECT Count(*) FROM Effects"))[0], " cause-effect chains, and ";
      echo mysqli_fetch_array(mysqli_query($con, "SELECT Count(*) FROM Vessays"))[0] + mysqli_fetch_array(mysqli_query($con, "SELECT Count(*) FROM Fessays"))[0], " essays.</p>";
    ?>
    <a href='submit/submit_event.html' target='submit'>Submit an event</a> - 
    <a href='submit/submit_effect_c.php' target='submit'>Submit a cause-and-effect chain</a> - 
    <a href='get_essay/select_essay.php?m=v' target='submit'>Find an event</a> - 
    <a href='get_essay/select_essay.php?m=f' target='submit'>Find an effect</a>
    <table width="100%" height="90%">
      <tr>
        <td><iframe src="about:blank" name="submit" width="100%" height="100%"></iframe></td>
        <td><iframe src="about:blank" name="result" width="100%" height="100%"></iframe></td>
      </tr>
    </table>
  </body>
</html>
