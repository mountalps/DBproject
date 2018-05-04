<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create A Job</title>
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
            <a class="active" href="0_company-homepage.php">Home</a> |
            <a href="company_notifications.php">Notifications</a> |
            <a href="company_jobs.php">Your Jobs</a> |
            <a href="company_publish_jobs.php">Publish A Job</a> |
            <form action="company_search_result.php" method="get" id="keyword_search">
                <input type="text" placeholder="Search..." name="keyword">
                <button type="submit">search</button>
            </form>
          </div>
        </nav>
    </div>
    <div class="wrapper">
      <div class="database-connection">
        <?php
          // get the username of student
          $sid = $_SESSION['studentid'];
          $sid = 1;

          // database connection
          $servername = "localhost";
          $username = "root";
          $password = "root";
          $dbname = "PJ2database";
          $conn = new mysqli($servername, $username, $password, $dbname);
          if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
          }
        ?>
      </div>
      <div class="say-hello-company">
        <?php
        $cid = 1;
        $query = "SELECT cname FROM Company c WHERE c.cid =".$cid.";";
        $result = $conn->query($query);
        $cname = "";
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $cname = $row['cname'];
            }
        }
        // the rest of the text
        $hellostr = "Hello " . $cname . ",";
        echo "<h2>$hellostr</h2>";?>
      </div>
      <?php
        $hellostr = "You can create a new job now";
        echo "<p>$hellostr</p>";
      ?>
      <div class="create-job">
        <form class="create-job-form" action="create_job.php" method="post">
          <fieldset>
            <h2>Create a New Job</h2>
            <p>Required fields are followed by <strong><abbr title="required">*</abbr></strong>.</p>
            <p>
              <label for="company-name" style="font-weight:bold;">Company Name: <?php echo $cname; ?></label>
            </p>
            <p>
              <label for="job-title" style="font-weight:bold;">Job Title: </label>
              <input type="text" name="job-title" placeholder="Job Title" required>
            </p>
            <p>
              <label for="job-city" style="font-weight:bold;">Job City: </label>
              <input type="text" name="job-city" placeholder="Job City" required>
            </p>
            <p>
              <label for="job-state" style="font-weight:bold;">Job State: </label>
              <input type="text" name="job-state" placeholder="Job State" required>
            </p>
            <p>
              <label for="job-country" style="font-weight:bold;">Job Country: </label>
              <input type="text" name="job-country" placeholder="Job Country" required>
            </p>
            <p>
              <label for="job-salary" style="font-weight:bold;">Salary: </label>
              <input type="text" name="job-salary" placeholder="Salary" required>
            </p>
            <p>
              <label for="job-degree" style="font-weight:bold;">Prefered Degree: </label>
              <input type="text" name="job-degree" placeholder="e.g. MS/BS" required>
            </p>
            <p>
              <label for="job-major" style="font-weight:bold;">Prefered Major: </label>
              <input type="text" name="job-major" placeholder="e.g. Computer Science" required>
            </p>
            <p>
              <label for="job-description" style="font-weight:bold;">Job Description: <br></label>
              <textarea name="job-description" rows="8" cols="50" required></textarea>
            </p>
            <p>
              <input type="submit" name="submit-creat-job" value="Create Job">
            </p>
          </fieldset>
        </form>
      </div>
    </div>
</body>
</html>
