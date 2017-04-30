<?php

require_once '../Connection.php';
$conn = (new Connection())->connect();

$type = filter_input(INPUT_POST, "type");
$id = filter_input(INPUT_POST, "id");
$course = filter_input(INPUT_POST, "course");
$courseInfo = filter_input(INPUT_POST, "courseInfo");
$studentID = filter_input(INPUT_POST, "studentID");
$startDate = filter_input(INPUT_POST, "startDate");

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

        $stat = $conn->prepare("DELETE FROM CourseType WHERE sPID=? AND courseCode=?");
        $stat->bind_param("ss", $id, $course);
        if ($stat->execute() === TRUE) {
            header("Location: studyprograminfo.php?id=$id");
        }
} else if (strcmp($type, "courseinfo") == 0) {

    $stat = $conn->prepare("DELETE FROM Course_Instance WHERE startDate=? AND courseCode=?");
    $stat->bind_param("ss", $id, $course);
    if ($stat->execute() === TRUE) {
        header("Location: courseinfo.php?id=$course");
    }

}else if (strcmp($type, "Student_has_StudyProgram") == 0) {

    $stat = $conn->prepare("DELETE FROM Student_has_StudyProgram WHERE studentId=? AND sPID=?");
    $stat->bind_param("ss", $studentID, $id);
    if ($stat->execute() === TRUE) {
        header("Location: studentinfo.php?id=$studentID");
    }
}else if (strcmp($type, "StudentCourse") == 0) {

    $stat = $conn->prepare("DELETE FROM StudentCourse WHERE studentId=? AND courseCode=? AND startDate=?");
    $stat->bind_param("sss", $studentID, $id, $startDate);
    if ($stat->execute() === TRUE) {
        header("Location: studentinfo.php?id=$studentID");
    }
}
echo "Error deleting record: " . $conn->error;
$conn->close();

