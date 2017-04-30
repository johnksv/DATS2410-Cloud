<?php
require_once '../Connection.php';

if (!empty($_POST["update"])) {

    $courseCode = filter_input(INPUT_POST, "courseCode");
    $startDate = filter_input(INPUT_POST, "startDate");
    $examDate = filter_input(INPUT_POST, "examDate");

    $conn = (new Connection())->connect();
    $stat = $conn->prepare("UPDATE Course_Instance SET examDate=? WHERE courseCode=? and startDate=?");
    $stat->bind_param("sss", $examDate, $courseCode, $startDate);
    $stat->execute();
    $result = $stat->get_result();
    $conn->close();


    header("Location: ../show/courseinfo.php?id=" . $_POST["courseCode"]);
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
        <?php
        //If the request is from another webpage
        if (empty($_POST["courseCode"])) {
            echo "<h1>Direct access not allowed, redirecting</h1>";
            header('Refresh: 2;URL=../show/course.php');
        } else {
            $courseCode = filter_input(INPUT_POST, "courseCode");
            $startDate = filter_input(INPUT_POST, "startDate");
            echo "<b>Updating exam date for $courseCode starting at $startDate </b><br>";

            $conn = (new Connection())->connect();
            $stat = $conn->prepare("SELECT * FROM Course_Instance WHERE courseCode=? and startDate=?");
            $stat->bind_param("ss", $courseCode, $startDate);
            $stat->execute();
            $result = $stat->get_result();
            $conn->close();

            if ($result->num_rows > 0) {
                // output data of each row
                while ($row = $result->fetch_assoc()) {
                    $courseCode = $row['courseCode'];
                    $startDate = $row['startDate'];
                    $examDate = $row['examDate'];
                }
            } else {
                echo "<h1>No such course in database, redirecting to courses</h1>";
                header('Refresh: 2;URL=../show/course.php');
            } ?>

            <form action="courseinstance.php" method="post">
                Exam date: <input type="date" name="examDate" value="<?php echo $examDate; ?>"><br>

                <br>

                <input type="hidden" name="startDate" value="<?php echo $startDate; ?>"/>
                <input type="hidden" name="courseCode" value="<?php echo $courseCode; ?>"/>
                <input type="submit" name="update" Value="Update">
                <a href="../show/courseinfo.php?id=<?php echo $courseCode ?>">Back</a>
            </form>

        <?php } ?>
    </div>
</main>

</body>
</html>