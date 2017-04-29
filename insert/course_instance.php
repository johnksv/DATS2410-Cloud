<?php

require '../Connection.php';

if (empty($_POST['courseCode'])) {
    header("location:../show/course.php");
} else {

    $courseCode = filter_input(INPUT_POST, 'courseCode');
    if (count($_POST) > 1) {

        // keep track validation errors
        $courseCodeError = null;
        $startDateError = null;
        $examDateError = null;


        // keep track post values
        $startDate = filter_input(INPUT_POST, 'startDate');
        $examDate = filter_input(INPUT_POST, 'examDate');


        // validate input
        $valid = true;

        // insert data
        if ($valid) {
            $conn = (new Connection())->connect();
            $stat = "";
            if (empty($examDate)) {
                $sql = "INSERT INTO Course_Instance (courseCode, startDate) values('$courseCode', '$startDate')";
                $stat = $conn->prepare("INSERT INTO Course_Instance (courseCode, startDate) values(?, ?)");
                $stat->bind_param("ss", $courseCode, $startDate);
            } else {
                $sql = "INSERT INTO Course_Instance (courseCode, startDate, examDate) values('$courseCode', '$startDate', '$examDate')";
                $stat = $conn->prepare("INSERT INTO Course_Instance (courseCode, startDate, examDate) values(?, ?, ?)");
                $stat->bind_param("sss", $courseCode, $startDate, $examDate);
            }

            $stat->execute();
            $conn->close();
            header("Location: ../show/courseinfo.php?id=$courseCode");
        }
    }
}
?>

<!DOCTYPE HTML>
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

    <h3>Start <?php echo $courseCode ?></h3>


    <form action="course_instance.php" method="post">

        <label>Start date</label>
        <div>
            <input name='startDate' type="date" placeholder="yyyy-mm-dd"
                   value="<?php echo !empty($startDate) ? $startDate : ''; ?>">
            <?php if (!empty($startDateError)): ?>
                <span><?php echo $startDateError; ?></span>
            <?php endif; ?>
        </div>

        <label>Exam date (optional)</label>
        <div>
            <input name='examDate' type="date" placeholder="yyyy-mm-dd"
                   value="<?php echo !empty($examDate) ? $examDate : ''; ?>">
            <?php if (!empty($examDateError)): ?>
                <span><?php echo $examDateError; ?></span>
            <?php endif; ?>
        </div>

        <div>

            <input type="hidden" name="courseCode" value="<?php echo $courseCode ?>">
            <button type="submit">Create</button>
            <a href="../show/courseinfo.php?id=<?php echo $courseCode ?>">Back</a>
        </div>
    </form>
</main>


</body>
</html>
