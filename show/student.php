<?php
require_once '../Connection.php';
$conn = Connection::connect();

$sql = "SELECT * FROM Student";
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
        <h3>Students</h3>
        <a href="../insert/student.php">
            <button>Create new entry</button>
        </a>
    </div>

    <div class="table">
        <div class="row table-header">
            <div>Firstname</div>
            <div>Lastname</div>
            <div>Email</div>
            <div>StartYear</div>
            <div>StudentID</div>
        </div>

        <?php while ($row = $result->fetch_assoc()) { ?>
            <div class="row">
                <div><?php echo $row['firstName'] ?></div>
                <div><?php echo $row['lastName'] ?></div>
                <div><?php echo $row['email'] ?></div>
                <div><?php echo $row['startYear'] ?></div>
                <div><?php echo $row['studentID'] ?></div>
                <div>
                    <form action="../update/student.php" method="post">
                        <input type="hidden" name="studentID" value="<?php echo $row['studentID'] ?>">
                        <input type="submit" name="Change" value="Edit"><br>

                    </form>

                    <form action="delete.php" method="post">
                        <input type="hidden" name="id" value="<?php echo $row['studentID'] ?>">
                        <input type="hidden" name="type" value="student">
                        <input type="submit" name="Delete" value="Delete"><br>

                    </form>

                    <form action="studentinfo.php" method="get">
                        <input type="hidden" name="id" value="<?php echo $row['studentID'] ?>">
                        <input type="hidden" name="type" value="student">
                        <input type="submit" value="Show Info"><br>

                    </form>
                </div>
            </div>
        <?php } ?>
    </div>
</main>

<?php include '../htmlTemplate/footer.php'; ?>
</body>
</html>


