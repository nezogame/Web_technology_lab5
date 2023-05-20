<?php
$hostname = '127.0.0.1';
$username = 'root';
$database = 'green_garden';

// Process the form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the submitted form data
    $newProductId = trim(htmlentities($_POST['category_id']));
    $newName = trim(htmlentities($_POST['name']));
    $newPrice = trim(htmlentities($_POST['price']));
    $newDescriptionID = trim(htmlentities($_POST['description_id']));

    // Perform validation (customize the validation rules according to your requirements)
    $errors = [];
    
   
    if(!preg_match("/^[A-Za-z0-9\s\.,\-]+$/",$newName)){
        $errors['name'] = 'Будь ласка, перевірьте написання назви';
    }

    if(!preg_match("/^[1-9]\d{0,7}(?:\.\d{1,4})?$/",$newPrice)){
        $errors['price'] = 'Будь ласка, перевірьте написану ціну';
    }
    
    // If there are no validation errors, insert the category into the database
    if (empty($errors)) {
        $conn = new mysqli($hostname, $username, 'root', $database);
        $insertQuery = "INSERT INTO products (category_id, name,price,description_id) 
        VALUES ('$newProductId','$newName','$newPrice','$newDescriptionID')";
        $insertResult = mysqli_query($conn, $insertQuery);
        if ($insertResult) {
            // Redirect to the desired page after successful insertion
            header('Location: admin.php?table=products');
            exit;
        } else {
            echo 'Error inserting category: ' . mysqli_error($conn);
        }
        mysqli_close($conn);
    }
}
?>

<?php include('index_head.php'); ?>
<body>
    <h2 class = "edit_label">Insert Product</h2>
    <form class ="insert_form" method="POST" action="insert_product.php">
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
                    $query = "SELECT id,name FROM categories";
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
        <div class = "insert_field">
            <label for="name">Product Name:</label>
            <input type="text" name="name" required>
        </div>
        <div class = "insert_field">
            <label for="price">Product Price:</label>
            <input type="text" name="price" required>
        </div>
        <div class = "insert_field">
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
        <button type="submit">Submit</button>
        <button type="button" onclick="window.location.href='admin.php?table=products'">Cancel</button>
    </form>
</body>
</html>
