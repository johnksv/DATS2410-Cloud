<?php
require_once '../Connection.php';

$studentID="";
if (empty($_POST['id'])) {
    header("Location: ../show/student.php");
} else {

    $studentID = filter_input(INPUT_POST, "id");

    if (count($_POST) > 1) {
        // keep track validation errors
        $studentIDError = null;
        $courseCodeError = null;
        $startDateError = null;

        // keep track post values
        list($courseCode, $startDate) = explode("–", filter_input(INPUT_POST, 'courseInstance'), 2);

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
            $stat = $conn->prepare("INSERT INTO StudentCourse (studentID, courseCode, startDate) values(?,?,?)");
            $stat->bind_param("sss", $studentID, $courseCode, $startDate);
            $stat->execute();
            $conn->close();
            header("Location: ../show/studentinfo.php?id=$studentID");
        }
    }
}

$conn = (new Connection())->connect();

$sql = "SELECT startDate, CI.courseCode, C.courseTitle 
            FROM Course_Instance as CI, Course as C 
            where CI.courseCode = C.courseCode";

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
        <h3>Apply for course</h3>

        <form action="studentcourse.php" method="post">

            <label>Choose a course</label>
            <div>
                <select name='courseInstance'>
                    <option value="">Choose course</option>
                    <?php
                    // output data of each row
                    while ($row = $result->fetch_assoc()) {
                        $selected = (!empty($courseCode) && $courseCode == $row['courseCode']) ? 'selected' : ' ';
                        echo "<option value='" . $row['courseCode'] . "–" . $row['startDate'] . "' " . $selected . ">" . $row['courseTitle'] . " " . $row['courseCode'] . " " . $row['startDate'] . "</option>";
                    }
                    ?>
                </select>

                <?php if (!empty($courseCodeError)): ?>
                    <span><?php echo $courseCodeError; ?></span>
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
