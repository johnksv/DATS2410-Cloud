<?php

require '../Connection.php';

if (!empty($_POST)) {
    // keep track validation errors
    $courseCodeError = null;
    $courseTitleError = null;
    $semesterError = null;

    // keep track post values
    $courseCode = filter_input(INPUT_POST, 'courseCode');
    $courseTitle = filter_input(INPUT_POST, 'courseTitle');
    $semester = filter_input(INPUT_POST, 'semester');


    // validate input
    $valid = true;
    if (empty($courseCode)) {
        $courseCodeError = 'Please enter course code';
        $valid = false;
    }

    if (empty($courseTitle)) {
        $courseTitleError = 'Please enter course title';
        $valid = false;
    }

    if (empty($semester)) {
        $semesterError = 'Please choose semester';
        $valid = false;
    }

    // insert data
    if ($valid) {
        $conn = (new Connection())->connect();
        $stat = $conn->prepare("INSERT INTO Course (courseCode, courseTitle, Semester) values(?, ?, ?)");
        $stat->bind_param("sss", $courseCode, $courseTitle, $semester);
        $stat->execute();
        $conn->close();
        header("Location: ../show/course.php");
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <?php readfile("../html/head.html"); ?>
</head>
<body>

<?php
//Insert header
include_once '../html/header.php';
?>

<main>
    <div class="innerMain">
        <h3>Create a Course</h3>

        <form action="course.php" method="post">
            <label>Course code</label>
            <div>
                <input name="courseCode" type="text" placeholder="Course code"
                       value="<?php echo !empty($courseCode) ? $courseCode : ''; ?>">
                <?php if (!empty($courseCodeError)): ?>
                    <span><?php echo $courseCodeError; ?></span>
                <?php endif; ?>
            </div>

            <label>Course title</label>
            <div>
                <input name="courseTitle" type="text" placeholder="Course title"
                       value="<?php echo !empty($courseTitle) ? $courseTitle : ''; ?>">
                <?php if (!empty($courseTitleError)): ?>
                    <span><?php echo $courseTitleError; ?></span>
                <?php endif; ?>
            </div>

            <label>Semester</label>
            <div>
                <input type="radio" name="semester"
                       value="S" <?php echo (!empty($semester) && $semester == "S") ? "checked" : ''; ?>>
                Spring <?php if (!empty($semesterError)): ?>
                    <span><?php echo $semesterError; ?></span>
                <?php endif; ?><br>
                <input type="radio" name="semester"
                       value="F" <?php echo (!empty($semester) && $semester == "F") ? "checked" : ''; ?>> Fall
                <p hidden><input type="radio" name="semester"
                                 value="" <?php echo (empty($semester)) ? "checked" : ''; ?>>
                </p>

            </div>

            <div>
                <button type="submit">Create</button>
                <a href="../show/course.php">Back</a>
            </div>
        </form>
    </div>
</main>

</body>
</html>
