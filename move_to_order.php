<?php
$hostname = '127.0.0.1';
$username = 'root';
$database = 'green_garden';

$userID = trim(htmlentities($_POST['id']));

$errors = array();

// Check if the product ID is provided
if (!isset($_POST['id'])) {
    $errors['id'] = 'User ID not provided';
    exit;
}

// Fetch the product data from the database
$conn = new mysqli($hostname, $username, 'root', $database);
$query = "SELECT c.user_id, p.name, c.quantity, c.final_price
          FROM cart c
          left join products p
          on c.product_id = p.id
          WHERE c.user_id = ".$userID.";";
$result = mysqli_query($conn, $query);
if ($result) {
    while($row = mysqli_fetch_assoc($result)){
        $insertQuery = "INSERT into 
        orders (user_id, product_name, quantity,price, status)
        values ( ".$row['user_id'] .", '". $row['name'] ."'
                ,". $row['quantity'].", ". $row['final_price']."
                , 'WAITING');";
        $insertRes = mysqli_query($conn, $insertQuery);
    }
    $deleteQuery = "DELETE from cart where user_id = ".$userID.";";
    $result = mysqli_query($conn, $deleteQuery);
}else {
    echo 'Error select from cart: ' . mysqli_error($conn);
}
// Close the database connection
mysqli_close($conn);
?>
