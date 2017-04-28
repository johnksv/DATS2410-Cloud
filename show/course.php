<?php
require_once '../Connection.php';
$conn = Connection::connect();

$sql = "SELECT * FROM Course";
$result = $conn->query($sql);
Connection::disconnect();
?>
<!DOCTYPE html>
<html>
<head>
    <?php readfile("../htmlTemplate/head.html"); ?>
</head>
<body>

<?php
//Insert header
readfile("../htmlTemplate/header.html");
?>
<main>
    <div>
        <h3>Courses</h3>
        <a href="../insert/course.php">
            <button>Create new entry</button>
        </a>
    </div>

    <div>
        <table>
            <thead>
            <tr>

                <th>Course code</th>
                <th>Course title</th>
                <th>Semester</th>
            </tr>
            </thead>
            <tbody>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['courseCode'] ?></td>
                    <td><?php echo $row['courseTitle'] ?></td>
                    <td><?php echo $row['semester'] ?></td>
                    <td>

                        <form action="courseinfo.php" method="get">
                            <input type="hidden" name="id" value="<?php echo $row['courseCode'] ?>">
                            <input type="submit" value="More info"><br>

                        </form>

                        <form action="../update/course.php" method="post">
                            <input type="hidden" name="courseCode" value="<?php echo $row['courseCode'] ?>">
                            <input type="submit" name="Change" value="Edit"><br>

                        </form>

                        <form action="delete.php" method="post">
                            <input type="hidden" name="id" value="<?php echo $row['courseCode'] ?>">
                            <input type="hidden" name="type" value="course">
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


