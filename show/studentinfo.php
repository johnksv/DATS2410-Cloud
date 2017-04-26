<?php
require_once '../Connection.php';
$conn = Connection::connect();

$sql = "";
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
        <a href="../insert/student.php"><button>Create new entry</button></a>
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
                    <td><?php //echo $row['firstName'] ?></td>
                    <td><?php //echo $row['lastName'] ?></td>
                    <td><?php // echo $row['email'] ?></td>
                    <td><?php //echo $row['startYear'] ?></td>
                    <td><?php //echo $row['studentID'] ?></td>
                    <td>

                    </td>
                    <td>

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


