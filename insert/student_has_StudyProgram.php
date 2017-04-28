<?php

require '../Connection.php';
if(empty($_POST['id'])){
    header("Location: ../show/student.php");
}else{

$studentID = $_POST['id'];

if (count($_POST) > 1) {
    // keep track validation errors
    $studentIDError = null;
    $sPIDError = null;

    // keep track post values
    $studentID = $_POST['id'];
    $sPID = $_POST['sPID'];


    // validate input
    $valid = true;

    if (empty($sPID)) {
        $sPIDError = 'Please choose a program';
        $valid = false;
    }

    // insert data
    if ($valid) {
        $conn = (new Connection())->connect();
        $sql = "INSERT INTO Student_has_StudyProgram (studentID, sPID) values('$studentID', '$sPID')";

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

    <h3>Apply for study program</h3>

    <form action="student_has_StudyProgram.php" method="post">

        <label>Choose program</label>
        <div>
            <select name='sPID'>
                <option value="" >Choose course</option>
                <?php
                require_once '../Connection.php';
                $conn = (new Connection())->connect();

                $sql = "SELECT sPID, sPName FROM StudyProgram";
                $result = $conn->query($sql);
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    $selected = (!empty($sPID) && $sPID == $row['sPID']) ? 'selected' : ' ';
                    echo "<option value='". $row['sPID']."' ".$selected.">". $row['sPID'] . " " .$row['sPName'] ."</option>";
                }
                $conn->close();
                ?>
            </select>

            <?php if (!empty($sPIDError)): ?>
                <span><?php echo $sPIDError; ?></span>
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
