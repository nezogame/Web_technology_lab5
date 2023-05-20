<?php
$hostname = '127.0.0.1';
$username = 'root';
$database = 'green_garden';
// Fetch and display user data from the database table
$conn = new mysqli($hostname, $username, 'root', $database);
$query = "SELECT * FROM orders ;";
$result = mysqli_query($conn, $query);

if ($result) {
  echo "<h2>Order Table <a class = 'db_insert' href='insert_order.php?table=order'>Insert</a></h2>";
  echo "<table class='table'>";
  echo "<thead class='thead-dark'>";
  echo "<tr>";
  echo "<th>ID</th>";		
  echo "<th>User ID</th>";		
  echo "<th>Product</th>";
  echo "<th>Quantity</th>";
  echo "<th>Final price</th>";
  echo "<th>Order date</th>";
  echo "<th>Status</th>";
  echo "<th>Actions</th>";
  echo "</tr>";
  echo "</thead>";
  echo "<tbody>";
  
  while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>".$row['id']."</td>";
    echo "<td>".$row['user_id']."</td>";
    echo "<td>".$row['product_name']."</td>";
    echo "<td>".$row['uantity']."</td>";
    echo "<td>".$row['final_price']."</td>";
    echo "<td>".$row['order_date']."</td>";
    echo "<td>".$row['status']."</td>";
    echo "<td>
          <a href='update_category.php?id=".$row['id']."'>Edit</a> | 
          <a href='delete_category.php?id=".$row['id']."'>Delete</a>
          </td>";
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