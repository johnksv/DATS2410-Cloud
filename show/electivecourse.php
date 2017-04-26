<?php
require_once '../phpcode/Connection.php';
$conn = Connection::connect();

$sql = "SELECT * FROM electivecourse";
$result = $conn->query($sql);
?>
<html>
    <head>
        
    </head>
    <body>

        <div class="container">
            <div class="row">
                <h3>Students</h3>
                <button><a href="../insert/electivecourse.php" >Create new entry</a></button>
            </div>
 
            <div class="row">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>

                            <th>sPID</th>
                            <th>Course code</th>
                            <th> Standard semester</th>
                            <th>  </th>
                            <th>  </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()) { ?>
                            <tr>
                                <td><?php echo $row['sPID'] ?></td>
                                <td><?php echo $row['courseCode'] ?></td>
                                <td><?php echo $row['standardSemester'] ?></td>
                                <td> 
                                    <form action="../update/elective.php" method="post">
                                        <input type="hidden" name="sPID" value="<?php echo $row['sPID'] ?>">
                                        <input type="submit"  name="Change" value="Edit"><br>

                                    </form>
                                </td>
                                <td> 
                                    <form action="delete.php" method="post">
                                        <input type="hidden" name="id" value="<?php echo $row['sPID'] ?>">
                                        <input type="hidden" name="type" value="electivecourse">
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