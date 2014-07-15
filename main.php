<html>
  <head>
    <title>Flowcharthistory.com</title>
  </head>
  <body>
    <a href='get_graph/request_graph.php'>Make a graph</a>
    <!-- Herein describe this project and its reason for existence. -->
    <?php
      include "settings/general.php";
      $con = $connect();
      echo "<p>When you loaded this page, our database contained ";
      echo mysqli_fetch_array(mysqli_query($con, "SELECT Count(*) FROM Events"))[0], " events in ";
      echo mysqli_fetch_array(mysqli_query($con, "SELECT Count(Distinct Universe) FROM Events"))[0], " universes, ";
      echo mysqli_fetch_array(mysqli_query($con, "SELECT Count(*) FROM Effects"))[0], " cause-effect chains, and ";
      echo mysqli_fetch_array(mysqli_query($con, "SELECT Count(*) FROM Vessays"))[0] + mysqli_fetch_array(mysqli_query($con, "SELECT Count(*) FROM Vessays"))[0], " essays.</p>";
    ?>
    <a href='submit/submit_event.php' target='submit'>Submit an event</a>
    <a href='submit/submit_effect.php' target='submit'>Submit a cause-and-effect chain</a>
    <table>
      <tr>
        <td><iframe src="about:blank" id="submit"></iframe></td>
        <td><iframe src="about:blank" id="result"></iframe></td>
      </tr>
    </table>
  </body>
</html>
