<?php
$hostname = '127.0.0.1';
$username = 'root';
$database = 'green_garden';

$productID = trim(htmlentities($_POST['id']));
$name =  trim(htmlentities($_POST['name']));
$email =  trim(htmlentities($_POST['email']));
$location =trim(htmlentities($_POST['location']));
$errors = array();

// Check if the product ID is provided
if (!isset($_POST['id'])) {
    $errors['id'] = 'Product ID not provided';
    exit;
}

// Fetch the product data from the database
$conn = new mysqli($hostname, $username, 'root', $database);
$query = "SELECT * FROM products WHERE id = $productID";
$result = mysqli_query($conn, $query);
$product = mysqli_fetch_assoc($result);

// Check if the product exists
if (!$product) {
    $errors['product'] = 'Product not found';
    exit;
}

$query = "SELECT id FROM users 
        WHERE email = '$email' AND name = '$name'; ";  
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
print $row['id'];
if ($row) {
} else {
    print "row empty";
}

$check_row = "SELECT * from cart c
              left join products p
              ON c.product_id = p.id
              where c.user_id = ".$row['id']." and c.product_id = ".$productID.";";
$result = mysqli_query($conn, $check_row);
$cartRow = mysqli_fetch_assoc($result);
print_r ($cartRow);
// Process the form submission
if ($result->num_rows > 0) {
    // Retrieve the submitted form data
    $updateQuery  = "UPDATE cart
                     set quantity=".$cartRow['quantity']." + 1,
                     final_price = ".$cartRow['price']."*(".$cartRow['quantity']."+1)
                     where  user_id = ".$row['id']." and product_id = ".$productID.";";
    $result = mysqli_query($conn, $updateQuery);
    if ($result) {
        // Redirect to the desired page after successful update
        //header('Location: '.$location);
        exit();
    } else {
        echo 'Error updating product: ' . mysqli_error($conn);
    }  
} else {
    $quary = "SELECT price from products where id = ".$productID.";";
    $result = mysqli_query($conn, $quary);
    $price = mysqli_fetch_assoc($result);
    $insertQuery = "INSERT into cart      
                        (quantity, user_id,product_id,final_price)
                        values (1, ". $row['id'] .",".$productID.",".$price['price'].");";
    $result = mysqli_query($conn, $insertQuery);
    if ($result) {
        // Redirect to the desired page after successful update
        //header('Location: '.$location);
        exit();
    } else {
        echo 'Error updating product: ' . mysqli_error($conn);
    }
}   

// Close the database connection
mysqli_close($conn);
?>
