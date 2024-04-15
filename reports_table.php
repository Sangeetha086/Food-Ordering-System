<!DOCTYPE html>
<html>
<head>
    <title>Complaints</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        @media only screen and (max-width: 600px) {
            /* Responsive layout */
            table, th, td {
                display: block;
            }
            th, td {
                text-align: center;
            }
        }
    </style>
</head>
<body>

<?php
$conn = new mysqli('localhost', 'root', '', 'canteen');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve data from complaints table
$sql = "SELECT * FROM complaints";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>Customer Name</th><th>Email ID</th><th>Complaint</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["name"]."</td><td>".$row["email"]."</td><td>".$row["complaint"]."</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}
$conn->close();
?>

</body>
</html>
