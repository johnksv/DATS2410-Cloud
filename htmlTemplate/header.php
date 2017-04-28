<?php
//require_once '../Connection.php';
//$conn = Connection::connect();
//$dbHostInfo = $conn->host_info;
//Connection::disconnect();

$datetime = date("j F, Y, H:i");

$site = $_SERVER['REQUEST_URI'];

$student = "/show/student.php";
$course = "/show/course.php";
$program = "/show/studyprogram.php";


?>


<header>
    <nav>
        <!-- Need this ugly formating to render correctly without padding between the tags -->
        <a href="/">Home</a><a <?php if ($site === $student) { ?> class="active" <?php } ?>
                href="<?php echo $student; ?>">Students</a><a <?php if ($site === $course) { ?> class="active" <?php } ?>
                href="<?php echo $course; ?>">Courses</a><a <?php if ($site === $program){ ?> class="active"
                                                                                              <?php } ?>href="<?php echo $program; ?>">Programs</a>
    </nav>

    <div>
        <p>You are served by the server IP: <b><?php echo $_SERVER['SERVER_ADDR']; ?> </b></p>
        <p>Database IP: <b><?php echo "$dbHostInfo" ?> </b></p>

        <p> On: <b> <?php echo "$datetime" ?></b></p>

        <p>Group 8</p>
    </div>
</header>
