<?php
require_once '../Connection.php';
$conn = Connection::connect();

$sql = "Select * ElectiveCourse WHERE sPID='" . $_POST["id"] . "' ";

$result = $conn->query($sql);
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
 
            <div class="row">
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
                        <?php while ($row = $result->fetch_assoc()) { ?>
                            <tr>
                                <td><?php echo $row['sPID'] ?></td>
                                <td><?php echo $row['courseCode'] ?></td>
                                <td><?php echo $row['standardSemester'] ?></td>
                                <td> 
                                    <form action="../update/studyprogramEM.php" method="post">
                                        <input type="hidden" name="sPID" value="<?php echo $row['sPID'] ?>">
                                        <input type="submit"  name="Change" value="Edit"><br>

                                    </form>
                                </td>
                                <td> 
                                    <form action="delete.php" method="post">
                                        <input type="hidden" name="id" value="<?php echo $row['sPID'] ?>">
                                        <input type="hidden" name="type" value="studyprogramEM">
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