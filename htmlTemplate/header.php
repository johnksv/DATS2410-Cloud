<?php

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
</header>
