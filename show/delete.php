<?php

require_once '../phpcode/Connection.php';
$conn = Connection::connect();

$type = filter_input(INPUT_POST, "type");
if (strcmp($type, "student") == 0) {
    $sql = "DELETE FROM Student WHERE studentID='" . $_POST["id"] . "' ";
    if ($conn->query($sql) === TRUE) {
        Connection::disconnect();
        header('Location: student.php');
    }
} else if (strcmp($type, "course") == 0) {
    $sql = "DELETE FROM Course WHERE courseCode='" . $_POST["id"] . "' ";
    if ($conn->query($sql) === TRUE) {
        Connection::disconnect();
        header('Location: course.php');
    }
    
}


echo "Error deleting record: " . $conn->error;

Connection::disconnect();


