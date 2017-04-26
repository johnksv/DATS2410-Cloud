<?php
require_once '../Connection.php';
$conn = Connection::connect();

$sql = "Select *  from ElectiveCourse WHERE sPID='" . $_GET["id"] . "' ";

$result1 = $conn->query($sql);
$sql = "Select *  from MandatoryCourse WHERE sPID='" . $_GET["id"] . "' ";

$result2 = $conn->query($sql);
Connection::disconnect();
?>
<html>
    <head>
        <?php readfile("../htmlTemplate/head.html");  ?>
    </head>
    <body>

    <?php
    //Insert header
    readfile("../htmlTemplate/header.html");
    ?>


    <main class="container">
            <div class="row">
                <h3>Elective and mandatory courses</h3>
            </div>

                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>

                            <th>sPID</th>
                            <th>courseCode</th>
                            <th>standardSemester</th>
                            <th>  </th>
                            <th>  </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result1->fetch_assoc()) { ?>
                            <tr>
                                <td><?php echo $row['sPID'] ?></td>
                                <td><?php echo $row['courseCode'] ?></td>
                                <td><?php echo $row['standardSemester'] ?></td>
                                <td>Elective</td>
                                <td>
                                    <form action="delete.php" method="post">
                                        <input type="hidden" name="id" value="<?php echo $row['sPID'] ?>">
                                        <input type="hidden" name="course" value="<?php echo $row['courseCode'] ?>">
                                        <input type="hidden" name="type" value="elective">
                                        <input type="submit"  name="Delete" value="Delete"><br>

                                    </form>
                                </td>


                            </tr>
                        <?php }
                        while ($row = $result2->fetch_assoc()) { ?>
                            <tr>
                                <td><?php echo $row['sPID'] ?></td>
                                <td><?php echo $row['courseCode'] ?></td>
                                <td><?php echo $row['standardSemester'] ?></td>
                                <td>mandatory</td>
                                
                                <td>
                                    <form action="delete.php" method="post">
                                        <input type="hidden" name="id" value="<?php echo $row['sPID'] ?>">
                                        <input type="hidden" name="course" value="<?php echo $row['courseCode'] ?>">
                                        <input type="hidden" name="type" value="mandatory">
                                        <input type="submit" name="Delete" value="Delete"><br>

                                    </form>
                                </td>
                            </tr>							
                        <?php }?>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td>
								<form action="../insert/programcourses.php" method="post">
									<input type="hidden" name="id" value="<?php echo $_GET["id"] ?>">
									<input type="submit" value="ADD"><br>
								</form>
							</td>
						</tr>
                    </tbody>
                </table>
				
            
        </main>

    <?php include '../htmlTemplate/footer.php'; ?>
    </body>
</html>