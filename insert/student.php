<?php

require '../Connection.php';

if (!empty($_POST)) {
    // keep track validation errors
    $IDError = null;
    $emailError = null;
    $yearError = null;
    $firstNameError = null;
    $lastNameError = null;

    // keep track post values
    $studentID = filter_input(INPUT_POST, 'studentID');
    $email = filter_input(INPUT_POST, 'email');
    $startYear = filter_input(INPUT_POST, 'startYear');
    $firstName = filter_input(INPUT_POST, 'firstName');
    $lastName = filter_input(INPUT_POST, 'lastName');


    // validate input
    $valid = true;
    if (empty($studentID)) {
        $IDError = 'Please enter a student ID';
        $valid = false;
    } elseif (preg_match('/^s\d{6}$/', $studentID) != 1) {
        $IDError = 'Please enter valid student ID (sXXXXXX)';
        $valid = false;
    }

    if (empty($email)) {
        $emailError = 'Please enter email address';
        $valid = false;
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailError = 'Please enter a valid email address';
        $valid = false;
    }

    function validateDate($date)
    {
        $d = DateTime::createFromFormat('Y-m-d', $date);
        return $d && $d->format('Y-m-d') === $date;
    }

    if (empty($startYear)) {
        $yearError = 'Please enter date';
        $valid = false;
    }

    if (empty($firstName)) {
        $firstNameError = 'Please enter name';
        $valid = false;
    }

    if (empty($lastName)) {
        $lastNameError = 'Please enter mobile number';
        $valid = false;
    }

    // insert data
    if ($valid) {
        $conn = (new Connection())->connect();
        $stat = $conn->prepare("INSERT INTO Student (studentId, email, startYear, firstName, lastName) values(?, ?, ?, ?, ?)");
        $stat->bind_param("sssss", $studentID, $email, $startYear, $firstName, $lastName);
        $stat->execute();
        $conn->close();
        header("Location: ../show/student.php");
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

    <h3>Create a Student</h3>

    <form action="student.php" method="post">

        <label>Student ID</label>
        <div>
            <input name="studentID" type="text" placeholder="sxxxxxx"
                   value="<?php echo !empty($studentID) ? $studentID : ''; ?>">
            <?php if (!empty($IDError)): ?>
                <span><?php echo $IDError; ?></span>
            <?php endif; ?>
        </div>
        <label>Email</label>
        <div>
            <input name="email" type="email" placeholder="my.example@example.com"
                   value="<?php echo !empty($email) ? $email : ''; ?>">
            <?php if (!empty($emailError)): ?>
                <span><?php echo $emailError; ?></span>
            <?php endif; ?>
        </div>

        <label>Start year</label>
        <div>
            <input name="startYear" type="date" placeholder="yyyy-mm-dd"
                   value="<?php echo !empty($startYear) ? $startYear : ''; ?>">
            <?php if (!empty($yearError)): ?>
                <span><?php echo $yearError; ?></span>
            <?php endif; ?>
        </div>

        <label>First Name</label>
        <div>
            <input name="firstName" type="text" placeholder="First Name"
                   value="<?php echo !empty($firstName) ? $firstName : ''; ?>">
            <?php if (!empty($firstNameError)): ?>
                <span><?php echo $firstNameError; ?></span>
            <?php endif; ?>
        </div>

        <label>Last Name</label>
        <div>
            <input name="lastName" type="text" placeholder="Last Name"
                   value="<?php echo !empty($lastName) ? $lastName : ''; ?>">
            <?php if (!empty($lastNameError)): ?>
                <span><?php echo $lastNameError; ?></span>
            <?php endif; ?>
        </div>

        <div>
            <button type="submit">Create</button>
            <a href="../show/student.php">Back</a>
        </div>
    </form>
</main>


</body>
</html>
