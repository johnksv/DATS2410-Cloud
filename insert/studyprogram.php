<?php

require '../Connection.php';
if (!empty($_POST)) {
    // keep track validation errors
    $IDError = null;
    $programNameError = null;
    $yearError = null;
    $durationError = null;

    // keep track post values
    $spid = $_POST['sPID'];
    $spname = $_POST['sPName'];
    $durationSemester = $_POST['durationSemester'];
    $startYear = $_POST['startYear'];

    // validate input
    $valid = true;
    if (empty($spid)) {
        $IDError = 'Please enter a ID';
        $valid = false;
    }

    if (empty($spname)) {
        $programNameError = 'Please enter Program Long Name';
        $valid = false;
    }

    function validateDate($date)
    {
        $d = DateTime::createFromFormat('Y-m-d', $date);
        return $d && $d->format('Y-m-d') === $date;
    }

    if (empty($durationSemester)) {
        $yearError = 'Please enter duration';
        $valid = false;
    }

    if (empty($startYear)) {
        $durationError = 'Please enter start year';
        $valid = false;
    }

    // insert data
    if ($valid) {
        $conn = Connection::connect();
        $sql = "INSERT INTO Studyprogram ('sPID', 'sPName', 'durationSemester', 'startYear') values('$spid', '$spname', '$durationSemester', '$startYear')";

        $result = $conn->query($sql);
        Connection::disconnect();
        header("Location: ../show/studyprogram.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
</head>
<body>

<div>

    <h3>Create Student Program</h3>

    <form action="student.php" method="post">

        <label>Program ID</label>
        <div>
            <input name="sPID" type="text" placeholder="sxxxxxx" value="
            <?php echo !empty($spid) ? $spid : ''; ?>">
            <?php if (!empty($IDError)): ?>
                <span><?php echo $IDError; ?></span>
            <?php endif; ?>
        </div>
        <label>Program long name</label>
        <div>
            <input name="sPName" type="text" placeholder="my.example@example.com"
                   value="<?php echo !empty($spname) ? $spname : ''; ?>">
            <?php if (!empty($programNameError)): ?>
                <span><?php echo $programNameError; ?></span>
            <?php endif; ?>
        </div>

        <label>Duration (number of semesters)</label>
        <div>
            <input name="durationSemester" type="text" placeholder="First Name"
                   value="<?php echo !empty($startYear) ? $startYear : ''; ?>">
            <?php if (!empty($durationError)): ?>
                <span><?php echo $durationError; ?></span>
            <?php endif; ?>
        </div>

        <label>Start year</label>
        <div>
            <input name="startYear" type="date" placeholder="yyyy-mm-dd"
                   value="<?php echo !empty($durationSemester) ? $durationSemester : ''; ?>">
            <?php if (!empty($yearError)): ?>
                <span><?php echo $yearError; ?></span>
            <?php endif; ?>
        </div>

        <div>
            <button type="submit">Create</button>
            <a href="../show/studyprogram.php">Back</a>
        </div>
    </form>
</div>


</body>
</html>
