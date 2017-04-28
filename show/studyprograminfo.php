<?php
require_once '../Connection.php';
$conn = (new Connection())->connect();

$sql = "Select Course.courseTitle, ElectiveCourse.courseCode, ElectiveCourse.standardSemester from Course 
    join ElectiveCourse on ElectiveCourse.courseCode = Course.courseCode 
    where sPID='" . $_GET["id"] . "' ";

$result1 = $conn->query($sql);
$sql = "Select Course.courseTitle, MandatoryCourse.courseCode, MandatoryCourse.standardSemester from Course 
    join MandatoryCourse on MandatoryCourse.courseCode = Course.courseCode 
    where sPID='" . $_GET["id"] . "' ";

$result2 = $conn->query($sql);
$conn->close();
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

<main class="container">
    <div class="row">
        <h2><?php echo $_GET["id"]; ?> - Elective and mandatory courses</h2>
    </div>

    <form action="../insert/programcourses.php" method="post">
        <input type="hidden" name="id" value="<?php echo $_GET["id"] ?>">
        <input type="submit" value="Add new course"><br>
    </form>

    <div>
        <table>
            <thead>
            <tr>
                <th> Course Title</th> 
                <th> Course Code</th>
                <th> Standard Semester</th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php while ($row = $result1->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['courseTitle'] ?></td>
                    <td><?php echo $row['courseCode'] ?></td>
                    <td><?php echo $row['standardSemester'] ?></td>
                    <td>Elective</td>
                    <td>
                        <form action="delete.php" method="post">
                            <input type="hidden" name="id" value="<?php echo $row['sPID'] ?>">
                            <input type="hidden" name="course" value="<?php echo $row['courseCode'] ?>">
                            <input type="hidden" name="courseInfo" value="elective">
                            <input type="hidden" name="type" value="studyProgram">
                            <input type="submit" name="Delete" value="Delete"><br>

                        </form>
                    </td>


                </tr>
            <?php }
            while ($row = $result2->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['courseTitle'] ?></td>
                    <td><?php echo $row['courseCode'] ?></td>
                    <td><?php echo $row['standardSemester'] ?></td>
                    <td>Mandatory</td>

                    <td>
                        <form action="delete.php" method="post">
                            <input type="hidden" name="id" value="<?php echo $row['sPID'] ?>">
                            <input type="hidden" name="course" value="<?php echo $row['courseCode'] ?>">
                            <input type="hidden" name="courseInfo" value="mandatory">
                            <input type="hidden" name="type" value="studyprograminfo">
                            <input type="submit" name="Delete" value="Delete"><br>

                        </form>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>

</main>


</body>
</html>