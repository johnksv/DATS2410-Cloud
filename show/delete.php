<?php
 
require_once '../phpcode/Connection.php';
$conn = Connection::connect();

$sql = "DELETE FROM Student WHERE studentID='".$_POST["id"]."' ";

if ($conn->query($sql) === TRUE) {
     header('Location: student.php');
} else {
    echo "Error deleting record: " . $conn->error;
}

$conn->close();
?>

