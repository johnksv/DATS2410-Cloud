<?php

require_once '../connection.php';
$conn = connection::connect();

$type = filter_input(INPUT_POST, "type");
if (strcmp($type, "student") == 0) {
    $sql = "DELETE FROM Student WHERE studentID='" . $_POST["id"] . "' ";
    if ($conn->query($sql) === TRUE) {
        connection::disconnect();
        header('Location: student.php');
    }
} else if (strcmp($type, "course") == 0) {
    $sql = "DELETE FROM Course WHERE courseCode='" . $_POST["id"] . "' ";
    if ($conn->query($sql) === TRUE) {
        connection::disconnect();
        header('Location: course.php');
    }
    
}
<<<<<<< HEAD

=======
else if (strcmp($type, "electivecourse") == 0) {
    $sql = "DELETE FROM Course WHERE sPID='" . $_POST["id"] . "' ";
    if ($conn->query($sql) === TRUE) {
        connection::disconnect();
        header('Location: electivecourse.php');
    }
    
}
>>>>>>> 602d25ab87a23ca757913923db4a4cfe304bebda

echo "Error deleting record: " . $conn->error;

connection::disconnect();


