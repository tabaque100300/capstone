
<?php include('partials/menu.php'); ?>

        <!-- Main Content section Starts -->
        <div class="main-content">
            <div class="wrapper">
                <h1>Dashboard</h1>
                <br><br>

                <?php 
                    if(isset($_SESSION['login']))
                    {
                    echo $_SESSION['login']; //Displaying Session Message
                    unset($_SESSION['login']); //Removing Session Message
                    }
            
                ?>
                <br><br>

                <div class="col-4 text-center">
                    <?php
                    
                    $sql = "SELECT * FROM category";
                    $res = mysqli_query($conn, $sql);
                    $count = mysqli_num_rows($res);
                    
                    ?>
                    <h1><?php echo $count; ?></h1>
                    <br/>
                    Categories
                </div>
                <div class="col-4 text-center">
                    <?php
                    
                    $sql2 = "SELECT * FROM food";
                    $res2 = mysqli_query($conn, $sql2);
                    $count2 = mysqli_num_rows($res2);
                    
                    ?>
                    <h1><?php echo $count2; ?></h1>
                    <br/>
                    Foods
                </div>
                <div class="col-4 text-center">
                <?php
                    
                    $sql3 = "SELECT * FROM `order`";
                    $res3 = mysqli_query($conn, $sql3);
                    $count3 = mysqli_num_rows($res3);
                    
                    ?>
                    <h1><?php echo $count3; ?></h1>
                    <br/>
                    Total Orders
                </div>
                <div class="col-4 text-center">
                    <h1>5</h1>
                    <br/>
                    Revenue Generated
                </div>

                <div class="clearfix"></div>
            </div>
        </div>
        <!-- Main Content section Ends -->

 <?php include('partials/footer.php'); ?>