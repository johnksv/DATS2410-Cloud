<?php
require_once '../connection.php';
$conn = connection::connect();

$sql = "SELECT * FROM Student";
$result = $conn->query($sql);
?>
<html>
    <head>
        
    </head>
    <body>

        <div class="container">
            <div class="row">
                <h3>Students</h3>
                <button><a href="../insert/student.php" >Create new entry</a></button>
            </div>
 
            <div class="row">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>

                            <th>sPID</th>
                            <th>sPName</th>
                            <th>durationSemester</th>
                            <th>startYear</th>
                            <th>  </th>
                            <th>  </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()) { ?>
                            <tr>
                                <td><?php echo $row['sPID'] ?></td>
                                <td><?php echo $row['sPName'] ?></td>
                                <td><?php echo $row['durationSemester'] ?></td>
                                <td><?php echo $row['startYear'] ?></td>
                                <td> 
                                    <form action="../update/student.php" method="post">
                                        <input type="hidden" name="studentID" value="<?php echo $row['studentID'] ?>">
                                        <input type="submit"  name="Change" value="Edit"><br>

                                    </form>
                                </td>
                                <td> 
                                    <form action="delete.php" method="post">
                                        <input type="hidden" name="id" value="<?php echo $row['studentID'] ?>">
                                        <input type="hidden" name="type" value="student">
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

