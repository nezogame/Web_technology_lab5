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

// Process the delete request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the delete confirmation is received
    if (isset($_POST['confirm_delete'])) {
        // Check for foreign key constraints
        $constraintQuery = "SELECT * FROM products WHERE category_id = $categoryID";
        $constraintResult = mysqli_query($conn, $constraintQuery);
        if (mysqli_num_rows($constraintResult) > 0) {
            echo 'Cannot delete the category. It has foreign key constraints in other tables.';
            exit;
        }

        // Delete the category from the database
        $deleteQuery = "DELETE FROM categories WHERE id = $categoryID";
        $deleteResult = mysqli_query($conn, $deleteQuery);
        if ($deleteResult) {
            // Redirect to the desired page after successful deletion
            header('Location: admin.php?table=categories');
            exit;
        } else {
            echo 'Error deleting category: ' . mysqli_error($conn);
        }
    } else {
        // User canceled the deletion
        header('Location: admin.php?table=categories');
        exit;
    }
}

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="styles\style.css">
    <title>Delete Category</title>
</head>
<body>
    <h2 class ="edit_label">Delete Category</h2>
    <form class = "delete_form"method="POST" action="delete_category.php?id=<?php echo $category['id']; ?>">
        <p class = "authentication">Are you sure you want to delete the category "<?php echo $category['name']; ?>"?</p>
        <button type="submit" name="confirm_delete" >Delete</button>
        <button type="button" onclick="window.location.href='admin.php?table=categories'">Cancel</button>
    </form>
</body>
</html>
