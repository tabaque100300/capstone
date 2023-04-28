<?php include('../partials-front/menu.php'); ?>


    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>kiosk/food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php  
    
        if(isset($_SESSION['order']))
        {
            echo $_SESSION['order'];
            unset ($_SESSION['order']);
        }
    
    ?>

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php 
            
            //sql query mag display kang category sa database
            $sql = "SELECT * FROM  category WHERE active='Yes' AND featured='Yes' and status = 1 LIMIT 3";

            $res = mysqli_query($conn, $sql);

            $count = mysqli_num_rows($res);

            if($count>0)
            {
                while($row=mysqli_fetch_assoc($res))
                {
                    $id = $row['id'];
                    $title = $row['title'];
                    $image_name = $row['image_name'];
                    ?>

                    <a href="category-foods.php?category_id=<?php echo $id; ?>">
                         <div class="box-3 float-container">
                            <?php 
                            
                                if($image_name=="")
                                {
                                    echo "<div class='error'>Image Not Available.</div>";
                                }
                                else
                                {
                                    ?>
                                    <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve">                              
                                    <?php
                                }
                            
                            ?>
                            
                            <h3 class="float-text text-white"><?php echo $title; ?></h3>
                         </div>
                    </a>

                    <?php
                }
            }
            else
            {
                echo "<div class='error'>Category not Added. </div>";
            }
            
            ?>


            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
            //to get foods From database that are active and Featured
            $sql2  = "SELECT * FROM food WHERE active='Yes' AND featured='Yes' and status = 1";

            $res2 = mysqli_query($conn, $sql2);

            $count2 = mysqli_num_rows($res2);

            if($count2>0)
            {
                while($row=mysqli_fetch_assoc($res2))
                {
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $description = $row['description'];
                    $image_name = $row['image_name'];
                    $Stocks = $row['Stocks'];
                    $qnty=1;
                    ?>

                     <div class="food-menu-box">
                          <div class="food-menu-img">
                           
                               <?php

                                    //to check whether image is available or not
                                    if($image_name=="")
                                    {
                                    echo "<div class='error'>Image Not Available. </div>";
                                    }
                                    else
                                    {
                                       ?>
                                       <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicken Hawaiian Pizza" class="img-responsive img-curve">
                                       <?php
                                    }
                          
                                ?>


                          </div>

                          <div class="food-menu-desc">
                             <h4 class="lkt"><?php echo $title; ?></h4>
                             <br> 
                                 <h4>Stocks: <?php echo $Stocks; ?></h4>
                                 <p class="food-price">Price: ₱<?php echo $price; ?></p>
                                 <p class="food-detail">
                                       <?php echo $description; ?>
                                 </p>
                                 <br>
                            <form action="" method="POST">
                                   <?php if($Stocks <= 0)
                                   {

                           
                                   ?>
                                <span>Out of Stock</span>

                                   <?php
                                           }
                                   else
                                   {
                                    ?>

                                        <button name="add_to_cart" class="btn-123">Add To Cart</button>
                                    <?php
                                   }
                                   ?>
                                
                                 <input type="hidden" name="id" value="<?php echo $id; ?>">
                                    <input type="hidden" name="title" value="<?php echo $title; ?>">
                                        <input type="hidden" name="price" value="<?php echo $price; ?>">
                                        <input type="hidden" name="qnty" value="<?php echo $qnty; ?>">
                            </form>
                          </div>
                     </div>

                    <?php


                }
            }
            else
            {
            echo "<div class='error'>Food Not Available. </div>";
            }

 


    if(isset($_POST['add_to_cart']))
    {

             $id=$_POST['id'];
             $food=$_POST['title'];
             $price1=$_POST['price'];
             $qnty1=$_POST['qnty'];

             if(isset($_SESSION['cart']))
             {
             $check = array_column($_SESSION['cart'],'food');
             if(in_array($food,$check))
             {
                echo "<script> Swal.fire({
                    type: 'error',
                    text: 'Already Added to Cart!',
                    timer:2000,
                    showConfirmButton:false
                    }).then(function() {
                window.location = 'index.php';
            })
            </script>";
             }
             else
             {
             $count=count($_SESSION['cart']);
             $_SESSION['cart'][$count]= array('food' => $food,
                                     'fprice' => $price1, 
                                     'fqnty' => $qnty1,
                                    'fid' => $id);
                                     $sql1="UPDATE food SET Stocks = Stocks - $qnty WHERE id = '$id'";
                                     $res1=mysqli_query($conn, $sql1);
                                     if($res1 == TRUE)
                                     {
                                        echo "<script> Swal.fire({
                                            type: 'success',
                                            text: 'Added to Cart!',
                                            timer:2000,
                                            showConfirmButton:false
                                            }).then(function() {
                                        window.location = 'index.php';
                                    })
                                    </script>";
                                     }
                     
                    
                           
             }
     }
          
     else
      {
                     $_SESSION['cart'][] = array('food' => $food,
                                     'fprice' => $price1, 
                                     'fqnty' => $qnty1,
                                     'fid' => $id);
                                
                                     $sql1="UPDATE food SET Stocks = Stocks - $qnty WHERE id = '$id'";
                                     $res1=mysqli_query($conn, $sql1);
                                     if($res1 == TRUE)
                                     {
                                        echo "<script> Swal.fire({
                                            type: 'success',
                                            text: 'Added to Cart!',
                                            timer:2000,
                                            showConfirmButton:false
                                            }).then(function() {
                                        window.location = 'index.php';
                                    })
                                    </script>";
                                     }
                     
     }                                                    
                         
 
} 

?>



 

            <div class="clearfix"></div>

            

        </div>
       
    </section>
    <!-- fOOD Menu Section Ends Here -->


    <?php include('../partials-front/footer.php'); ?>

    

    