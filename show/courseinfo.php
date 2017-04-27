<?php
require_once '../Connection.php';
if(!empty($_GET)) {
    $conn = Connection::connect();
    $courseID = $_GET['id'];
    $sql = "select startDate, examDate from Course_instance as CI where CI.courseCode='$courseID'";
    $studentInfo = $conn->query($sql);
    Connection::disconnect();
}
else{
    header("location:course.php");
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
readfile("../htmlTemplate/header.html");
?>

<main>
    <div>
        <h3>Info about <?php echo $courseID ?></h3>
    </div>

    <div>
        <table>
            <thead>
            <tr>
                <th>Start date</th>
                <th>Exam date</th>
            </tr>
            </thead>

            <tbody>
            <?php if(!empty($studentInfo)){
            while($row = $studentInfo->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row['startDate'] ?></td>
                <td><?php echo $row['examDate'] ?></td>
            </tr>
                <?php }}?>
            </tbody>
        </table>
    </div>
    <form action="../insert/course_instance.php" method="post">
        <input type="hidden" name="courseCode" value="<?php echo $_GET["id"] ?>">
        <input type="submit" value="ADD"><br>
    </form>

</main>

<?php include '../htmlTemplate/footer.php'; ?>
</body>
</html>


