<!-- CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(50),
    lastname VARCHAR(50),
    email VARCHAR(100),
    position_played VARCHAR(50),
    password VARCHAR(255)
); -->

<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "elly";

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>