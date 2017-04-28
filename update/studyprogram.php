<?php
require_once '../Connection.php';
$coursetitle = null;
$semester = null;
$conn = (new Connection())->connect();

if (!empty($_POST["update"])) {

    $sql = "UPDATE StudyProgram SET sPName='" . $_POST["name"] .
        "', startYear='" . $_POST['startYear'] .
        "', durationSemester='" . $_POST['duration'] .
        "' WHERE sPID='" . $_POST["foo"] .
        "'";

    $result = $conn->query($sql);
    $conn->close();
    header("Location: ../show/studyprogram.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <?php readfile("../htmlTemplate/head.html"); ?>
</head>
<body>

    <?php
    //Insert header
    include_once '../html/header.php';
    ?>
    <main>
        <?php
        //If the request is from another webpage
        if (empty($_POST["sPID"])) {
            echo "<h1>Direct access not allowed, redirecting</h1>";
            header('Refresh: 2;URL=../show/studyprogram.php');
        } else {
            echo "<B>Updating course: " . $_POST["sPID"] . "</B><br>";

            $sql = 'SELECT * FROM StudyProgram WHERE sPID="' . $_POST["sPID"] . '"';
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // output data of each row
                while ($row = $result->fetch_assoc()) {
                    $name = $row['sPName'];
                    $dur = $row['durationSemester'];
                    $year = $row['startYear'];
                    $coursetitle = $row['courseTitle'];
                }

            } else {
                echo "No such course!";
            }

            $conn->close(); ?>

            <form action="studyprogram.php" method="post">
                Program name: <br>
                <input name="name" type="text" value="<?php echo $name; ?>"><br>
                Duration (number of semesters): <br>
                <input name="duration" type="text" value="<?php echo $dur; ?>"><br>
                Start Year<br>
                <select name="startYear">
                    <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
                    <?php
                    $time = new DateTime('now');
                    $year = intval($time->format("Y"));
                    for ($i = 5; $i > 0; $i--) {
                        ?>
                        <option><?php echo $year + $i; ?></option>
                    <?php } ?>

                    <option selected><?php echo $year; ?></option>

                    <?php for ($i = $year - 1; $i > 1990; $i--) { ?>
                        <option><?php echo $i; ?></option>
                    <?php } ?>

                </select>
                <br>
                <br>
                <input type="hidden" name="foo" value="<?php echo $_POST["sPID"]; ?>"/>
                <input type="submit" name="update" Value="Update">
            </form>

        <?php } ?>
    </main>
</body>
</html>