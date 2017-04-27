<?php

require '../Connection.php';

if (empty($_POST['courseCode'])) {
    header("location:../show/course.php");
}
else{

    $courseCode = $_POST['courseCode'];
    if(!Empty($_POST['startDate'])){

    // keep track validation errors
    $courseCodeError = null;
    $startDateError = null;
    $examDateError = null;


    // keep track post values
    $startDate = $_POST['startDate'];
    $examDate = $_POST['examDate'];


    // validate input
    $valid = true;
    if (empty($courseCode)) {
        $courseCodeError = 'Please choose course code';
        $valid = false;
    }

    if (empty($startDate)) {
        $startDateError = 'Please enter course startDate';
        $valid = false;
    }

    if (empty($examDate)) {
            $examDateError = 'Please enter course examDate';
            $valid = false;
        }

    // insert data
    if ($valid) {
        $conn = Connection::connect();
        $sql = "INSERT INTO Course_Instance (courseCode, startDate, examDate) values('$courseCode', '$startDate', '$examDate')";

        $result = $conn->query($sql);
        Connection::disconnect();
        header("Location: ../show/courseinfo.php?id=$courseCode");
    }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <?php readfile("../htmlTemplate/head.html");  ?>
</head>
<body>

<?php
//Insert header
readfile("../htmlTemplate/header.html");
?>

<main>

    <h3>Start <?php echo $courseCode?></h3>


    <form action="course_instance.php" method="post">

        <label>Start date</label>
        <div>
            <input name='startDate' type="date" placeholder="yyyy-mm-dd"
                   value="<?php echo !empty($startDate) ? $startDate : ''; ?>">
            <?php if (!empty($startDateError)): ?>
                <span><?php echo $startDateError; ?></span>
            <?php endif; ?>
        </div>

    <label>Start date</label>
    <div>
        <input name='examDate' type="date" placeholder="yyyy-mm-dd"
               value="<?php echo !empty($examDate) ? $examDate : ''; ?>">
        <?php if (!empty($examDateError)): ?>
            <span><?php echo $examDateError; ?></span>
        <?php endif; ?>
    </div>

    <div>

        <input type="hidden" name="courseCode" value="<?php echo $courseCode?>">
        <button type="submit">Create</button>
        <a href="../show/courseinfo.php?id=<?php echo $courseCode?>">Back</a>
    </div>
    </form>
</main>

<?php include '../htmlTemplate/footer.php'; ?>
</body>
</html>
