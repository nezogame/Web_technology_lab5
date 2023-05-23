<?php
$hostname = '127.0.0.1';
$username = 'root';
$database = 'green_garden';
// Fetch and display user data from the database table
$conn = new mysqli($hostname, $username, 'root', $database);
$query = "SELECT c.id , c.product_id, p.name, c.user_id, c.quantity, c.final_price FROM cart c
          left join products p
          on p.id=c.product_id;";
$result = mysqli_query($conn, $query);

if ($result) {
  echo "<h2>Cart Table</h2>";
  echo "<table class='table'>";
  echo "<thead class='thead-dark'>";
  echo "<tr>";
  echo "<th>ID</th>";		
  echo "<th>Product ID</th>";
  echo "<th>Product Name</th>";
  echo "<th>User ID</th>";
  echo "<th>Quantity</th>";
  echo "<th>Final Price</th>";
  echo "</tr>";
  echo "</thead>";
  echo "<tbody>";
  
  while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>".$row['id']."</td>";
    echo "<td>".$row['product_id']."</td>";
    echo "<td>".$row['name']."</td>";
    echo "<td>".$row['user_id']."</td>";
    echo "<td>".$row['quantity']."</td>";
    echo "<td>".$row['final_price']."</td>";
    echo "</tr>";
  }

  echo "</tbody>";
  echo "</table>";
} else {
  echo "Error: " . mysqli_error($connection);
}

// Close the database connection
mysqli_close($conn);
?>