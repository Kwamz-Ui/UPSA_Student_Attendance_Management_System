<?php
    
    include '../database/dbconnect.php';
    include 'header.php';

    if (!isset($_SESSION['id'])) {
        header('location:index.php');
    }

    $lid = $_SESSION['id'];
    $level = isset($_GET['level']) ? $_GET['level'] : '';
    $cid = isset($_GET['cid']) ? $_GET['cid'] : '';
    $gid = isset($_GET['gid']) ? $_GET['gid'] : '';
    $pid = isset($_GET['pid']) ? $_GET['pid'] : '';

    $grp = mysqli_query($connect, "SELECT * FROM grouping WHERE gid = '$gid'");
    $grpRes = mysqli_fetch_array($grp);
    $gname = $grpRes['name'];

    $attendanceSQL = "SELECT * FROM attendclass ac
    JOIN student s ON ac.sid = s.sid
    JOIN course c ON ac.cid = c.cid
    WHERE ac.lid = '$lid' AND c.cid = '$cid' AND c.pid = '$pid' AND s.level = '$level' AND s.gid = '$gid' AND c.gid = '$gid'";
    $attendanceQuery = mysqli_query($connect, $attendanceSQL);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>UPSA - STUDENT ATTENDANCE SYSTEM</title>
</head>
<body>

    <div id="attendancetable">
        <div class="fortable">
            <h3>All Attendance</h3>
            <table>
                <thead>
                    <tr>
                        <th>S/n</th>
                        <th>Course Code</th>
                        <th>Course Name</th>
                        <th>Student ID</th>
                        <th>Student Name</th>
                        <th>Group</th>
                        <th>Date</th>
                        <th>Time</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    if (mysqli_num_rows($attendanceQuery) > 0) {
                        $i = 1;
                        while ($row = mysqli_fetch_array($attendanceQuery)) {
                            $sid = $row['sid'];
                            $fname = $row['firstname'];
                            $lname = $row['lastname'];
                            $cid = $row['cid'];
                            $code = $row['code'];
                            $cname = $row['name'];
                            $date = $row['attend_date'];
                            $time = $row['attend_time']; ?>
                    <tr>
                        <td><?php echo $i;?></td>
                        <td><?php echo $code;?></td>
                        <td><?php echo $cname;?></td>
                        <td><?php echo $sid;?></td>
                        <td><?php echo $fname." ".$lname;?></td>
                        <td><?php echo $gname;?></td>
                        <td><?php echo $date;?></td>
                        <td><?php echo $time;?></td>
                    </tr>
                <?php  $i++; }
                    }
                ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>