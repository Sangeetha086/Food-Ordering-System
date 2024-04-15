<!DOCTYPE html>
<html>
<head>
    <title>Contact Information</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #ddd;
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
        @media only screen and (max-width: 600px) {
            table {
                border: none;
            }
            table tr {
                border-bottom: 2px solid #ddd;
                display: block;
                margin-bottom: 10px;
            }
            table td {
                display: block;
                text-align: right;
                border-bottom: none;
            }
            table td::before {
                content: attr(data-label);
                font-weight: bold;
                text-transform: uppercase;
                margin-right: 10px;
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

// Retrieve data from contact table
$sql = "SELECT * FROM contact";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>Name</th><th>Number</th><th>Email</th><th>Message</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td data-label='Name'>".$row["name"]."</td><td data-label='Number'>".$row["number"]."</td><td data-label='Email'>".$row["email"]."</td><td data-label='Message'>".$row["message"]."</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}
$conn->close();
?>

</body>
</html>
