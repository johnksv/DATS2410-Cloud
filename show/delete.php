<?php

require_once '../Connection.php';
$conn = (new Connection())->connect();

$type = filter_input(INPUT_POST, "type");
$id = filter_input(INPUT_POST, "id");
$course = filter_input(INPUT_POST, "course");

echo "<h1>Deleting course from database</h1>";

if (strcmp($type, "student") == 0) {
    $sql = "DELETE FROM Student WHERE studentID='$id' ";
    if ($conn->query($sql) === TRUE) {
        $conn->close();
        header("Refresh: 1;URL=student.php");
    }
} else if (strcmp($type, "course") == 0) {
    $sql = "DELETE FROM Course WHERE courseCode='$id' ";
    if ($conn->query($sql) === TRUE) {
        $conn->close();
        header("Refresh: 1;URL=course.php");
    }
} else if (strcmp($type, "studyprogram") == 0) {
    $sql = "DELETE FROM StudyProgram WHERE sPID='$id' ";
    if ($conn->query($sql) === TRUE) {
        $conn->close();
        header("Refresh: 1;URL=studyprogram.php");
    }
} else if (strcmp($type, "elective") == 0) {
    $sql = "DELETE FROM ElectiveCourse WHERE sPID='$id' AND courseCode='$course'";
    if ($conn->query($sql) === TRUE) {
        $conn->close();
        header("Refresh: 1;URL=studyprograminfo.php?id=$course");
    }
} else if (strcmp($type, "mandatory") == 0) {
    $sql = "DELETE FROM MandatoryCourse WHERE sPID='$id' AND courseCode='$course'";
    if ($conn->query($sql) === TRUE) {
        $conn->close();
        header("Refresh: 1;URL=studyprograminfo.php?id=$course");
    }
}else{
    echo "Error deleting record: " . $conn->error;
}
$conn->close();


