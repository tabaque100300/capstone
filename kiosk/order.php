<?php include('../partials-front/menu.php'); ?>

     <?php
     
         if(isset($_GET['food_id']))
         {
            $food_id = $_GET['food_id'];

            $sql = "SELECT * FROM food WHERE id=$food_id";

            $res = mysqli_query($conn, $sql);

            $count = mysqli_num_rows($res);

            if($count==1)
            {
                $row = mysqli_fetch_assoc($res);

                $title = $row['title'];
                $price = $row['price'];
                $image_name = $row['image_name'];
            }
            else
            {
                header('Location:'.SITEURL);
            }
         }
         else
         {
            header('Location:'.SITEURL);
         }
     
     ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">
                        <?php 
                        
                             if($image_name=="")
                             {
                                  echo "<div class='error'>Image Not Available.</div>";
                             }
                             else
                             {
                                  ?>
                                    <img src="<?php echo SITEURL;?>Images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                  <?php
                             }

                        ?>
                        
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $title; ?></h3>
                        <input type="hidden" name="food" value="<?php echo $title; ?>">

                        <p class="food-price"><?php echo $price; ?></p>
                        <input type="hidden" name="price" value="<?php echo $price; ?>">

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Order Details</legend>
                    <div class="order-label">Customer Name</div>
                    <input type="text" name="full-name" placeholder="Your Name" class="input-responsive" required>



                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>

            <?php
            
                 if(isset($_POST['submit']))
                 {
                     $food = $_POST['food'];
                     $price = $_POST['price'];
                     $qty = $_POST['qty'];

                     $total = $price * $qty;

                     $order_date = date("Y-m-d h:i:sa");

                     $status = "ordered";

                     $customer_name = $_POST['full-name'];


                     $sql2 = "INSERT INTO order SET
                         food = '$food',
                         price = $price,
                         qty = $qty,
                         total = $total,
                         order_date = '$order_date',
                         status = '$status',
                         customer_name = '$customer_name'
                     
                     ";

                     //echo $sql2; die();

                     $res2 = mysqli_query($conn, $sql2);

                     if($res2==true)
                     {
                        $_SESSION['order'] = "<div class='success'>Food Order Successfully.</div>";
                        header('Location:'.SITEURL);
                     }
                     else
                     {
                        $_SESSION['order'] = "<div class='error'>Failed to Order Food.</div>";
                        header('Location:'.SITEURL);
                     }
                 }
            
            ?>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>
