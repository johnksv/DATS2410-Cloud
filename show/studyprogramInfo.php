<?php
require_once '../Connection.php';
$conn = Connection::connect();

$sql = "Select *  from ElectiveCourse WHERE sPID='" . $_POST["id"] . "' ";

$result1 = $conn->query($sql);
$sql = "Select *  from MandatoryCourse WHERE sPID='" . $_POST["id"] . "' ";

$result2 = $conn->query($sql);

?>
<html>
    <head>
        <?php readfile("../htmlTemplate/head.html");  ?>
    </head>
    <body>
        
    <?php
    //Insert header
    echo  $_POST["id"] ;
    readfile("../htmlTemplate/header.html");
    ?>


    <main class="container">
            <div class="row">
                <h3>Elective and mandatory courses</h3>
            </div>
 
            <div class="row">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>

                            <th>sPID</th>
                            <th>courseCode</th>
                            <th>standardSemester</th>
                            <th>  </th>
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
                                    <form action="../update/studyprogramInfo.php" method="post">
                                        <input type="hidden" name="sPID" value="<?php echo $row['sPID'] ?>">
                                        <input type="submit"  name="Change" value="Edit"><br>

                                    </form>
                                </td>
                                <td> 
                                    <form action="deleteInfo.php" method="post">
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
                                    <form action="../update/studyprogramInfo.php" method="post">
                                        <input type="hidden" name="sPID" value="<?php echo $row['sPID'] ?>">
                                        <input type="submit"  name="Change" value="Edit"><br>

                                    </form>
                                </td>
                                <td> 
                                    <form action="deleteInfo.php" method="post">
                                        <input type="hidden" name="id" value="<?php echo $row['sPID'] ?>">
                                        <input type="hidden" name="course" value="<?php echo $row['courseCode'] ?>">
                                        <input type="hidden" name="type" value="mandatory">
                                        <input type="submit"  name="Delete" value="Delete"><br>

                                    </form>
                                </td>
                            </tr>
                        <?php }
                        Connection::disconnect();
                        ?>
                    </tbody>
                </table>
            </div>
        </main>

    <?php include '../htmlTemplate/footer.php'; ?>
    </body>
</html>