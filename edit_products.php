<?php
$hostname = '127.0.0.1';
$username = 'root';
$database = 'green_garden';
// Fetch and display user data from the database table
$conn = new mysqli($hostname, $username, 'root', $database);
$query = "SELECT * FROM products";
$result = mysqli_query($conn, $query);

if ($result) {
  echo "<h2>Products Table <a class = 'db_insert' href='insert_product.php?table=product'>Insert</a></h2>";
  echo "<table class='table'>";
  echo "<thead class='thead-dark'>";
  echo "<tr>";
  echo "<th>ID</th>";
  echo "<th>Category ID</th>";
  echo "<th>Name</th>";
  echo "<th>Price</th>";
  echo "<th>Description ID</th>";
  echo "<th>Actions</th>";
  echo "</tr>";
  echo "</thead>";
  echo "<tbody>";
  
  while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>".$row['id']."</td>";
    echo "<td>".$row['category_id']."</td>";
    echo "<td>".$row['name']."</td>";
    echo "<td>".$row['price']."</td>";
    echo "<td>".$row['description_id']."</td>";
    echo "<td>
          <a href='update_product.php?id=".$row['id']."'>Edit</a> | 
          <a href='delete_product.php?id=".$row['id']."'>Delete</a>
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