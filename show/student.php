<?php
require_once '../Connection.php';
$conn = (new Connection())->connect();

$sql = "SELECT * FROM Student";
$result = $conn->query($sql);
$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <?php readfile("../htmlTemplate/head.html"); ?>
</head>
<body>

<?php
//Insert header
include_once '../html/header.php';
?>

<main>
    <div>
        <h3>Students</h3>
        <a href="../insert/student.php">
            <button>Create new entry</button>
        </a>
    </div>

    <div>
        <table>
            <thead>
            <tr>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>Email</th>
                <th>StartYear</th>
                <th>StudentID</th>
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

                        <form action="studentinfo.php" method="get">
                            <input type="hidden" name="id" value="<?php echo $row['studentID'] ?>">
                            <input type="submit" value="Show Info"><br>

                        </form>

                        <form action="../update/student.php" method="post">
                            <input type="hidden" name="studentID" value="<?php echo $row['studentID'] ?>">
                            <input type="submit" name="Change" value="Edit"><br>

                        </form>

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


</body>
</html>


