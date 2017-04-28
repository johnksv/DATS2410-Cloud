<?php

require '../Connection.php';
if(empty($_POST['id'])){
    header("Location: ../show/student.php");
}else{

    $studentID = $_POST['id'];

    if (count($_POST) > 1) {
        // keep track validation errors
        $studentIDError = null;
        $courseCodeError = null;
        $startDateError = null;


        // keep track post values
        $studentID = $_POST['id'];
        list($courseCode, $startDate) = explode("–", $_POST['courseInstance'], 2);

        // validate input
        $valid = true;

        if (empty($courseCode)) {
            $courseCodeError = 'Please choose a program';
            $valid = false;
        }
        if (empty($startDate)) {
            $startDateError = 'Please choose a program';
            $valid = false;
        }

        // insert data
        if ($valid) {
            $conn = (new Connection())->connect();
            $sql = "INSERT INTO StudentCourse (studentID, courseCode, startDate) 
            values('$studentID', '$courseCode', '$startDate')";

            $result = $conn->query($sql);

            $conn->close();
            header("Location: ../show/studentinfo.php?id=$studentID");
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <?php readfile("../html/head.html");  ?>
</head>
<body>

<?php
//Insert header
include_once '../html/header.php';
?>

<h3>Apply for course</h3>

<form action="studentcourse.php" method="post">

    <label>Choose a course</label>
    <div>
        <select name='courseInstance'>
            <option value="" >Choose course</option>
            <?php
            require_once '../Connection.php';
            $conn = (new Connection())->connect();

            $sql = "SELECT startDate, CI.courseCode, C.courseTitle 
            FROM Course_instance as CI, Course as C 
            where CI.courseCode = C.courseCode";

            $result = $conn->query($sql);
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $selected = (!empty($courseCode) && $courseCode == $row['courseCode']) ? 'selected' : ' ';
                echo "<option value='". $row['courseCode']."–". $row['startDate']."' ".$selected.">" .$row['courseTitle']. " ". $row['courseCode'] . " " .$row['startDate'] ."</option>";
            }
            $conn->close();
            ?>
        </select>

        <?php if (!empty($courseCodeError)): ?>
            <span><?php echo $courseCodeError; ?></span>
        <?php endif; ?>
    </div>
    <div>
        <input type="hidden" name="id" value="<?php echo $studentID ?>">
        <button type="submit">Create</button>
        <a href="../show/course_instance.php">Back</a>
    </div>
</form>
</main>


</body>
</html>
