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


            <div class="row table-header">

                <div>Study Program ID</div>
                <div>Study Program Name</div>
                <div>Semester Duration</div>
                <div>Start Year</div>
            </div>


            <?php while ($row = $result->fetch_assoc()) { ?>
                <div class="row">
                    <div><?php echo $row['sPID'] ?></div>
                    <div><?php echo $row['sPName'] ?></div>
                    <div><?php echo $row['durationSemester'] ?></div>
                    <div><?php echo $row['startYear'] ?></div>
                    <div>
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
                    </div>
                </div>
            <?php } ?>

    </div>
</main>

<?php include '../htmlTemplate/footer.php'; ?>
</body>
</html>

