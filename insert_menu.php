<?php

$productName = $_POST['product-name'];
$productprice = $_POST['product-price'];
$productImage = $_FILES['product-image']['tmp_name'];

$conn = new mysqli('localhost', 'root', '', 'canteen');

if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
} else {
    $imageData = file_get_contents($productImage);
    $st = $conn->prepare("INSERT INTO menu (foodname, foodprice, foodimage) VALUES (?, ?, ?)");
    $st->bind_param("sss", $productName, $productprice, $imageData);
    $st->execute();

    $st->close();
    $sql = "SELECT foodid FROM fooditems ORDER BY foodid DESC LIMIT 1";
    $foodid_result = mysqli_query($conn, $sql);
    $id_row = mysqli_fetch_assoc($foodid_result);
    $last_foodid = $id_row['foodid'];

    $new_foodid = $last_foodid + 1;

    $st = $conn->prepare("INSERT INTO fooditems (foodid, foodname, price) VALUES (?, ?, ?)");
    $st->bind_param("iss", $new_foodid, $productName, $productprice);
    $st->execute();

    $st->close();
    $conn->close();
}
// Redirect to man-prod.html
header("Location: man-prod.html");
exit(); // Ensure that subsequent code is not executed after redirection

?>
