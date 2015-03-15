<html>
  <head>
    <title>Flowcharthistory.com</title>
  </head>
  <body>
    <?php
      include "globals.php";
      $con = connect();
      echo "<p>When you loaded this page, our database contained ";
      echo mysqli_fetch_array(mysqli_query($con, "SELECT Count(*) FROM Events"))[0], " events, ";
      echo mysqli_fetch_array(mysqli_query($con, "SELECT Count(*) FROM Effects"))[0], " cause-effect chains, and ";
      echo mysqli_fetch_array(mysqli_query($con, "SELECT Count(*) FROM Vessays"))[0] + mysqli_fetch_array(mysqli_query($con, "SELECT Count(*) FROM Fessays"))[0], " essays.</p>";
    ?>
    <a href='request_graph.php' target='_blank'>Make a graph</a>
    <a href='submit/submit_event.html' target='submit'>Submit an event</a> - 
    <a href='submit/submit_effect_c.php' target='submit'>Submit an effect</a> - 
    <a href='get_essay/select_essay.php?m=v' target='submit'>Find an event</a> - 
    <a href='get_essay/select_essay.php?m=f' target='submit'>Find an effect</a>
    <a href='https://flowcharthistory.wordpress.com/2014/07/09/6/' target='_blank'>About</a>
    <table width="100%" height="90%">
      <tr>
        <td><iframe src="about:blank" name="submit" width="100%" height="100%"></iframe></td>
        <td><iframe src="about:blank" name="result" width="100%" height="100%"></iframe></td>
      </tr>
    </table>
  </body>
</html>
