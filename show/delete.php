<?php

require_once '../Connection.php';
$conn = (new Connection())->connect();

$type = filter_input(INPUT_POST, "type");
$id = filter_input(INPUT_POST, "id");
$course = filter_input(INPUT_POST, "course");
$courseInfo = filter_input(INPUT_POST, "courseInfo");

echo "<h1>Deleting course from database</h1>";
echo "Type: $type";
echo "course: $course";
echo "courseInfo: $courseInfo";
echo "Id: $id";

if (strcmp($type, "student") == 0) {
    $sql = "DELETE FROM Student WHERE studentID='$id' ";
    if ($conn->query($sql) === TRUE) {
        $conn->close();
        header("Location: student.php");
    }
} else if (strcmp($type, "course") == 0) {
    $sql = "DELETE FROM Course WHERE courseCode='$id' ";
    if ($conn->query($sql) === TRUE) {
        $conn->close();
        header("Location: course.php");
    }
} else if (strcmp($type, "studyprogram") == 0) {
    $sql = "DELETE FROM StudyProgram WHERE sPID='$id' ";
    if ($conn->query($sql) === TRUE) {
        $conn->close();
        header("Location: studyprogram.php");
    }
} else if (strcmp($type, "studyprograminfo") == 0) {
    if (strcmp($type, "elective") == 0) {
        $sql = "DELETE FROM ElectiveCourse WHERE sPID='$id' AND courseCode='$course'";
        if ($conn->query($sql) === TRUE) {
            $conn->close();
            header("Location: studyprograminfo.php?id=$course");
        }
    } else if (strcmp($type, "mandatory") == 0) {
        $sql = "DELETE FROM MandatoryCourse WHERE sPID='$id' AND courseCode='$course'";
        if ($conn->query($sql) === TRUE) {
            $conn->close();
            header("Location: studyprograminfo.php?id=$course");
        }
    }
} else if (strcmp($type, "courseinfo") == 0) {
    $sql = "DELETE FROM Course_Instance WHERE startDate='$id' AND courseCode='$course'";
    if ($conn->query($sql) === TRUE) {
        $conn->close();
        header("Location: courseinfo.php?id=$course");
    }

} else {
    echo "Error deleting record: " . $conn->error;
}
$conn->close();


