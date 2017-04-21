<?php
ini_set('error_reporting', E_ALL);
?>
    <body>
    <div class="container">
        <div class="row">
            <h3>Students</h3>
        </div>
        <div class="row">
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Firstname</th>
                    <th>Lastname</th>
                    <th>Email</th>
                    <th>StartYear</th>
                </tr>
                </thead>
                <tbody>
<?php
include 'database.php';
// Create connection
$conn = Database::connect();
//echo "Connected successfully. ";
//$conn->select_db("studentinfosys");
$sql = "SELECT * FROM Student";
$result = $conn->query($sql);
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>'. $row['studentID'] . '</td>';
        echo '<td>'. $row['firstName'] . '</td>';
        echo '<td>'. $row['lastName'] . '</td>';
        echo '<td>'. $row['email'] . '</td>';
        echo '<td>'. $row['startYear'] . '</td>';
        echo '</tr>';
    }
Database::disconnect();
?>

                </tbody>
            </table>
        </div>
    </div> <!-- /container -->
    </body>
