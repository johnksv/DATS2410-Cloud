<?php

require_once '../Connection.php';
$conn = Connection::connect();

$type = filter_input(INPUT_POST, "type");
if (strcmp($type, "elective") == 0) {
$sql = "DELETE FROM ElectiveCourse WHERE sPID='" . $_POST["id"] . "' and courseCode='" . $_POST["course"] . "'";
 if ($conn->query($sql) === TRUE) {
        Connection::disconnect();
        header('Location: studentprogramInfo.php');
    }
}
else if (strcmp($type, "mandatory") == 0) {
$sql = "DELETE FROM MandatoryCourse WHERE sPID='" . $_POST["id"] . "' and courseCode='" . $_POST["course"] . "'";
if ($conn->query($sql) === TRUE) {
        Connection::disconnect();
        header('Location: studentprogramInfo.php');
    }
}

Connection::disconnect();
header('Location: studyprogramInfo.php');

    echo "Error deleting record: " . $conn->error;

Connection::disconnect();
        