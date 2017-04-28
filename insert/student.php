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
    $studentID = $_POST['studentID'];
    $email = $_POST['email'];
    $startYear = $_POST['startYear'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];


    // validate input
    $valid = true;
    if (empty($studentID)) {
        $IDError = 'Please enter student ID';
        $valid = false;
    }

    if (empty($email)) {
        $emailError = 'Please enter Email Address';
        $valid = false;
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailError = 'Please enter a valid Email Address';
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
        $firstNameError = 'Please enter Name';
        $valid = false;
    }

    if (empty($lastName)) {
        $lastNameError = 'Please enter Mobile Number';
        $valid = false;
    }

    // insert data
    if ($valid) {
        $conn = Connection::connect();
        $sql = "INSERT INTO Student (studentId, email, startYear, firstName, lastName) values('$studentID', '$email', '$startYear', '$firstName', '$lastName')";

        $result = $conn->query($sql);
        Connection::disconnect();
        header("Location: ../show/student.php");
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
include '../htmlTemplate/header.php';
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

<?php include '../htmlTemplate/footer.php'; ?>
</body>
</html>
