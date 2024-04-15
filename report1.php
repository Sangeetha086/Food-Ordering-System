<?php
$Name = $_POST['Name'];
$Email = $_POST['Email'];
$Complaint = $_POST['Complaint'];

$conn = new mysqli('localhost', 'root', '', 'canteen');

if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
} else {
    $st = $conn->prepare("INSERT INTO complaints (name, email, complaint) VALUES (?, ?, ?)");
    $st->bind_param("sss", $Name, $Email, $Complaint);
    $st->execute();
    $st->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Submitted</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
            padding-top: 100px;
        }
        .container {
            max-width: 500px;
            margin: 0 auto;
        }
        img {
            margin-bottom: 30px;
        }
        button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="report_placed.gif" alt="Report Placed">
        <p>Your report has been successfully submitted!</p>
        <button onclick="goToHomePage()">Go to Home Page</button>
    </div>

    <script>
        function goToHomePage() {
            window.location.href = "home2.html"; // Replace 'home.php' with the actual URL of your home page
        }
    </script>
</body>
</html>
