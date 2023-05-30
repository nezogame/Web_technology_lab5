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
        
        

        // Delete the category from the database
        $deleteQuery = "DELETE FROM categories WHERE id = $categoryID";
        $deleteResult = "";
        try{
        $deleteResult = mysqli_query($conn, $deleteQuery);
        }
        catch (mysqli_sql_exception $e) {
            // Handle the exception
            if ($e) {
                
            }
        }
        if ($deleteResult) {
            // Redirect to the desired page after successful deletion
            header('Location: admin.php?table=categories');
            exit;
        } else {
            $errorMessage = "Cannot delete the category. It has foreign key constraints in another table.";
            echo '<script type="text/javascript">';
            echo 'document.addEventListener("DOMContentLoaded", function() {';
            echo '    var errorMessage = "' . $errorMessage . '";';
            echo '    var sqlErrorDiv = document.querySelector(".validate_error");';
            echo '    sqlErrorDiv.innerHTML = "<ul><li>" + errorMessage + "</li></ul>";';
            echo '});';
            echo '</script>';
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

<?php include('index_head.php'); ?>
<body>
    <h2 class ="edit_label">Delete Category</h2>
    <form class = "delete_form"method="POST" action="delete_category.php?id=<?php echo $category['id']; ?>">
        <p class = "authentication">Are you sure you want to delete the category "<?php echo $category['name']; ?>"?</p>
        <button type="submit" name="confirm_delete" >Delete</button>
        <button type="button" onclick="window.location.href='admin.php?table=categories'">Cancel</button>
        <div class ="validate_error"></div>
    </form>
</body>
</html>
