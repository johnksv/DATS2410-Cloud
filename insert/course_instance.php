<?php

require '../Connection.php';

if (empty($_POST['courseCode'])) {
    header("location:../show/course.php");
} else {

    $courseCode = $_POST['courseCode'];
    if (count($_POST) > 1) {

        // keep track validation errors
        $courseCodeError = null;
        $startDateError = null;
        $examDateError = null;


        // keep track post values
        $startDate = $_POST['startDate'];
        $examDate = $_POST['examDate'];


        // validate input
        $valid = true;

        if (empty($startDate)) {
            $startDateError = 'Please enter start date';
            $valid = false;
        }
        if (empty($examDate)) {
            $examDateError = 'Please enter exam date';
            $valid = false;
        }


        // insert data
        if ($valid) {
            $conn = (new Connection())->connect();
            $sql = "";
            if (empty($examDate)) {
                $sql = "INSERT INTO Course_Instance (courseCode, startDate) values('$courseCode', '$startDate')";
            } else {
                $sql = "INSERT INTO Course_Instance (courseCode, startDate, examDate) values('$courseCode', '$startDate', '$examDate')";
            }


            $result = $conn->query($sql);
            $conn->close();
            header("Location: ../show/courseinfo.php?id=$courseCode");
        }
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
