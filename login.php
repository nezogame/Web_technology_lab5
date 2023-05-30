<?php 

ob_start(); // Start output buffering

include('php\header.php'); 
$hostname = '127.0.0.1';
$username = 'root';
$database = 'green_garden';

print_r($_SERVER["REQUEST_METHOD"]);
print_r($_GET);

$email = $_GET['login_email'];
$password = $_GET['login_password'];
$conn = new mysqli($hostname, $username, 'root', $database) or die(mysqli_error());
$email = $conn->real_escape_string($email);
$password = $conn->real_escape_string($password);
print "before sql";
$sql = "SELECT * FROM users 
        WHERE email = '$email' AND password = '$password'; ";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $name = $row['name'];
    $email = $row['email'];

    setcookie('authorized', true, time() + (86400 * 30), '/'); // Cookie will expire in 30 days
    setcookie('email', $email, time() + (86400 * 30), '/'); // Cookie will expire in 30 days
    setcookie('name', $name, time() + (86400 * 30), '/'); // Cookie will expire in 30 days
    setcookie('user_id',  $row['id'], time() + (86400 * 30), '/'); // Cookie will expire in 30 days
    
    echo '<script type="text/javascript">';   
    echo '            window.location.href = "index.php";';
    echo '</script>';
    die();
    

} else {
    echo '<h2>User not found</h2>';
}
?>
