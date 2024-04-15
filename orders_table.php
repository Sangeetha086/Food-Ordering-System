<?php
$conn = new mysqli('localhost', 'root', '', 'canteen');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT o.oname,o.orderid, o.phonenum, o.tablenum,o.order_datetime, GROUP_CONCAT(f.foodname) AS foodnames, SUM(f.price) AS totalprice
FROM orders o
JOIN orderitems oi ON o.orderid = oi.orderid
JOIN fooditems f ON oi.foodid = f.foodid
GROUP BY o.orderid;
";



$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>Customer Name</th><th>Order ID</th><th>Phone Number</th><th>Table Number</th><th>Date & time</th>  <th>Food Items Ordered</th><th>Total Price</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>".$row["oname"]."</td>";
        echo "<td>".$row["orderid"]."</td>";
        echo "<td>".$row["phonenum"]."</td>";
        echo "<td>".$row["tablenum"]."</td>  ";
        echo "<td>".$row["order_datetime"]."</td>";
        echo "<td>".$row["foodnames"]."</td>";
        echo "<td>".$row["totalprice"]."</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}
$conn->close();
?>