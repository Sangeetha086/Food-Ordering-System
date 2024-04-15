<?php
$conn = new mysqli('localhost', 'root', '', 'canteen');

if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
} else 
{
    $sql = "SELECT foodname, foodprice, foodimage FROM menu";
    $result = mysqli_query($conn, $sql);

    // Generating HTML display
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
           // Modify the MIME type according to your image type
           $image_data_base64 = base64_encode($row['foodimage']);
           $image_data_base64 = 'data:image/jpeg;base64,' . $image_data_base64; // Modify the MIME type according to your image type
           echo '<div class="menu-item" id="item2">';
           echo '<img src="' . $image_data_base64 . '" alt="Dish 12">';
           echo '<div class="item-info">';
           echo '<h2>' . $row['foodname'] . '</h2>';
           echo '<p class="price">₹' . $row['foodprice'] . '</p>';
            echo '</div>';
            echo '</div>';
        }
    } else {
        echo "No results found";
    }

    // Closing the database connection
    mysqli_close($conn);
}
?>
