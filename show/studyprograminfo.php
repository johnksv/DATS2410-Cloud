<?php
require_once '../Connection.php';
if (!empty($_GET) && isset($_GET["id"])) {
    $conn = (new Connection())->connect();

    $id = filter_input(INPUT_GET, "id");
    $stat = $conn->prepare("Select Course.courseTitle, CourseType.courseCode, CourseType.standardSemester, type from Course 
    join CourseType on CourseType.courseCode = Course.courseCode where sPID=? order by type");
    $stat->bind_param("s", $id);
    $stat->execute();

    $result1 = $stat->get_result();

    $stat = $conn->prepare("SELECT * FROM StudyProgram WHERE sPID=?");
    $stat->bind_param("s", $id);
    $stat->execute();
    $result = $stat->get_result();
    $conn->close();

    $noSuchCourse = false;
    $name = "";
    $dur = "";
    if ($result->num_rows > 0) {
        // output data of each row
        $row = $result->fetch_assoc();
        $name = $row['sPName'];
        $duration = $row['durationSemester'];
        $startYear = $row['startYear'];
    } else {
        $noSuchCourse = true;
    }

} else {
    //If no valid ID is given
    header("location:studyprogram.php");
}

if (!empty($_POST["update"])) {

    $name = filter_input(INPUT_POST, "name");
    $startYear = filter_input(INPUT_POST, "startYear");
    $duration = filter_input(INPUT_POST, "duration");
    $conn = (new Connection())->connect();
    $stat = $conn->prepare("UPDATE StudyProgram SET sPName=?, startYear=?, durationSemester=? WHERE sPID=?");
    $stat->bind_param("ssss", $name, $startYear, $duration, $id);
    $stat->execute();
    $conn->close();
    header("Location: ../show/studyprograminfo.php?id=$id&updated=true");
}

?>
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
        <div class="row">
            <h2><?php echo $id; ?> - Elective and mandatory courses</h2>
        </div>
        <?php if ($noSuchCourse) { ?>
            <h3>No such program in database.</h3>
        <?php } else { ?>

            <div>

                <form action="studyprograminfo.php?id=<?php echo "$id"; ?>" method="post">
                    Program name: <br>
                    <input name="name" type="text" value="<?php echo $name; ?>"><br>
                    Duration (number of semesters): <br>
                    <input min="1" max="16" name="duration" type="number" value="<?php echo $duration; ?>"><br>
                    Start Year<br>
                    <select name="startYear">
                        <?php
                        $time = new DateTime('now');
                        $curryear = intval($time->format("Y"));
                        $year = $curryear;
                        if (isset($startYear)) {
                            $newtime = new DateTime("$startYear-01-01");
                            $year = intval($newtime->format("Y"));
                        }

                        for ($i = 5; $i > 0; $i--) { ?>
                            <option <?php if ($year == $curryear + $i) echo 'selected' ?>>
                                <?php echo $curryear + $i; ?>
                            </option>
                        <?php } ?>

                        <option <?php if ($year == $curryear) echo 'selected' ?>>
                            <?php echo $curryear; ?>
                        </option>

                        <?php for ($i = $curryear - 1; $i > 1990; $i--) { ?>
                            <option <?php if ($year == $i) echo 'selected' ?>>
                                <?php echo $i; ?>
                            </option>
                        <?php } ?>

                    </select>

                    <p><b>
                            <?php
                            if (isset($_GET["updated"]))
                                if (strcmp($_GET["updated"], "true") == 0)
                                    echo "Succesfully updated!";
                            ?>

                        </b>
                    </p>
                    <input type="submit" name="update" Value="Update">
                </form>
            </div>

            <div>
                <h3>Courses associated with program</h3>
                <form action="../insert/programcourses.php" method="post">
                    <input type="hidden" name="id" value="<?php echo "$id" ?>">
                    <input type="submit" value="Add new course"><br>
                </form>
            </div>

            <div>
                <table>
                    <thead>
                    <tr>
                        <th> Course Title</th>
                        <th> Course Code</th>
                        <th> Standard Semester</th>
                        <th> Type </th>
                        <th> Action </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php while ($row = $result1->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo $row['courseTitle'] ?></td>
                            <td><?php echo $row['courseCode'] ?></td>
                            <td><?php echo $row['standardSemester'] ?></td>
                            <td><?php echo $row['type']=="M" ? "Mandatory" : "Elective" ?></td>
                            <td>
                                <form action="delete.php" method="post">
                                    <input type="hidden" name="id" value="<?php echo $id ?>">
                                    <input type="hidden" name="course" value="<?php echo $row['courseCode'] ?>">
                                    <input type="hidden" name="type" value="CourseType">
                                    <input type="submit" name="Delete" value="Delete"><br>

                                </form>
                            </td>


                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        <?php } ?>
    </div>
</main>


</body>
</html>