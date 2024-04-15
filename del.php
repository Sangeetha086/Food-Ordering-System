<?php
$conn = new mysqli('localhost', 'root', '', 'canteen');

if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
} else {
    // Check if foodname parameter is set in GET request
    if (isset($_GET['foodname'])) {
        $foodName = $_GET['foodname'];
        
        // Prepare and execute the delete query for the menu table
        $stmt = $conn->prepare("DELETE FROM menu WHERE foodname = ?");
        $stmt->bind_param("s", $foodName);
        $stmt->execute();
        $stmt->close();

        // Prepare and execute the delete query for the fooditems table
        $stmt = $conn->prepare("DELETE FROM fooditems WHERE foodname = ?");
        $stmt->bind_param("s", $foodName);
        $stmt->execute();
        $stmt->close();

        // Redirect to Man-prod.html after deletion
        header('Location: Man-prod.html');
        exit(); // Ensure that subsequent code is not executed after redirection
    }
}
?>
