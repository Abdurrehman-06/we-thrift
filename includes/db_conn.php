<?php
$servername = "localhost";
$username = "u902833837_we_thrift";
$password = "TdEFeyv+ju8*";
$dbname = "u902833837_we_thrift";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>
