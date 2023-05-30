<?php
$hostname = '127.0.0.1';
$username = 'root';
$database = 'green_garden';
// Fetch and display user data from the database table
$conn = new mysqli($hostname, $username, 'root', $database);
$query = "SELECT * FROM users";
$result = mysqli_query($conn, $query);

if ($result) {
  echo "<h2>Users Table</h2>";
  echo "<table class='table'>";
  echo "<thead class='thead-dark'>";
  echo "<tr>";
  echo "<th>ID</th>";
  echo "<th>Name</th>";
  echo "<th>Email</th>";
  echo "<th>Phone</th>";
  echo "<th>Actions</th>";
  echo "</tr>";
  echo "</thead>";
  echo "<tbody>";
  
  while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>".$row['id']."</td>";
    echo "<td>".$row['name']."</td>";
    echo "<td>".$row['email']."</td>";
    echo "<td>".$row['phone']."</td>";
    echo "<td>
          <a href='update_user.php?id=".$row['id']."'>Edit</a> | 
          <a href='delete_user.php?id=".$row['id']."'>Delete</a>
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