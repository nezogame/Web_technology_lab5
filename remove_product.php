<?php
$hostname = '127.0.0.1';
$username = 'root';
$database = 'green_garden';

// Check if the product ID is provided
if (!isset($_POST['id'])) {
    echo 'Product ID not provided.';
    exit;
}

// Fetch the product data from the database
$conn = new mysqli($hostname, $username, 'root', $database);
$cartID = $_POST['id'];

// Check if the product exists
if (!$cartID) {
    echo 'Product in cart not found.';
    exit;
}

// Process the delete request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
 
    
    $query = "DELETE FROM cart WHERE id = $cartID ";
    $deleteResult = mysqli_query($conn, $query);
    if ($deleteResult) {
        // Redirect to the desired page after successful deletion
        
        exit;
    } else {
        echo 'Error deleting product: ' . mysqli_error($conn);
    }
    
}

// Close the database connection
mysqli_close($conn);
?>

