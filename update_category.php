<?php
$hostname = '127.0.0.1';
$username = 'root';
$database = 'green_garden';

// Check if the category ID is provided
if (!isset($_GET['id'])) {
    echo 'Category ID not provided.';
    exit;
}

// Fetch the category data from the database
$conn = new mysqli($hostname, $username, 'root', $database);
$categoryID = $_GET['id'];
$query = "SELECT * FROM categories WHERE id = $categoryID";
$result = mysqli_query($conn, $query);
$category = mysqli_fetch_assoc($result);

// Check if the category exists
if (!$category) {
    echo 'Category not found.';
    exit;
}

// Process the form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the submitted form data
    $errors = array();
    $newName = $_POST['name'];

         
        
        
    $newName = trim(htmlentities($newName));
    if(!preg_match("/^([a-zA-Z' ]+)$/",$newName)){
        $errors['name'] = 'Будь ласка, перевірьте написання назви';
    }


    // If there are no validation errors, update the category in the database
    if (empty($errors)) {
        $updateQuery = "UPDATE categories SET name = '$newName' WHERE id = $categoryID";
        $updateResult = mysqli_query($conn, $updateQuery);
        if ($updateResult) {
            // Redirect to the desired page after successful update
            header('Location: admin.php?table=categories');
            exit();
        } else {
            echo 'Error updating category: ' . mysqli_error($conn);
        }
    }
}

// Close the database connection
mysqli_close($conn);
?>

<?php include('index_head.php'); ?>
<body>
    <h2 class ="edit_label">Edit Category</h2>
    <form class ="update_form" method="POST" action="update_category.php?id=<?php echo $category['id']; ?>">
        <div class="insert_field">
            <label for="name">Category Name:</label>
            <input type="text" name="name" value="<?php echo $category['name']; ?>" required>
        </div>
        <?php if (!empty($errors)): ?>
        <ul>
            <?php foreach ($errors as $error): ?>
                <li class ="validate_error"><?php echo $error; ?></li>
            <?php endforeach; ?>
        </ul>
        <?php endif; ?>
        <button type="submit">Submit</button>
        <button type="button" onclick="window.location.href='admin.php?table=categories'">Cancel</button>
    </form>
</body>
</html>