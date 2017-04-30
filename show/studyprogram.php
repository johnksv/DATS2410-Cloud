<?php
require_once '../Connection.php';
$conn = (new Connection())->connect();

$sql = "SELECT * FROM StudyProgram";
$result = $conn->query($sql);

$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <?php readfile("../html/head.html"); ?>
</head>
<body>

<?php
//Insert header
include_once '../html/header.php';
?>

<main>
    <div class="innerMain">
        <div>
            <h2>Programs</h2>
            <a href="../insert/studyprogram.php">
                <button>Create new entry</button>
            </a>
        </div>

        <div>
            <table>
                <thead>
                <tr>
                    <th>Program ID</th>
                    <th>Program Name</th>
                    <th>Semester Duration</th>
                    <th>Start Year</th>
                    <th>Number of students</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php
                $conn = (new Connection())->connect();
                while ($row = $result->fetch_assoc()) {
                    $sPID = $row['sPID'];
                    $sql = "SELECT COUNT(*) AS 'count' FROM student_has_studyprogram WHERE sPID='$sPID'";
                    $count = $conn->query($sql)->fetch_assoc();
                    ?>
                    <tr>
                        <td><?php echo $sPID ?></td>
                        <td><?php echo $row['sPName'] ?></td>
                        <td><?php echo $row['durationSemester'] ?></td>
                        <td><?php echo $row['startYear'] ?></td>
                        <td><?php echo $count['count']; ?></td>
                        <td>
                            <form action="studyprograminfo.php" method="get">
                                <input type="hidden" name="id" value="<?php echo $row['sPID'] ?>">
                                <input type="submit" value="Show courses"><br>

                            </form>

                            <form action="delete.php" method="post">
                                <input type="hidden" name="id" value="<?php echo $row['sPID'] ?>">
                                <input type="hidden" name="type" value="studyprogram">
                                <input type="submit" name="Delete" value="Delete"><br>

                            </form>
                        </td>
                    </tr>
                <?php }
                $conn->close(); ?>
                </tbody>
            </table>
        </div>
    </div>
</main>


</body>
</html>

