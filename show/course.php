<?php
require_once '../connection.php';
$conn = connection::connect();

$sql = "SELECT * FROM Course";
$result = $conn->query($sql);
?>
<html>
    <head>
        
    </head>
    <body>

        <div class="container">
            <div class="row">
                <h3>Courses</h3>
                <button><a href="../insert/course.php" >Create new entry</a></button>
            </div>
            
            <div class="row">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>

                            <th>Course code</th>
                            <th>Course title</th>
                            <th>Semester</th>
                            <th>  </th>
                            <th>  </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()) { ?>
                            <tr>
                                <td><?php echo $row['courseCode'] ?></td>
                                <td><?php echo $row['courseTitle'] ?></td>
                                <td><?php echo $row['Semester'] ?></td>
                                <td> 
                                    <form action="../update/course.php" method="post">
                                        <input type="hidden" name="studentID" value="<?php echo $row['courseCode'] ?>">
                                        <input type="submit"  name="Change" value="Edit"><br>

                                    </form>
                                </td>
                                <td> 
                                    <form action="delete.php" method="post">
                                        <input type="hidden" name="id" value="<?php echo $row['courseCode'] ?>">
                                        <input type="hidden" name="type" value="course">
                                        <input type="submit"  name="Delete" value="Delete"><br>

                                    </form>
                                </td>
                            </tr>
                        <?php }
                        $conn->close();
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>


