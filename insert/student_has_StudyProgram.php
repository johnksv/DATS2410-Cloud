<?php

require_once '../Connection.php';

if (empty($_POST['id'])) {
    header("Location: ../show/student.php");
} else {

    $studentID = filter_input(INPUT_POST, "id");

    if (count($_POST) > 1) {
        // keep track validation errors
        $studentIDError = null;
        $sPIDError = null;

        // keep track post values
        $sPID = filter_input(INPUT_POST, "sPID");

        // validate input
        $valid = true;

        if (empty($sPID)) {
            $sPIDError = 'Please choose a program';
            $valid = false;
        }

        // insert data
        if ($valid) {
            $conn = (new Connection())->connect();
            $stat = $conn->prepare("INSERT INTO Student_has_StudyProgram (studentID, sPID) values(?,?)");
            $stat->bind_param("ss", $studentID, $sPID);
            $stat->execute();
            $conn->close();
            header("Location: ../show/studentinfo.php?id=$studentID");
        }
    }
}

$conn = (new Connection())->connect();
$sql = "SELECT sPID, sPName FROM StudyProgram";
$result = $conn->query($sql);
$conn->close();
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
        <h3>Apply for study program</h3>

        <form action="student_has_StudyProgram.php" method="post">

            <label>Choose program</label>
            <div>
                <select name='sPID'>
                    <option value="">Choose course</option>
                    <?php
                    // output data of each row
                    while ($row = $result->fetch_assoc()) {
                        $selected = (!empty($sPID) && $sPID == $row['sPID']) ? 'selected' : ' ';
                        echo "<option value='" . $row['sPID'] . "' " . $selected . ">" . $row['sPID'] . " " . $row['sPName'] . "</option>";
                    }
                    ?>
                </select>

                <?php if (!empty($sPIDError)): ?>
                    <span><?php echo $sPIDError; ?></span>
                <?php endif; ?>
            </div>
            <div>
                <input type="hidden" name="id" value="<?php echo $studentID ?>">
                <button type="submit">Create</button>
                <a href="../show/studentinfo.php?id=<?php echo $studentID?>">Back</a>
            </div>
        </form>
    </div>
</main>


</body>
</html>
