<?php
// Establish database connection
$conn = new mysqli('localhost', 'root', '', 'canteen');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve data from POST request
if(isset($_POST['namee'],$_POST['orderId'], $_POST['tableNum'], $_POST['phoneNum'], $_POST['dateTime'], $_POST['cart'])){
    $name=$_POST['namee'];
    $orderID = $_POST['orderId'];
    $tableNum = $_POST['tableNum'];
    $phoneNum = $_POST['phoneNum'];
    $dateTime = $_POST['dateTime']; 
    $cart = json_decode($_POST['cart'], true);
    // Prepare and bind SQL statement for inserting order
    $stmt = $conn->prepare("INSERT INTO orders (oname,orderid, phonenum, tablenum, order_datetime) VALUES (?,?, ?, ?, ?)");
    $stmt->bind_param("sssss",$name, $orderID, $phoneNum, $tableNum, $dateTime);
    
    // Execute statement for inserting order
    if ($stmt->execute()) {
        echo "Order inserted successfully! <br>";

        // Prepare SQL statement for selecting food items
        $stmt = $conn->prepare("SELECT foodid FROM fooditems WHERE foodname = ?");
        $stmt->bind_param("s", $itemName);

        // Loop through each item in the cart
        foreach ($cart as $item) {
            $itemName = $item['name']; // Assuming the key is 'name' for item name in the cart

            // Execute statement for selecting food item
            $stmt->execute();
            $result = $stmt->get_result();

            // Check if a row is returned
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $foodId = $row['foodid'];

                // Prepare and bind SQL statement for inserting order items
                $stmt1 = $conn->prepare("INSERT INTO orderitems (orderid, foodid) VALUES (?, ?)");
                $stmt1->bind_param("si", $orderID, $foodId); // Assuming both orderid and foodid are integers

                // Execute statement for inserting order item
                if ($stmt1->execute()) {
                   // echo "Order item inserted successfully! <br>";
                } else {
                    echo "Error inserting order item: " . $stmt1->error;
                    $stmt1->close();
                    continue; // Continue to next item if there's an error
                }
                $stmt1->close();
            } else {
                echo "No food item found for $itemName <br>";
            }
        }
    } else {
        echo "Error inserting order: " . $stmt->error;
        $conn->close();
        exit(); // Exit script if there's an error
    }
    $stmt->close();
} else {
    echo "One or more required fields are missing in the POST request.";
}

// Close database connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You</title>
    <style>
        /* Styles for the thank you page */
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
            margin-bottom: 20px; /* Added margin */
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="thank_you.gif" alt="Thank You">
        <p>Your order has been placed successfully!</p>
        <button onclick="goToHomePage()">Go to Home Page</button>
        <button onclick="goToPaymentPage()">Proceed to Payment</button> <!-- Added button for payment -->
    </div>

    <script>
        // Function to redirect to the home page
        function goToHomePage() {
            window.location.href = "home2.html"; // Replace 'home2.html' with the actual URL of your home page
        }

        // Function to redirect to the payment page
        function goToPaymentPage() {
            window.location.href = "payment.html"; // Replace 'payment.html' with the URL of your payment page
        }
    </script>
</body>
</html>
