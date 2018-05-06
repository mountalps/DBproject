<?php
include_once '../lib/fun.php';
include_once '../lib/dbinfo.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Applied Jobs</title>
    <style>
        form {display: inline-block;}
        nav {background-color: #EEE}
        .wrapper {padding: 0 60px 0 60px;}
    </style>
</head>
<body>
    <div class="navivation">
      <nav>
        <div class="wrapper">
          <a class="active" href="0_student-homepage.php">Home</a> |
          <a href="student_notifications.php">Notifications</a> |
          <a href="student_friends_page.php">Friends</a> |
          <a href="student_followed_companies.php">Followed Companies</a> |
          <a href="student_applied_jobs.php">Applied Jobs</a> |
          <form action="student_search_result.php" method="get" id="keyword_search">
              <input type="text" placeholder="Search..." name="keyword">
              <button type="submit">search</button>
          </form>
          </div>
      </nav>
    </div>
    <div class="wrapper">
      <div>
      <?php
      // get the sid from signin page
      $sid = $_SESSION['studentid'];
      $sid = 4;

      // database connection
      session_start();
      $username = $_SESSION['user'];
      $conn = new mysqli($DBhost, $DBuser, $DBpassword, $DBdatabase, $port);
      if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
      }
      $query = "SELECT sname FROM Student s WHERE s.sid = 1";
      $result = $conn->query($query);
      $sname = "";
      if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
              $sname = $row['sname'];
          }
      }

      // the rest of the text
      $hellostr = "Hello " . $sname . ",";
      echo "<h2>$hellostr</h2>";
      ?>
      </div>
      <div class="all-jobs">
          <h4>Applied Jobs:</h4>
      <?php
      $query = "
      select j.title, j.jcity, j.jstate, j.jcountry, c.cname, a.atime from Application a, Company c, Job j where a.tocid=c.cid and a.fromsid = ".$sid." and a.jid=j.jid;";
      $result = $conn->query($query);
      if ($result->num_rows > 0) {
        echo "<p>Here are your applied jobs:</p>";
          while ($row = $result->fetch_assoc()) {
            echo "<div class='applied-job'><p>";
            echo $row['title'];
            echo " in ".$row['jcity'].", ".$row['jstate'].", ".$row['jcountry'];
            echo "on ".$row['atime'];
            echo "</p></div>";
          }
      } else {
        echo "<p>You don't have any friends yet.</p>";
      }
      $conn->close();
      ?>
      </div>
    </div>
</body>
</html>
