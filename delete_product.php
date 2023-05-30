<?php
$hostname = '127.0.0.1';
$username = 'root';
$database = 'green_garden';

// Check if the product ID is provided
if (!isset($_GET['id'])) {
    echo 'Product ID not provided.';
    exit;
}

// Fetch the product data from the database
$conn = new mysqli($hostname, $username, 'root', $database);
$productID = $_GET['id'];
$query = "SELECT * FROM products WHERE id = $productID";
$result = mysqli_query($conn, $query);
$product = mysqli_fetch_assoc($result);

// Check if the product exists
if (!$product) {
    echo 'Product not found.';
    exit;
}

// Process the delete request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the delete confirmation is received
    if (isset($_POST['confirm_delete'])) {
        

        // Delete the product from the database
        $deleteQuery = "DELETE FROM products WHERE id = $productID";
        try{
            $deleteResult = mysqli_query($conn, $deleteQuery);
        }
        catch (mysqli_sql_exception $e) {
            // Handle the exception
            if ($e->getCode() === 1451) {
                $errorMessage = "Cannot delete the product. It has foreign key constraints in another table.";
                echo '<script type="text/javascript">';
                echo 'document.addEventListener("DOMContentLoaded", function() {';
                echo '    var errorMessage = "' . $errorMessage . '";';
                echo '    var sqlErrorDiv = document.querySelector(".validate_error");';
                echo '    sqlErrorDiv.innerHTML = "<ul><li>" + errorMessage + "</li></ul>";';
                echo '});';
                echo '</script>';
            }
        }
        if ($deleteResult) {
            // Redirect to the desired page after successful deletion
            header('Location: admin.php?table=products');
            exit;
        } else {
            echo 'Error deleting product: ' . mysqli_error($conn);
        }
    } else {
        // User canceled the deletion
        header('Location: admin.php?table=products');
        exit;
    }
}

// Close the database connection
mysqli_close($conn);
?>

<?php include('index_head.php'); ?>
<body>
    <h2 class ="edit_label">Delete Product</h2>
    <form class = "delete_form"method="POST" action="delete_product.php?id=<?php echo $product['id']; ?>">
        <p class = "authentication">Are you sure you want to delete the product "<?php echo $product['name']; ?>"?</p>
        <button type="submit" name="confirm_delete" >Delete</button>
        <button type="button" onclick="window.location.href='admin.php?table=products'">Cancel</button>
        <div class ="validate_error"></div>
    </form>
    
</body>
</html>
