<?php

require_once '../phpcode/Connection.php';
$conn = Connection::connect();

$type = filter_input(INPUT_POST, "type");
if (strcmp($type, "student")) {
    $sql = "DELETE FROM Student WHERE studentID='" . $_POST["id"] . "' ";
    if ($conn->query($sql) === TRUE) {
        Connection::disconnect();
        header('Location: student.php');
    }
} else if (strcmp($tp, "course")) {
    $sql = "DELETE FROM Course WHERE courseCode='" . $_POST["id"] . "' ";
    if ($conn->query($sql) === TRUE) {
        Connection::disconnect();
        header('Location: course.php');
    }
}

echo "Error deleting record: " . $conn->error;

Connection::disconnect();


