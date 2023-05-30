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
    if (isset($_POST['name'])) {
        $newName = trim(htmlentities($_POST['name']));
        if(!preg_match("/^([a-zA-Z' ]+)$/",$newName)){
            $errors['name'] = 'Будь ласка, перевірьте написання назви';
        }
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

<?php include('index_head.php'); ?>
<body>
    <h2 class = "edit_label">Insert Category</h2>
    <form class ="insert_form" method="POST" action="insert_category.php">
    <div class="insert_field">
        <label for="name">Category Name:</label>
        <input type="text" name="name" required>
    </div >
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
