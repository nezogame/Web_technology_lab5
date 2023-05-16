<?php
$hostname = '127.0.0.1';
$username = 'root';
$database = 'green_garden';
// Fetch and display user data from the database table
$conn = new mysqli($hostname, $username, 'root', $database);
$query = "SELECT c.id cart_id, c.product_id, c.quantity, o.id order_id, o.order_date, c.final_price
          FROM orders o
          left join cart c
          on c.id = o.cart_id;";
$result = mysqli_query($conn, $query);

if ($result) {
  echo "<h2>Order Table <a class = 'db_insert' href='insert_order.php?table=order'>Insert</a></h2>";
  echo "<table class='table'>";
  echo "<thead class='thead-dark'>";
  echo "<tr>";
  echo "<th>ID</th>";		
  echo "<th>Cart ID</th>";		
  echo "<th>Product ID</th>";
  echo "<th>User_id</th>";
  echo "<th>Quantity</th>";
  echo "<th>Order ID</th>";
  echo "<th>Order date</th>";
  echo "<th>Final price</th>";
  echo "<th>Actions</th>";
  echo "</tr>";
  echo "</thead>";
  echo "<tbody>";
  
  while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>".$row['cart_id']."</td>";
    echo "<td>".$row['product_id']."</td>";
    echo "<td>".$row['uantity']."</td>";
    echo "<td>".$row['order_id']."</td>";
    echo "<td>".$row['order_date']."</td>";
    echo "<td>".$row['final_price']."</td>";
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