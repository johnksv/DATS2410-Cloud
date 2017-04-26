<?php

require_once '../Connection.php';
$conn = Connection::connect();
$sql = "DELETE FROM ElectiveCourse WHERE sPID='" . $_POST["id"] . "' and courseCode='" . $_POST["course"] . "'";
    if ($conn->query($sql) === TRUE) {
        Connection::disconnect();
        header('Location: studyprogramInfo.php');

    }
$sql = "DELETE FROM MandatoryCourse WHERE sPID='" . $_POST["id"] . "' and courseCode='" . $_POST["course"] . "'";
if ($conn->query($sql) === TRUE) {
        Connection::disconnect();
        header('Location: studyprogramInfo.php');

    }

    echo "Error deleting record: " . $conn->error;

Connection::disconnect();
        