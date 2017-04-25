<?php

require '../phpcode/Connection.php';

if (!empty($_POST)) {
    // keep track validation errors
    $courseCodeError = null;
    $startDateError = null;


    // keep track post values
    $courseCode = $_POST['courseCode'];
    $startDate = $_POST['startDate'];



    // validate input
    $valid = true;
    if (empty($courseCode)) {
        $courseCodeError = 'Please choose course code';
        $valid = false;
    }

    if (empty($startDate)) {
        $startDateError = 'Please enter course startDate';
        $valid = false;
    }

    // insert data
    if ($valid) {
        $conn = Connection::connect();
        $sql = "INSERT INTO Course_Instance (courseCode, startDate) values('$courseCode', '$startDate')";

        $result = $conn->query($sql);
        Connection::disconnect();
        header("Location: ../show/course_instance.php");
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

    <h3>Apply for a course</h3>

    <form action="course_instance.php" method="post">
        <label>Course code</label>
        <div>
           <select name='courseCode'>
               <option value="" >Choose course</option>
               <?php
               require_once '../phpcode/Connection.php';
               $conn = Connection::connect();

               $sql = "SELECT courseCode, courseTitle FROM Course";
               $result = $conn->query($sql);
               // output data of each row
               while($row = $result->fetch_assoc()) {
                   $selected = (!empty($courseCode) && $courseCode == $row['courseCode']) ? 'selected' : ' ';
                   echo "<option value='". $row['courseCode']."' ".$selected.">". $row['courseCode'] . " " .$row['courseTitle'] ."</option>";
               }
               Connection::disconnect();
               ?>

           </select>

            <?php if (!empty($courseCodeError)): ?>
                <span><?php echo $courseCodeError; ?></span>
            <?php endif; ?>
        </div>

        <label>Start date</label>
        <div>
            <input name='startDate' type="date" placeholder="yyyy-mm-dd" value="<?php echo !empty($startDate) ? $startDate : ''; ?>">
            <?php if (!empty($startDateError)): ?>
                <span><?php echo $startDateError; ?></span>
            <?php endif; ?>
        </div>

        <div>
            <button type="submit">Create</button>
            <a href="../show/course_instance.php">Back</a>
        </div>
    </form>
</div>


</body>
</html>
