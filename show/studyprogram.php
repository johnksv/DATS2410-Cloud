<?php
require_once '../Connection.php';
$conn = Connection::connect();

$sql = "SELECT * FROM StudyProgram";
$result = $conn->query($sql);
Connection::disconnect();
?>
<!DOCTYPE html>
<html>
<head>
    <?php readfile("../htmlTemplate/head.html");  ?>
</head>
<body>

<?php
//Insert header
readfile("../htmlTemplate/header.html");
?>

<main>
    <div>
        <h3>Studyprograms</h3>
        <a href="../insert/studyprogram.php"><button>Create new entry</button></a>
    </div>

    <div>
        <table>
            <thead>
            <tr>
                <th>Program ID</th>
                <th>Program Name</th>
                <th>Semester Duration</th>
                <th>Start Year</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['sPID'] ?></td>
                    <td><?php echo $row['sPName'] ?></td>
                    <td><?php echo $row['durationSemester'] ?></td>
                    <td><?php echo $row['startYear'] ?></td>
                    <td>
                        <form action="studyprograminfo.php" method="get">
                            <input type="hidden" name="id" value="<?php echo $row['sPID'] ?>">
                            <input type="submit" value="Show courses"><br>

                        </form>

                        <form action="../update/studyprogram.php" method="post">
                            <input type="hidden" name="sPID" value="<?php echo $row['sPID'] ?>">
                            <input type="submit" name="Change" value="Edit"><br>

                        </form>

                        <form action="delete.php" method="post">
                            <input type="hidden" name="id" value="<?php echo $row['sPID'] ?>">
                            <input type="hidden" name="type" value="studyprogram">
                            <input type="submit" name="Delete" value="Delete"><br>

                        </form>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</main>

<?php include '../htmlTemplate/footer.php'; ?>
</body>
</html>

