<?php include('../config/constants.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Website</title>

    <!-- Link our CSS file -->
    <link rel="stylesheet" href="../css/style.css">
    <script src="../sweetalert2/jquery-3.4.1.min.js"></script>
    <script src="../sweetalert2/sweetalert2.all.min.js"></script>
     <script src="../sweetalert2/bootstrap.bundle.min.js"></script>
      <script src="../sweetalert2/bootstrap.min.js"></script>
      <script src="../sweetalert2/bootstrap.js"></script>
    
</head>

<body>
    <!-- Navbar Section Starts Here -->
    <section class="navbar">
        <div class="container">
            <div class="logo">
                <a href="#" title="Logo">
                    <img src="../images/bg2.jpg" alt="Restaurant Logo" class="img-responsive">
                </a>
            </div>

            <div class="menu text-right">
                <ul>
                    <li>
                        <a href="index.php" class="btn btn-primary">Home</a>
                    </li>

                    <li>
                    <?php
                    
                    $count=0;
                    if(isset($_SESSION['cart']))
                    {
                      $count=count($_SESSION['cart']);
                    }
                  
                  ?>
                  <a href="cart.php" class="btn btn-primary">Cart (<?php echo $count; ?>)</a>
                    </li>

                    <li>
                       <a href="../admin/logout.php" class="btn btn-primary" onclick="return confirm('Are you sure you want to Logout?')">Logout</a>    
                    </li>


                    
                </ul>
                <div>
                    
                </div>
            </div>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Navbar Section Ends Here -->
