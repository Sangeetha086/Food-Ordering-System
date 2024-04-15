<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rep1";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

include 'connect.php';

$name = $_POST['name'];
$email = $_POST['email'];
$complaint = $_POST['complaint'];

$sql = "INSERT INTO report1 (name, email) VALUES ('$name', '$email','$complaint')";

if ($conn->query($sql) === TRUE) {
    echo "Record added successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
