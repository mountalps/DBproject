<?php
include_once '../lib/fun.php';
include_once '../lib/dbinfo.php';
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title></title>
        <?php
            $jid = $_POST['jid'];
            $sid = $_POST['sid'];
            $cid = $_POST['cid'];
            session_start();
            $username = $_SESSION['user'];
            $conn = new mysqli($DBhost, $DBuser, $DBpassword, $DBdatabase, $port);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            $conn->query("insert into Application values(now(), {$sid}, {$cid}, {$jid});");
            header("Location: student_applied_jobs.php");
            exit;
        ?>
    </head>
    <body>
    </body>
</html>