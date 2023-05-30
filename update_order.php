<?php
$hostname = '127.0.0.1';
$username = 'root';
$database = 'green_garden';

$errors = array();
// Check if the order ID is provided
if (!isset($_GET['id'])) {
    $errors['id'] = 'Order ID not provided';
    exit;
}

// Fetch the order data from the database
$conn = new mysqli($hostname, $username, 'root', $database);
$orderID = $_GET['id'];
$query = "SELECT * FROM orders WHERE id = $orderID";
$result = mysqli_query($conn, $query);
$order = mysqli_fetch_assoc($result);

// Check if the order exists
if (!$order) {
    $errors['order'] = 'Order not found';
    exit;
}

// Process the form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the submitted form data
    

    $newStatus = trim(htmlentities($_POST['status']));
       

    // If there are no validation errors, update the order in the database
    if (empty($errors)) {
        $updateQuery = "UPDATE orders 
                        SET status = '$newStatus'
                        WHERE id = $orderID";
        $updateResult = mysqli_query($conn, $updateQuery);
        if ($updateResult) {
            // Redirect to the desired page after successful update
            header('Location: admin.php?table=orders');
            exit();
        } else {
            echo 'Error updating order: ' . mysqli_error($conn);
        }
    }else{
        
    }
}

// Close the database connection
mysqli_close($conn);
?>





<?php include('index_head.php'); ?>
<body>
    <h2 class = "edit_label">Edit Order</h2>
    <form class ="update_form"method="POST" action="update_order.php?id=<?php echo $order['id']; ?>">
    
    <div class="insert_field">
        <label >Product Name:</label>
        <div class="edit_text"><?php echo $order['product_name']; ?></div>
    </div>
    <div class="insert_field">
        <label>Quantity:</label>
        <div class="edit_text"><?php echo $order['quantity']; ?></div>
    </div>
    <div class="insert_field">
        <label >Product Fianl Price:</label>
        <div class="edit_text"><?php echo $order['price']; ?></div>
    </div>
    <div class="insert_field">
        <label >Product Order Date:</label>
        <div class="edit_text"><?php echo $order['order_date']; ?></div>
    </div>
    <div class ="insert_field">
    <label for="status">Status:</label>
            <select class="select_id" name="status" required>
                <?php
                   $status = array("SUBMIT", "CANEL");

                   foreach ($status as $option) {
                       echo "<option value=\"" . $option . "\">" . $option . "</option>";
                   }
                ?>
            </select>
    </div>
        <button class ="inser_but"type="submit">Submit</button>
        <button type="button" onclick="window.location.href='admin.php?table=orders'">Cancel</button>
    </form>
</body>
</html>