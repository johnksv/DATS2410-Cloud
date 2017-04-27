<?php
require_once '../Connection.php';
$conn = Connection::connect();

$sql = "SELECT *  FROM ElectiveCourse WHERE sPID='" . $_GET["id"] . "' ";

$result1 = $conn->query($sql);
$sql = "SELECT *  FROM MandatoryCourse WHERE sPID='" . $_GET["id"] . "' ";

$result2 = $conn->query($sql);
Connection::disconnect();
?>
<html>
<head>
    <?php readfile("../htmlTemplate/head.html"); ?>
</head>
<body>

<?php
//Insert header
readfile("../htmlTemplate/header.html");
?>


<main class="container">
    <div class="row">
        <h3>Elective and mandatory courses</h3>
    </div>

    <div class="table">
        <div class="row table-header">
            <div>Student Program ID</div>
            <div>Course Code</div>
            <div>Standard Semester</div>
        </div>

        <form action="../insert/programcourses.php" method="post">
            <input type="hidden" name="id" value="<?php echo $_GET["id"] ?>">
            <input type="submit" value="ADD"><br>
        </form>

        <?php while ($row = $result1->fetch_assoc()) { ?>
            <div class="row">
                <div><?php echo $row['sPID'] ?></div>
                <div><?php echo $row['courseCode'] ?></div>
                <div><?php echo $row['standardSemester'] ?></div>
                <div>Elective</div>
                <div>
                    <form action="delete.php" method="post">
                        <input type="hidden" name="id" value="<?php echo $row['sPID'] ?>">
                        <input type="hidden" name="course" value="<?php echo $row['courseCode'] ?>">
                        <input type="hidden" name="type" value="elective">
                        <input type="submit" name="Delete" value="Delete"><br>

                    </form>
                </div>
            </div>
        <?php }
        while ($row = $result2->fetch_assoc()) { ?>
            <div class="row">
                <div><?php echo $row['sPID'] ?></div>
                <div><?php echo $row['courseCode'] ?></div>
                <div><?php echo $row['standardSemester'] ?></div>
                <div>Mandatory</div>

                <div>
                    <form action="delete.php" method="post">
                        <input type="hidden" name="id" value="<?php echo $row['sPID'] ?>">
                        <input type="hidden" name="course" value="<?php echo $row['courseCode'] ?>">
                        <input type="hidden" name="type" value="mandatory">
                        <input type="submit" name="Delete" value="Delete"><br>

                    </form>
                </div>
            </div>
        <?php } ?>
    </div>


</main>

<?php include '../htmlTemplate/footer.php'; ?>
</body>
</html>