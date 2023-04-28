<?php 

       include('../config/constants.php');
       
?>



<html>
    <head>
         <title>marinos-ordering website - Home page</title>

         <link rel="stylesheet" href="../css/admin.css">
         <link rel="stylesheet" href="cashier.css">
        
    </head>

    <body>
        <!-- Menu section Starts -->
        <div class="menu text-center">
            <div class="wrapper">
                 <ul>
                   
                    <li><a href="index.php">Orders</a></li>
                    
                    <li><a href="../admin/logout.php">Logout</a></li>

                    <li><a href="update-password.php?username=<?php echo $_SESSION['user']; ?>">Update Password</a></li>
                    
                 </ul>
            </div>
            
        </div>
        <!-- Menu section Ends -->