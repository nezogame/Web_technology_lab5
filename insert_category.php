<?php
$hostname = '127.0.0.1';
$username = 'root';
$database = 'green_garden';

// Process the form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the submitted form data
    $newName = $_POST['name'];

    // Perform validation (customize the validation rules according to your requirements)
    $errors = [];
    if (empty($newName)) {
        $errors[] = 'Category name is required.';
    }

    // If there are no validation errors, insert the category into the database
    if (empty($errors)) {
        $conn = new mysqli($hostname, $username, 'root', $database);
        $insertQuery = "INSERT INTO categories (name) VALUES ('$newName')";
        $insertResult = mysqli_query($conn, $insertQuery);
        if ($insertResult) {
            // Redirect to the desired page after successful insertion
            header('Location: admin.php?table=categories');
            exit;
        } else {
            echo 'Error inserting category: ' . mysqli_error($conn);
        }
        mysqli_close($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="styles\style.css">
    <title>Insert Category</title>
</head>
<body>
    <h2>Insert Category</h2>
    <form method="POST" action="insert_category.php">
        <label for="name">Category Name:</label>
        <input type="text" name="name" required>
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
