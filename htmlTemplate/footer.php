<?php
require_once '../Connection.php';
$conn = Connection::connect();
$dbHostInfo = $conn->host_info;
Connection::disconnect();

$datetime = date("j F, Y, H:i");

?>
<footer>
    <div>
        <p>You are served by the server IP: <b><?php echo $_SERVER['SERVER_ADDR']; ?> </b></p>
        <p>Database IP: <b><?php echo "$dbHostInfo" ?> </b></p>

        <p> On: <b> <?php echo "$datetime" ?></b> </p>

        <p>Group 8</p>
    </div>
</footer>