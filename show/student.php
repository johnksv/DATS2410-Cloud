<html>
<body>

<div class="container">
        <div class="row">
            <h3>Students</h3>
        </div>
       
        <div class="row">
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    
                    <th>Firstname</th>
                    <th>Lastname</th>
                    <th>Email</th>
                    <th>StartYear</th>
                    <th>StudentID</th>
                    <th>  </th>
                    <th>  </th>
                </tr>
                </thead>
                <tbody>
<?php
require_once '../phpcode/Connection.php';
$conn = Connection::connect();

$sql = "SELECT * FROM Student";
$result = $conn->query($sql);
 while($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>'. $row['firstName'] . '</td>';
        echo '<td>'. $row['lastName'] . '</td>';
        echo '<td>'. $row['email'] . '</td>';
        echo '<td>'. $row['startYear'] . '</td>';
        echo '<td>'. $row['studentID'] . '</td>';
        echo '<td>' . 
            '<form action="../update/student.php" method="post">
            <input type="hidden" name="studentID" value="' . $row['studentID'] . '">
            <input type="submit"  name="Change" value="Edit"><br>
            
        </form>'. '</td>';
        echo '<td>' . 
            '<form method="post">
            <input type="hidden" value="' . $row['studentID'] . '">
            <input type="submit"  name="Delete" value="Delete"><br>
            
        </form>'. '</td>';
        
        echo '</tr>';
    }

$conn->close();
?>
   </tbody>
            </table>
        </div>
    </div>
</body>
</html>


