<!DOCTYPE html>
<html>
<head>
    <?php
//		require_once '../Connection.php';
		readfile("html/head.html");
		?>
</head>
<body>

<?php
require_once 'Connection.php';
$footerConn = (new Connection())->connect();
$dbHostInfo = $footerConn->host_info;
$footerConn->close();

$datetime = date("j F, Y, H:i");

$site = $_SERVER['REQUEST_URI'];

$student = "/show/student.php";
$course = "/show/course.php";
$program = "/show/studyprogram.php";


?>


<header>
    <nav>
        <!-- Need this ugly formating to render correctly without padding between the tags -->
        <a <?php if ($site === ""){ ?> class="active"
                                       <?php } ?>href="<?php echo $home; ?>">Home</a><a <?php if ($site === $student) { ?> class="active" <?php } ?>
                href="<?php echo $student; ?>">Students</a><a <?php if ($site === $program) { ?> class="active" <?php } ?>
                href="<?php echo $program; ?>">Programs</a><a <?php if ($site === $course) { ?> class="active" <?php } ?>
                href="<?php echo $course; ?>">Courses</a>
    </nav>

    <div>
        <p>You are served by the server IP: <b><?php echo $_SERVER['SERVER_ADDR']; ?> </b></p>
        <p>Database IP: <b><?php echo "$dbHostInfo" ?> </b></p>

        <p> On: <b> <?php echo "$datetime" ?></b></p>

        <p>Group 8</p>
    </div>
</header>

<main>
	<div class="shadow">
		<h2>
			Oblig 3 Group 8
		</h2>
		<p>This page is made by group 8 and there four members:</p>
		<ul>
			<li>s305046 - Benjamin Holsten</li>
			<li>s305080 - Truls Stenrud</li> 
			<li>s305084 - Stian Stensli</li>
			<li>s305089 - John Kasper Svergja</li>
		</ul>
		<p>	The backend is designed as following:</p>
		<img src="backend.PNG" alt="Backend design" style="width:50%;height:50%;">
	</div>
</main>

</body>
</html>