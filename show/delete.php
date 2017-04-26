<?php

require_once '../Connection.php';
$conn = Connection::connect();

$type = filter_input(INPUT_POST, "type");
$id = filter_input(INPUT_POST, "id");
$course = filter_input(INPUT_POST, "course");

if (strcmp($type, "student") == 0) {
    $sql = "DELETE FROM Student WHERE studentID='$id' ";
    if ($conn->query($sql) === TRUE) {
        Connection::disconnect();
        header('Location: student.php');
    }
} else if (strcmp($type, "course") == 0) {
    $sql = "DELETE FROM Course WHERE courseCode='$id' ";
    if ($conn->query($sql) === TRUE) {
        Connection::disconnect();
        header('Location: course.php');
    }
} else if (strcmp($type, "studyprogram") == 0) {
    $sql = "DELETE FROM StudyProgram WHERE sPID='$id' ";
    if ($conn->query($sql) === TRUE) {
        Connection::disconnect();
        header('Location: studyprogram.php');
    }
} else if (strcmp($type, "elective") == 0) {
    $sql = "DELETE FROM ElectiveCourse WHERE sPID='$id' AND courseCode='$course'";
    if ($conn->query($sql) === TRUE) {
        Connection::disconnect();
        header("Location: studyprograminfo.php?id=$id");
    }
} else if (strcmp($type, "mandatory") == 0) {
    $sql = "DELETE FROM MandatoryCourse WHERE sPID='$id' AND courseCode='$course'";
    if ($conn->query($sql) === TRUE) {
        Connection::disconnect();
        header("Location: studyprograminfo.php?id=$id");
    }
}
echo "Error deleting record: " . $conn->error;

Connection::disconnect();


