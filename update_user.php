<?php
$hostname = '127.0.0.1';
$username = 'root';
$database = 'green_garden';

// Check if the user ID is provided
if (!isset($_GET['id'])) {
    echo 'User ID not provided.';
    exit;
}

// Fetch the user data from the database
$conn = new mysqli($hostname, $username, 'root', $database);
$userID = $_GET['id'];
$query = "SELECT * FROM users WHERE id = $userID";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);

// Check if the user exists
if (!$user) {
    echo 'User not found.';
    exit;
}

// Process the form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the submitted form data
    $errors = array();
    $newName = $_POST['name'];
    $newEmail = $_POST['email'];
    $newPhone = $_POST['phone'];
    $newPassword = $_POST['password'];
   
        
        
        $newName = trim(htmlentities($_POST['name']));
        $newEmail = trim(htmlentities($_POST['email']));
        $newPhone = trim(htmlentities($_POST['phone']));
        
        if(!preg_match("/^[A-Za-z0-9\s\.,\-]+$/",$newName)){
            $errors['name'] = 'Будь ласка, перевірьте написання імені';
        }
        if(!preg_match("/^[^\s@]+@[^\s@]+\.[^\s@]+$/",$newEmail)){
            $errors['email'] = 'Будь ласка, перевірьте написання емейлу';
        }
        if(!preg_match("/^\+\d{1,3}\d{9}$/",$newPhone)){
            $errors['phone'] = 'Будь ласка, перевірьте написання телефону';
        }
        if(!empty($newPassword) && !preg_match("/^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{6,16}$/",$newPassword)){
            $errors['name'] = 'Будь ласка, перевірьте написання паролю, він повинен містити мініму 1 цифру та спец символ';
        }

        
        

    // If there are no validation errors, update the user in the database
    if (empty($errors)) {
        $updateQuery ="";
        if(empty($newPassword)){
            $updateQuery = "UPDATE users 
            SET  
                name = '$newName',
                email = '$newEmail',
                phone = '$newPhone'
            WHERE id = $userID";
        }else{
            $updateQuery = "UPDATE users
            SET  
                name = '$newName',
                email = '$newEmail',
                phone = '$newPhone',
                password = '$newPassword'
            WHERE id = $userID";
        }
        $updateResult = mysqli_query($conn, $updateQuery);
        if ($updateResult) {
            // Redirect to the desired page after successful update
            header('Location: admin.php?table=users');
            exit();
        } else {
            echo 'Error updating user: ' . mysqli_error($conn);
        }
    }
}

// Close the database connection
mysqli_close($conn);
?>

<?php
    
    
    // Check if the user ID is provided
    if (!isset($_GET['id'])) {
        echo 'User ID not provided.';
        exit;
    }
    
    $user_id = $_GET['id'];

    // Fetch the old data from the database based on the user ID
    $conn = new mysqli($hostname, $username, 'root', $database);
    $query = "SELECT * FROM users WHERE id = $user_id";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);
    mysqli_close($conn);
?>

<?php include('index_head.php'); ?>
<body>
    <h2 class = "edit_label">Edit User</h2>
    <form class ="update_form"method="POST" action="update_user.php?id=<?php echo $user['id']; ?>">
    <div class="insert_field">
        <label for="name">User Name:</label>
        <input type="text" name="name" value="<?php echo $user['name']; ?>" required>
    </div>
    <div class="insert_field">
        <label for="email">User Email:</label>
        <input type="text" name="email" value="<?php echo $user['email']; ?>" required>
    </div>
    <div class="insert_field">
        <label for="phone">User Phone:</label>
        <input type="text" name="phone" value="<?php echo $user['phone']; ?>" required>
    </div>
    <div class="insert_field">
        <label for="password">User Password:</label>
        <input type="text" name="password" value="" >
    </div>
        <?php if (!empty($errors)): ?>
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li class ="validate_error"><?php echo $error; ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
        <button class ="inser_but"type="submit">Submit</button>
        <button type="button" onclick="window.location.href='admin.php?table=users'">Cancel</button>
    </form>
</body>
</html>