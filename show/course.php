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


        <div class="table">
            <div class="row table-header">
                <div>Course code</div>
                <div>Course title</div>
                <div>Semester</div>
            </div>

            <?php while ($row = $result->fetch_assoc()) { ?>
                <div class="row">
                    <div><?php echo $row['courseCode'] ?></div>
                    <div><?php echo $row['courseTitle'] ?></div>
                    <div><?php echo $row['semester'] ?></div>
                    <div>
                        <form action="../update/course.php" method="post">
                            <input type="hidden" name="courseCode" value="<?php echo $row['courseCode'] ?>">
                            <input type="submit" name="Change" value="Edit"><br>

                        </form>

                        <form action="delete.php" method="post">
                            <input type="hidden" name="id" value="<?php echo $row['courseCode'] ?>">
                            <input type="hidden" name="type" value="course">
                            <input type="submit" name="Delete" value="Delete"><br>

                        </form>
                        <form action="courseinfo.php" method="get">
                            <input type="hidden" name="id" value="<?php echo $row['courseCode'] ?>">
                            <input type="submit" value="More info"><br>

                        </form>
                    </div>
                </div>
            <?php } ?>

        </div>
</main>

<?php include '../htmlTemplate/footer.php'; ?>
</body>
</html>


