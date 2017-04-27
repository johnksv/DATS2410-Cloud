<?php

require '../Connection.php';
if(empty($_POST['id'])){   
	header("Location: ../show/studyprogram.php");
}else{

    $sPID = $_POST['id'];

if (!empty($_POST['courseCode'])) {
    // keep track validation errors
    $standardSemesterError = null;
    $courseCodeError = null;
	$typeError = null;

    // keep track post values
    $courseCode = $_POST['courseCode'];
    $standardSemester = $_POST['standardSemester'];
    $type = $_POST['type'];


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
        $standardSemesterError = 'Please choose a standard amount of semesters';
        $valid = false;
    } elseif(!is_numeric($standardSemester)){
		$standardSemesterError = 'Be kind and use a number.';
        $valid = false;
	}

    // insert data
    if ($valid) {
        $conn = Connection::connect();
		$sql = null;
        if($type == "M"){
			$sql = "INSERT INTO MandatoryCourse (sPID, courseCode, standardSemester) values('$sPID', '$courseCode', '$standardSemester')";
		}else{
				$sql = "INSERT INTO ElectiveCourse (sPID, courseCode, standardSemester) values('$sPID', '$courseCode', '$standardSemester')";
		}
        $result = $conn->query($sql);
        Connection::disconnect();
		
        header("Location: ../show/studyprograminfo.php?id=$sPID");
    }
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
readfile("../htmlTemplate/header.html");
?>

    <h3>Add a course to <?php echo $sPID; ?></h3>

    <form action="programcourses.php" method="post">
        
        <label>Course code</label>
        <div>
            <select name='courseCode'>
                <option value="">Choose course</option>
                <?php
                require_once '../Connection.php';
                $conn = Connection::connect();

                $sql = "SELECT courseCode, courseTitle FROM Course";
                $result = $conn->query($sql);
                // output data of each row
                while ($row = $result->fetch_assoc()) {
                    $selected = (!empty($courseCode) && $courseCode == $row['courseCode']) ? 'selected' : ' ';
                    echo "<option value='" . $row['courseCode'] . "' " . $selected . ">" . $row['courseCode'] . " " . $row['courseTitle'] . "</option>";
                }
                Connection::disconnect();
                ?>

            </select>

            <?php if (!empty($courseCodeError)): ?>
                <span><?php echo $courseCodeError; ?></span>
            <?php endif; ?>
        </div>
		<label>Standard Semester</label>
		<div>
            <input name="standardSemester" type="number"
                   value="<?php echo !empty($standardSemester) ? $standardSemester : ''; ?>">
            <?php if (!empty($standardSemesterError)): ?>
                <span><?php echo $standardSemesterError; ?></span>
            <?php endif; ?>
        </div>
		Type: <?php if (!empty($typeError)){ echo $typeError; } ?>
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
            <a href="../show/studyprograminfo.php?id=$sPID">Back</a>
        </div>
    </form>
</main>

<?php include '../htmlTemplate/footer.php'; ?>
</body>
</html>