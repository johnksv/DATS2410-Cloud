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

    if (empty($durationSemester)) {
        $yearError = 'Please enter duration';
        $valid = false;
    } elseif(!is_numeric($durationSemester)){
		$durationError = 'Be kind and use a number.';
        $valid = false;
	}

    if (empty($startYear)) {
        $durationError = 'Please enter start year';
        $valid = false;
    }

    // insert data
    if ($valid) {
        $conn = (new Connection())->connect();
        $sql = "INSERT INTO StudyProgram (sPID, sPName, durationSemester, startYear) values('$spid', '$spname', '$durationSemester', '$startYear')";

        $result = $conn->query($sql);

        $conn->close();
        header("Location: ../show/studyprogram.php");
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
include_once '../htmlTemplate/header.php';
?>

<main>

    <h3>Create Student Program</h3>

    <form action="studyprogram.php" method="post">

        <label>Program ID</label>
        <div>
            <input name="sPID" type="text"
                   value="<?php echo !empty($spid) ? $spid : ''; ?>">
            <?php if (!empty($IDError)): ?>
                <span><?php echo $IDError; ?></span>
            <?php endif; ?>
        </div>
        <label>Program long name</label>
        <div>
            <input name="sPName" type="text"
                   value="<?php echo !empty($spname) ? $spname : ''; ?>">
            <?php if (!empty($programNameError)): ?>
                <span><?php echo $programNameError; ?></span>
            <?php endif; ?>
        </div>

        <label>Duration (number of semesters)</label>
        <div>
            <input name="durationSemester" type="number"
                   value="<?php echo !empty($durationSemester) ? $durationSemester : ''; ?>">
            <?php if (!empty($durationError)): ?>
                <span><?php echo $durationError; ?></span>
            <?php endif; ?>
        </div>

        <label>Start year</label>
        <div>
            <select name="startYear">
                <?php
                $time = new DateTime('now');
                $year = intval($time->format("Y"));
                for($i = 5; $i > 0; $i--){?>
                    <option <?php if($startYear === strval($year+$i)){ echo "selected"; } ?> ><?php echo $year+$i; ?></option>
                <?php } ?>

                <option <?php if(empty($startYear)){ echo "selected"; }else if($startYear === strval($year)){ echo "selected"; } ?>><?php echo $year; ?></option>

                <?php for($i = $year-1 ; $i > 1990; $i--){ ?>
                    <option <?php if($startYear === strval($i)){ echo "selected"; } ?>><?php echo $i; ?></option>
                <?php } ?>

            </select>
        </div>

        <div>
            <button type="submit">Create</button>
            <a href="../show/studyprogram.php">Back</a>
        </div>
    </form>
</main>


</body>
</html>
