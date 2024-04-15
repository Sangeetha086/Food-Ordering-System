<?php
$conn = new mysqli('localhost', 'root', '', 'canteen');

if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
} else {
    $sql = "SELECT foodname, foodprice, foodimage FROM menu";
    $result = mysqli_query($conn, $sql);

    // Generating HTML display
    if (mysqli_num_rows($result) > 0) {
        echo generateTable($result);
    } else {
        echo "No results found";
    }

    // Closing the database connection
    mysqli_close($conn);
}


function generateTable($result) {
    $table = '<table>';
    $table .= '<thead><tr><th>Food Name</th><th>Food Price</th><th>Edit</th><th>Delete</th></tr></thead>';
    $table .= '<tbody>';
    while ($row = mysqli_fetch_assoc($result)) {
        $table .= '<tr>';
        $table .= '<td>' . $row['foodname'] . '</td>';
        $table .= '<td>₹' . $row['foodprice'] . '</td>';

        // Edit button
        $table .= '<td><button onclick="openEditModal(\'' . $row['foodname'] . '\',' . $row['foodprice'] . ')">Edit</button></td>';
        // Delete button
        $table .= '<td><a href="del.php?foodname=' . $row['foodname'] . '" class="btn btn-danger">Delete</a></td>';
        $table .= '</tr>';
    }
    $table .= '</tbody></table>';
    return $table;
}

?>

