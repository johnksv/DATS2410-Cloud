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
    <?php readfile("../htmlTemplate/head.html");  ?>
</head>
<body>

<?php
//Insert header
readfile("../htmlTemplate/header.html");
?>

<main class="container">
    <div class="row">
        <h3>Students</h3>
        <button><a href="../insert/student.php">Create new entry</a></button>
    </div>

    <div class="row">
        <table class="table table-striped table-bordered">
            <thead>
            <tr>

                <th>Firstname</th>
                <th>Lastname</th>
                <th>Email</th>
                <th>StartYear</th>
                <th>StudentID</th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['firstName'] ?></td>
                    <td><?php echo $row['lastName'] ?></td>
                    <td><?php echo $row['email'] ?></td>
                    <td><?php echo $row['startYear'] ?></td>
                    <td><?php echo $row['studentID'] ?></td>
                    <td>
                        <form action="../update/student.php" method="post">
                            <input type="hidden" name="studentID" value="<?php echo $row['studentID'] ?>">
                            <input type="submit" name="Change" value="Edit"><br>

                        </form>
                    </td>
                    <td>
                        <form action="delete.php" method="post">
                            <input type="hidden" name="id" value="<?php echo $row['studentID'] ?>">
                            <input type="hidden" name="type" value="student">
                            <input type="submit" name="Delete" value="Delete"><br>

                        </form>
                    </td>
                    <td>
                        <form action="delete.php" method="post">
                            <input type="hidden" name="id" value="<?php echo $row['studentID'] ?>">
                            <input type="hidden" name="type" value="student">
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


