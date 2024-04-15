<?php
$conn = new mysqli('localhost', 'root', '', 'canteen');
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
} else {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve and sanitize the posted data
        $foodName = $_POST['foodName'];
        $foodPrice = $_POST['foodPrice'];
        $foodImage = $_FILES['foodImage']['tmp_name'];

        // Update the record in the database
        $imageData = file_get_contents($foodImage);
        $stmt = $conn->prepare("UPDATE menu SET foodprice = ?, foodimage = ? WHERE foodname = ?");
        $stmt->bind_param("sss", $foodPrice, $imageData, $foodName);
        $stmt->execute();
        $stmt->close();

        $stmt2 = $conn->prepare("UPDATE fooditems SET price = ? WHERE foodname = ?");
        $stmt2->bind_param("ss", $foodPrice, $foodName);
        $stmt2->execute();
        $stmt2->close();

        // Redirect back to the product management page
        header('Location: man-prod.html');
        exit(); // Ensure that subsequent code is not executed after redirection
    } else {
        // Invalid request method
        echo "Invalid request method.";
    }
}
?>
