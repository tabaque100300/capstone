<?php 

       include('../config/constants.php');
       include('login-check.php'); 

?>



<html>
    <head>
         <title>marinos-ordering website - Home page</title>

         <link rel="stylesheet" href="../css/admin.css">
        <script src="../sweetalert2/jquery-3.4.1.min.js"></script>
        <script src="../sweetalert2/sweetalert2.all.min.js"></script>
        <script src="../sweetalert2/bootstrap.bundle.min.js"></script>
        <script src="../sweetalert2/bootstrap.min.js"></script>
        <script src="../sweetalert2/bootstrap.js"></script>
    </head>

    <body>
        <!-- Menu section Starts -->
        <div class="menu text-center">
            <div class="wrapper">
                 <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="manage-admin.php">Employee</a></li>
                    <li><a href="manage-category.php">Category</a></li>
                    <li><a href="manage-food.php">Food</a></li>
                    <li><a href="manage-order.php">Order</a></li>
                    <li><a href="daily.php">Reports</a></li>
                    <li><a href="transaction-log.php">Transaction-Log</a></li>
                    <li class="mrg"><a href="logout.php" onclick="return confirm('Are you sure you want to logout?')"><button class="tut">Logout</button></a></li>
                    
                 </ul>
            </div>
            
        </div>
        <!-- Menu section Ends -->