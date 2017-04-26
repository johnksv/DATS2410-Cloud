<?php
require_once '../Connection.php';
$conn = Connection::connect();

$sql = "SELECT * FROM StudyProgram";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>HiOA student information system</title>
</head>
<body>

<?php
//Insert header
readfile("../htmlTemplate/header.html");
?>

<div class="container">
    <div class="row">
        <h3>Studyprograms</h3>
        <button><a href="../insert/studyprogram.php">Create new entry</a></button>
    </div>

    <div class="row">
        <table class="table table-striped table-bordered">
            <thead>
            <tr>

                <th>sPID</th>
                <th>sPName</th>
                <th>durationSemester</th>
                <th>startYear</th>
                <th></th>
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
                        <form action="studyprogramEM.php" method="post">
                            <input type="hidden" name="sPID" value="<?php echo $row['sPID'] ?>">
                            <input type="submit" name="Show" value="Show courses"><br>

                        </form>
                        <form action="../update/studyprogram.php" method="post">
                            <input type="hidden" name="sPID" value="<?php echo $row['sPID'] ?>">
                            <input type="submit" name="Change" value="Edit"><br>

                        </form>
                    </td>
                    <td>
                        <form action="delete.php" method="post">
                            <input type="hidden" name="id" value="<?php echo $row['sPID'] ?>">
                            <input type="hidden" name="type" value="studyprogram">
                            <input type="submit" name="Delete" value="Delete"><br>

                        </form>
                    </td>
                </tr>
            <?php }
            $conn->close();
            ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>

