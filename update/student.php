<?php
ini_set('error_reporting', E_ALL);
require '../Connection.php';
$fname = null;
$lname = null;
$email = null;
$year = null;
$conn = Connection::connect();

if (!empty($_POST["update"])) {

    $sql = "UPDATE Student SET email='" . $_POST["email"] .
        "', startYear='" . $_POST['startYear'] .
        "', firstName='" . $_POST['firstName'] .
        "', lastName='" . $_POST['lastName'] .
        "' WHERE studentId='" . $_POST["foo"] .
        "'";

    $result = $conn->query($sql);
    Connection::disconnect();
    header("Location: ../show/student.php");
}
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

<?php
//If the request is from another webpage
if (empty($_POST["studentID"])) {
    //If direct access, redirect
    header("Location: ../show/student.php");
} else { ?>
    <b>Updating student: <?php echo $_POST["studentID"] ?> </b><br>
    <?php
    $sql = 'SELECT * FROM Student WHERE studentID="' . $_POST["studentID"] . '"';
    $result = $conn->query($sql);
    Connection::disconnect();

    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $fname = $row['firstName'];
            $lname = $row['lastName'];
            $email = $row['email'];
            $year = $row['startYear'];
        }
    } else {
        echo "No such user!";
    }
}
?>
<form action="student.php" method="post">
    First Name: <input type="text" name="firstName" value="<?php echo $fname; ?>"><br>
    Last Name: <input type="text" name="lastName" value="<?php echo $lname; ?>"><br>
    E-mail: <input type="text" name="email" value="<?php echo $email; ?>"><br>

    Start Year: <input name="startYear" type="date" value="<?php echo $year; ?>"><br>
    <br>
    <input type="hidden" name="foo" value="<?php echo $_POST["studentID"]; ?>"/>
    <input type="submit" name="update" Value="Update">
</form>

</body>
</html>