
<?php
$hostname = '127.0.0.1';
$username = 'root';
$database = 'green_garden';

print_r($_SERVER["REQUEST_METHOD"]);
print_r($_GET);

$email = $_GET['login_email'];
$password = $_GET['login_password'];
$conn = new mysqli($hostname, $username, 'root', $database) 
        or die(mysqli_error());
    $email = $conn->real_escape_string($email);
    $password = $conn->real_escape_string($password);
    print "before sql";
    $sql = "SELECT * FROM users 
            where email = '$email' and password = '$password' ";
    $result = $conn->query($sql);
    if($result->num_rows > 0){   
        print "all ok"; 
        $_SESSION["user"] = "Email: " . $email . ", password: " . $password;
        header('Location: index.php');
        die();
        print '<div class="greating">'.$name.'</div>';
    }
    else{
        echo '<h2>User not found</h2>';
    }
?>