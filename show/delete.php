<?php

require_once '../Connection.php';
$conn = (new Connection())->connect();

$type = filter_input(INPUT_POST, "type");
$id = filter_input(INPUT_POST, "id");
$course = filter_input(INPUT_POST, "course");
$courseInfo = filter_input(INPUT_POST, "courseInfo");

echo "<h1>Deleting course from database</h1>";
$stat = "";
if (strcmp($type, "student") == 0) {

    $stat = $conn->prepare("DELETE FROM Student WHERE studentID=?");
    echo $stat->bind_param("s", $id);
    if ($stat->execute() === TRUE) {
        header("Location: student.php");
    }
} else if (strcmp($type, "course") == 0) {

    $stat = $conn->prepare("DELETE FROM Course WHERE courseCode=?");
    $stat->bind_param("s", $id);
    if ($stat->execute() === TRUE) {
        header("Location: course.php");
    }
} else if (strcmp($type, "studyprogram") == 0) {

    $stat = $conn->prepare("DELETE FROM StudyProgram WHERE sPID=?");
    $stat->bind_param("s", $id);
    if ($stat->execute() === TRUE) {
        header("Location: studyprogram.php");
    }
} else if (strcmp($type, "studyprograminfo") == 0) {
    if (strcmp($courseInfo, "elective") == 0) {

        $stat = $conn->prepare("DELETE FROM ElectiveCourse WHERE sPID=? AND courseCode=?");
        $stat->bind_param("ss", $id, $course);
        if ($stat->execute() === TRUE) {
            header("Location: studyprograminfo.php?id=$course");
        }
    } else if (strcmp($courseInfo, "mandatory") == 0) {

        $stat = $conn->prepare("DELETE FROM MandatoryCourse WHERE sPID=? AND courseCode=?");
        $stat->bind_param("ss", $id, $course);
        if ($stat->execute() === TRUE) {
            header("Location: studyprograminfo.php?id=$course");
        }
    }
} else if (strcmp($type, "courseinfo") == 0) {

    $stat = $conn->prepare("DELETE FROM Course_Instance WHERE startDate=? AND courseCode=?");
    $stat->bind_param("ss", $id, $course);
    if ($stat->execute() === TRUE) {
        header("Location: courseinfo.php?id=$course");
    }

}

echo "Error deleting record: " . $conn->error;
$conn->close();

