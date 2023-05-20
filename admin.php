

 <!-- header in top of the web site -->
<?php include('php\header.php'); ?>




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
  <?php include('php\footer.php'); ?>
