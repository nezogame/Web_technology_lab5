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

// Process the form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the submitted form data
    $errors = array();
    $newProductId = $_POST['product_id'];
    $newName = $_POST['name'];
    $newPrice = $_POST['price'];

    print ($newProductId);     
    print ($newName);
    print ($newPrice);
        
        if (isset($_POST['name'])) {
            $newName = trim(htmlentities($_POST['name']));
            if(!preg_match("/^[A-Za-z0-9\s\.,\-]+$/",$newName)){
                $errors['name'] = 'Будьбласка, перевірьте написання назви';
            }
        }else{
            $errors['name'] = 'Будьбласка, введіть назву';
        }
        

    // If there are no validation errors, update the product in the database
    if (empty($errors)) {
        $updateQuery = "UPDATE products 
                        SET product_id = '$newProductId', 
                            name = '$newName',
                            price = '$newPrice',
                        WHERE id = $productID";
        $updateResult = mysqli_query($conn, $updateQuery);
        if ($updateResult) {
            // Redirect to the desired page after successful update
            header('Location: admin.php');
            exit();
        } else {
            echo 'Error updating product: ' . mysqli_error($conn);
        }
    }else{
        print_r ($errors);
    }
}

// Close the database connection
mysqli_close($conn);
?>

<?php
    
    
    // Check if the product ID is provided
    if (!isset($_GET['id'])) {
        echo 'Product ID not provided.';
        exit;
    }
    
    $product_id = $_GET['id'];

    // Fetch the old data from the database based on the product ID
    $conn = new mysqli($hostname, $username, 'root', $database);
    $query = "SELECT * FROM products WHERE id = $product_id";
    $result = mysqli_query($conn, $query);
    $product = mysqli_fetch_assoc($result);
    mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="styles\style.css">
    <title>Edit Product</title>
</head>
<body>
    <h2 class = "edit_label">Edit Product</h2>
    <form class ="update_form"method="POST" action="update_product.php?id=<?php echo $product['id']; ?>">
    <div class="insert_field">
        <label for="product_id">product Id:</label>
        <input type="text" name="product_id" value="<?php echo $product['id']; ?>" required>
    </div>
    <div class="insert_field">
        <label for="name">Product Name:</label>
        <input type="text" name="name" value="<?php echo $product['name']; ?>" required>
    </div>
    <div class="insert_field">
        <label for="price">Product Price:</label>
        <input type="text" name="price" value="<?php echo $product['price']; ?>" required>
    </div>
        <?php if (!empty($errors)): ?>
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?php echo $error; ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
        <button class ="inser_but"type="submit">Submit</button>
    </form>
</body>
</html>