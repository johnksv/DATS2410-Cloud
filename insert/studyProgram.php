<?php

require '../phpcode/Connection.php';

if (!empty($_POST)) {
    // keep track validation errors
    $sPIDError = null;
    $sPNameError = null;
    $durationSemesterError = null;
    $startYearError = null;

    // keep track post values
    $sPID = $_POST['sPID'];
    $sPName = $_POST['sPName'];
    $durationSemester = $_POST['durationSemester'];
    $startYear = $_POST['startYear'];


    // validate input
    $valid = true;
    if (empty($sPID)) {
        $sPIDError = 'Please enter study program ID';
        $valid = false;
    }

    if (empty($sPName)) {
        $sPNameError = 'Please enter study program name';
        $valid = false;
    }

    if (empty($durationSemester)) {
        $durationSemesterError = 'Please enter duration of the study program';
        $valid = false;
    }

    if (empty($startYear)) {
        $startYearError = 'Please enter start year';
        $valid = false;
    }

    // insert data
    if ($valid) {
        $conn = Connection::connect();
        $sql = "INSERT INTO StudyProgram (sPID, sPName, durationSemester, startYear) values('$sPID', 's$sPName', '$durationSemester', '$startYear')";

        $result = $conn->query($sql);
        Connection::disconnect();
        header("Location: ../show/studyProgram.php");
    }
}
?>

<!DCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
</head>
<body>

<div class="span10 offset1">

    <h3>Create a Student</h3>

    <form action="studyProgram.php" method="post">
        <label>Program ID</label>
        <div>
            <input name="sPID" type="text" placeholder="ID" value="<?php echo !empty($sPID) ? $sPID : ''; ?>">
            <?php if (!empty($sPIDError)): ?>
                <span><?php echo $sPIDError; ?></span>
            <?php endif; ?>
        </div>

        <label>Program name</label>
        <div>
            <input name="sPName" type="text" placeholder="Name" value="<?php echo !empty($sPName) ? $sPName : ''; ?>">
            <?php if (!empty($sPNameError)): ?>
                <span><?php echo $sPNameError; ?></span>
            <?php endif; ?>
        </div>

        <label>Duration</label>
        <div>
            <input name="durationSemester" type="text" placeholder="Duration" value="<?php echo !empty($durationSemester) ? $durationSemester : ''; ?>">
            <?php if (!empty($durationSemesterError)): ?>
                <span><?php echo $durationSemesterError; ?></span>
            <?php endif; ?>
        </div>

        <label>Start year</label>
        <div>
            <input name="startYear" type="text" placeholder="Start year" value="<?php echo !empty($startYear) ? $startYear : ''; ?>">
            <?php if (!empty($startYearError)): ?>
                <span><?php echo $startYearError; ?></span>
            <?php endif; ?>
        </div>

        <div>
            <button type="submit">Create</button>
            <a href="../show/studyProgram.php">Back</a>
        </div>
    </form>
</div>


</body>
</html>
