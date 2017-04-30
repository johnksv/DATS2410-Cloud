<?php

require '../Connection.php';
if (empty($_POST['id'])) {
    header("Location: ../show/studyprogram.php");
} else {

    $sPID = filter_input(INPUT_POST, 'id');

    if (count($_POST) > 1) {
        // keep track validation errors
        $standardSemesterError = null;
        $courseCodeError = null;
        $typeError = null;

        // keep track post values
        $courseCode = filter_input(INPUT_POST, 'courseCode');
        $standardSemester = filter_input(INPUT_POST, 'standardSemester');
        $type = filter_input(INPUT_POST, 'type');


        // validate input
        $valid = true;
        if (empty($courseCode)) {
            $courseCodeError = 'Please choose a course';
            $valid = false;
        }
        if (empty($type)) {
            $typeError = 'Please choose a type';
            $valid = false;
        }

        if (empty($standardSemester)) {
            $standardSemesterError = 'Please choose a semester';
            $valid = false;
        } elseif (!is_numeric($standardSemester)) {
            $standardSemesterError = 'Be kind and use a number.';
            $valid = false;
        }

        // insert data
        if ($valid) {
            $conn = (new Connection())->connect();
            $stat = null;
            $stat = $conn->prepare("INSERT INTO CourseType (sPID, courseCode, standardSemester, type) values(?, ?, ?, ?)");

            $stat->bind_param("ssss", $sPID, $courseCode, $standardSemester, $type);
            $stat->execute();
            $conn->close();

            header("Location: ../show/studyprograminfo.php?id=$sPID");
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
    <div class="innerMain">
        <h3>Add a course to <?php echo $sPID; ?></h3>

        <form action="programcourses.php" method="post">

            <label>Course code</label>
            <div>
                <select name='courseCode'>
                    <option value="">Choose course</option>
                    <?php
                    require_once '../Connection.php';
                    $conn = (new Connection())->connect();

                    $sql = "SELECT courseCode, courseTitle FROM Course";
                    $result = $conn->query($sql);
                    // output data of each row
                    while ($row = $result->fetch_assoc()) {
                        $selected = (!empty($courseCode) && $courseCode == $row['courseCode']) ? 'selected' : ' ';
                        echo "<option value='" . $row['courseCode'] . "' " . $selected . ">" . $row['courseCode'] . " " . $row['courseTitle'] . "</option>";
                    }
                    $conn->close();
                    ?>

                </select>

                <?php if (!empty($courseCodeError)): ?>
                    <span><?php echo $courseCodeError; ?></span>
                <?php endif; ?>
            </div>
            <label>Standard Semester</label>
            <div>
                <input name="standardSemester" type="number" min="0" max="5"
                       value="<?php echo !empty($standardSemester) ? $standardSemester : ''; ?>">
                <?php if (!empty($standardSemesterError)): ?>
                    <span><?php echo $standardSemesterError; ?></span>
                <?php endif; ?>
            </div>
            Type: <?php if (!empty($typeError)) {
                echo $typeError;
            } ?>
            <div>
                <input type="radio" name="type"
                       value="M" <?php echo (!empty($type) && $type == "M") ? "checked" : ''; ?>>
                Mandatory <br>
                <input type="radio" name="type"
                       value="E" <?php echo (!empty($type) && $type == "E") ? "checked" : ''; ?>> Elective
                <p hidden><input type="radio" name="type" value="" <?php echo (empty($type)) ? "checked" : ''; ?>>
                </p>

            </div>


            <div>
                <input type="hidden" name="id" value="<?php echo $sPID ?>">
                <button type="submit">Add</button>
                <a href="../show/studyprograminfo.php?id=<?php echo $sPID ?>">Back</a>
            </div>
        </form>
    </div>
</main>


</body>
</html>