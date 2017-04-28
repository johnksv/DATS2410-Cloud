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
        <h3><?php echo $_GET["id"]; ?> - Elective and mandatory courses</h3>
    </div>

    <form action="../insert/programcourses.php" method="post">
        <input type="hidden" name="id" value="<?php echo $_GET["id"] ?>">
        <input type="submit" value="Add new course"><br>
    </form>

    <div>
        <table>
            <thead>
            <tr>
                <th> Course Code</th>
                <th> Standard Semester</th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php while ($row = $result1->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['courseCode'] ?></td>
                    <td><?php echo $row['standardSemester'] ?></td>
                    <td>Elective</td>
                    <td>
                        <form action="delete.php" method="post">
                            <input type="hidden" name="id" value="<?php echo $row['sPID'] ?>">
                            <input type="hidden" name="course" value="<?php echo $row['courseCode'] ?>">
                            <input type="hidden" name="type" value="elective">
                            <input type="submit" name="Delete" value="Delete"><br>

                        </form>
                    </td>


                </tr>
            <?php }
            while ($row = $result2->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['courseCode'] ?></td>
                    <td><?php echo $row['standardSemester'] ?></td>
                    <td>Mandatory</td>

                    <td>
                        <form action="delete.php" method="post">
                            <input type="hidden" name="id" value="<?php echo $row['sPID'] ?>">
                            <input type="hidden" name="course" value="<?php echo $row['courseCode'] ?>">
                            <input type="hidden" name="type" value="mandatory">
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