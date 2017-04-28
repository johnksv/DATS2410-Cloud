<?php

require '../Connection.php';

if (!empty($_POST)) {
    // keep track validation errors
    $studentIDError = null;
    $sPIDError = null;

    // keep track post values
    $studentID = $_POST['studentID'];
    $sPID = $_POST['sPID'];


    // validate input
    $valid = true;
    if (empty($studentID)) {
        $studentIDError = 'Please choose a student';
        $valid = false;
    }

    if (empty($sPID)) {
        $sPIDError = 'Please choose a program';
        $valid = false;
    }

    // insert data
    if ($valid) {
        $conn = Connection::connect();
        $sql = "INSERT INTO Student_has_StudyProgram (studentID, sPID) values('$studentID', '$sPID')";

        $result = $conn->query($sql);
        Connection::disconnect();
        header("Location: ../show/student_has_StudyProgram.php");
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
include '../htmlTemplate/header.php';
?>

    <h3>Apply for study program</h3>

    <form action="student_has_StudyProgram.php" method="post">
        <label>Choose student</label>
        <div>
            <select name='studentID'>
                <option value="" >Student</option>
                <?php
                require_once '../Connection.php';
                $conn = Connection::connect();

                $sql = "SELECT studentID, firstName, lastName FROM Student";
                $result = $conn->query($sql);
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    $selected = (!empty($studentID) && $studentID == $row['studentID']) ? 'selected' : ' ';
                    echo "<option value='". $row['studentID']."' ".$selected.">". $row['studentID'] . " " .$row['firstName'] . " " .$row['lastName'] ."</option>";
                }
                Connection::disconnect();
                ?>

            </select>

            <?php if (!empty($studentIDError)): ?>
                <span><?php echo $studentIDError; ?></span>
            <?php endif; ?>
        </div>

        <label>Choose program</label>
        <div>
            <select name='sPID'>
                <option value="" >Choose course</option>
                <?php
                require_once '../Connection.php';
                $conn = Connection::connect();

                $sql = "SELECT sPID, sPName FROM StudyProgram";
                $result = $conn->query($sql);
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    $selected = (!empty($sPID) && $sPID == $row['sPID']) ? 'selected' : ' ';
                    echo "<option value='". $row['sPID']."' ".$selected.">". $row['sPID'] . " " .$row['sPName'] ."</option>";
                }
                Connection::disconnect();
                ?>
            </select>

            <?php if (!empty($sPIDError)): ?>
                <span><?php echo $sPIDError; ?></span>
            <?php endif; ?>
        </div>
        <div>
            <button type="submit">Create</button>
            <a href="../show/course_instance.php">Back</a>
        </div>
    </form>
</main>

<?php include '../htmlTemplate/footer.php'; ?>
</body>
</html>
