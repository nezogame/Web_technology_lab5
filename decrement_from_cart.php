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

if ($row) {
} else {
    echo "row empty";
}

$check_row = "SELECT * from cart c
              left join products p
              ON c.product_id = p.id
              where c.user_id = ".$row['id']." and c.product_id = ".$productID.";";
$result = mysqli_query($conn, $check_row);
$cartRow = mysqli_fetch_assoc($result);

// Process the form submission
if ($result->num_rows > 0) {
    // Retrieve the submitted form data
    $currentQuantity = $cartRow['quantity'];
    if ($currentQuantity == 1) {
        $deleteQuery = "DELETE FROM cart WHERE user_id = ".$row['id']." AND product_id = ".$productID.";";
        $result = mysqli_query($conn, $deleteQuery);
        if ($result) {
            // Redirect to the desired page after successful deletion
            //header('Location: '.$location);
            exit();
        } else {
            echo 'Error deleting product: ' . mysqli_error($conn);
        }
    } else {
        $updateQuery = "UPDATE cart
                        SET quantity = ".($currentQuantity - 1).",
                        final_price = ".$cartRow['price']." * (".($currentQuantity - 1).")
                        WHERE user_id = ".$row['id']." AND product_id = ".$productID.";";
        $result = mysqli_query($conn, $updateQuery);
        if ($result) {
            // Redirect to the desired page after successful update
            //header('Location: '.$location);
            exit();
        } else {
            echo 'Error updating product: ' . mysqli_error($conn);
        }
    }
} else {
    echo 'Product not found in cart';
}

// Close the database connection
mysqli_close($conn);

?>