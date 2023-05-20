<?php
$hostname = '127.0.0.1';
$username = 'root';
$database = 'green_garden';

$errors = array();
// Check if the product ID is provided
if (!isset($_GET['id'])) {
    $errors['id'] = 'Product ID not provided';
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
    $errors['product'] = 'Product not found';
    exit;
}

// Process the form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the submitted form data
    
    $newCategoryId = trim(htmlentities($_POST['category_id']));
    $newName = trim(htmlentities($_POST['name']));
    $newPrice = trim(htmlentities($_POST['price']));
    $newDescriptionID = trim(htmlentities($_POST['description_id']));

        
        
    
    if(!preg_match("/^[A-Za-z0-9\s\.,\-]+$/",$newName)){
        $errors['name'] = 'Будь ласка, перевірьте написання назви';
    }

    if(!preg_match("/^[1-9]\d{0,7}(?:\.\d{1,4})?$/",$newPrice)){
        $errors['price'] = 'Будь ласка, перевірьте написану ціну';
    }
       

    // If there are no validation errors, update the product in the database
    if (empty($errors)) {
        $updateQuery = "UPDATE products 
                        SET category_id = '$newCategoryId', 
                            name = '$newName',
                            price = '$newPrice',
                            description_id = '$newDescriptionID'
                        WHERE id = $productID";
        $updateResult = mysqli_query($conn, $updateQuery);
        if ($updateResult) {
            // Redirect to the desired page after successful update
            header('Location: admin.php?table=products');
            exit();
        } else {
            echo 'Error updating product: ' . mysqli_error($conn);
        }
    }else{
        
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

<?php include('index_head.php'); ?>
<body>
    <h2 class = "edit_label">Edit Product</h2>
    <form class ="update_form"method="POST" action="update_product.php?id=<?php echo $product['id']; ?>">
    <div class = "insert_field">
            <label for="category_id">Product Id:</label>
            <select class="select_id" name="category_id" required>
                <?php
                    $hostname = '127.0.0.1';
                    $username = 'root';
                    $database = 'green_garden';

                    // Connect to the database
                    $conn = new mysqli($hostname, $username, 'root', $database);

                    // Check if the connection was successful
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    // Fetch category IDs from the database
                    $query = "SELECT id, name FROM categories";
                    $result = $conn->query($query);

                    // Populate the dropdown list with category IDs
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value=\"" . $row['id'] . "\">" . $row['name'] . "</option>";
                        }
                    }

                    // Close the database connection
                    $conn->close();
                ?>
            </select>
        </div>
    <div class="insert_field">
        <label for="name">Product Name:</label>
        <input type="text" name="name" value="<?php echo $product['name']; ?>" required>
    </div>
    <div class="insert_field">
        <label for="price">Product Price:</label>
        <input type="text" name="price" value="<?php echo $product['price']; ?>" required>
    </div>
    <div class ="insert_field">
    <label for="description_id">Description ID:</label>
            <select class="select_id" name="description_id" required>
                <?php
                    $hostname = '127.0.0.1';
                    $username = 'root';
                    $database = 'green_garden';

                    // Connect to the database
                    $conn = new mysqli($hostname, $username, 'root', $database);

                    // Check if the connection was successful
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    // Fetch category IDs from the database
                    $query = "SELECT id FROM product_description";
                    $result = $conn->query($query);

                    // Populate the dropdown list with category IDs
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value=\"" . $row['id'] . "\">" . $row['id'] . "</option>";
                        }
                    }

                    // Close the database connection
                    $conn->close();
                ?>
            </select>
    </div>
        <?php if (!empty($errors)): ?>
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li class ="validate_error"><?php echo $error; ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
        <button class ="inser_but"type="submit">Submit</button>
        <button type="button" onclick="window.location.href='admin.php?table=products'">Cancel</button>
    </form>
</body>
</html>