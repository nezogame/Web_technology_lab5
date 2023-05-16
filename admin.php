<?php include('php\header.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF_8">
    <meta http_equiv="X_UA_Compatible" content="IE=edge">
    <meta name="viewport" content="width=device_width, initial_scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="styles\style.css">
    <title>Admin Panel</title>
</head>


<body>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-3">
        <nav class="sidebar bg-success bg-gradient">
            <div class="label">
                Admin Panel for editing a table
            </div>
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link" href="admin.php?table=users">Users</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="admin.php?table=categories">Categories</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="admin.php?table=products">Products</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="admin.php?table=orders">Orders</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="admin.php?table=cart">Cart</a>
            </li>
            
          </ul>
        </nav>
      </div>
      <div class="col-md-9">
        <?php
        // Check if a specific table is selected
        if (isset($_GET['table'])) {
          $table = $_GET['table'];
          // Include the corresponding table edit file
          if ($table === 'users') {
            include('edit_users.php');
          } 
          elseif ($table === 'categories') {
            include('edit_categories.php');
          }
          elseif ($table === 'products') {
            include('edit_products.php');
          } 
          elseif ($table === 'orders') {
            include('edit_orders.php');
          } 
          elseif ($table === 'cart') {
            include('edit_cart.php');
          }
          // Add more conditions for other tables
        } else {
        }
        ?>
      </div>
    </div>
  </div>
  <script src="scripts/reg_validation.js"> </script>  
</body>

</html>
