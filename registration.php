<?php
$hostname = '127.0.0.1:3306';
$username = 'root';
$database = 'green_garden';

print_r($_SERVER["REQUEST_METHOD"]);
print_r($_POST);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Отримання даних з форми
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];

    // Виконання додаткових перевірок та обробка даних

    // Збереження даних у базі даних (приклад з використанням MySQLi)
    print('In method POST');

    $conn = new mysqli($hostname, $username, 'root', $database);

    if ($conn->connect_errno) {
        print('In Error connection');

        echo 'Error connection with DB: ' . $conn->connect_error;
        // Додайте код для обробки помилки з'єднання з базою даних
    } else {
        // Екранування даних для запобігання SQL-injection 
        print('In NO Error connection');
        $name = $conn->real_escape_string($name);
        $email = $conn->real_escape_string($email);
        $phone = $conn->real_escape_string($phone);
        $password = $conn->real_escape_string($password);

        // Підготовка та виконання запиту для вставки даних
        print('Before insert');
            $check_query = "SELECT name from users where emaiil ='$email' or password ='$password'  "
            $query = "INSERT INTO users (name, email, phone, password) 
            VALUES ('$name', '$email', '$phone', '$password')";
            $result = $conn->query($sql);
            if($result->num_rows > 0){
                echo 'this User alredy exist';
            }
            else{
                if ($conn->query($query)) {
                    echo "<div class='greating'>".$name."</div>" ;
                    header('Location: index.php');
                    die(); // Make sure to exit after the redirect
                    echo 'Data successfully inserted in DB.';
                } else {
                    print('Error was Data insertted');
                    echo 'Error when saved in DB: ' . $conn->error;
                }
            } 
            $conn->close();
        }
    }
?>