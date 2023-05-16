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

         
        
        if (isset($_POST['name'])) {
            $newName = trim(htmlentities($_POST['name']));
            if(!preg_match("/^([a-zA-Z' ]+)$/",$newName)){
                $errors['name'] = 'Будьбласка, перевірьте написання вашого імені';
            }
        }else{
            $errors['name'] = 'Будьбласка, введіть ваше ім&rsquo;я';
        }

    // If there are no validation errors, update the category in the database
    if (empty($errors)) {
        $updateQuery = "UPDATE categories SET name = '$newName' WHERE id = $categoryID";
        $updateResult = mysqli_query($conn, $updateQuery);
        if ($updateResult) {
            // Redirect to the desired page after successful update
            header('Location: admin.php');
            exit();
        } else {
            echo 'Error updating category: ' . mysqli_error($conn);
        }
    }else{
        print_r ($errors);
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
    <title>Edit Category</title>
</head>
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
                <li><?php echo $error; ?></li>
            <?php endforeach; ?>
        </ul>
        <?php endif; ?>
        <button type="submit">Submit</button>
    </form>
</body>
</html>