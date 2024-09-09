<?php
    
    include '../database/dbconnect.php';
    include 'header.php';

    if (!isset($_SESSION['id'])) {
        header('location:index.php');
    }

    $lid = $_SESSION['id'];

    $courseSQL = "SELECT * FROM course WHERE lid = '$lid'";
    $courseQuery = mysqli_query($connect, $courseSQL);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>UPSA - STUDENT ATTENDANCE SYSTEM</title>
</head>
<body>

    <div id="attendance">
        <div class="course">
        <?php
            if (mysqli_num_rows($courseQuery) > 0) {
                while ($courseRow = mysqli_fetch_array($courseQuery)) {
                    $id = $courseRow['cid'];
                    $cname = $courseRow['name'];
                    $pid = $courseRow['pid'];
                    $gid = $courseRow['gid'];
                    $level = $courseRow['level'];

                    $proQuery = mysqli_query($connect, "SELECT * FROM program WHERE pid = '$pid'");
                    $prow = mysqli_fetch_array($proQuery);
                    $pname = $prow['name'];

                    $grpQuery = mysqli_query($connect, "SELECT * FROM grouping WHERE gid = '$gid'");
                    $grprow = mysqli_fetch_array($grpQuery);
                    $gname = $grprow['name']; ?>
            <div class="box">
                <a href="attendancetable.php?cid=<?php echo $id;?>&level=<?php echo $level;?>&gid=<?php echo $gid;?>&pid=<?php echo $pid;?>">
                    <h3><?php echo $cname; ?></h3>
                    <h4><?php echo $pname; ?></h4>
                    <p><?php echo "level ".$level."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$gname; ?></p>
                </a>
            </div>
        <?php   }
            }
        ?>
        </div>
    </div>

</body>
</html>
