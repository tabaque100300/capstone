<?php include('../partials-front/menu.php'); ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">

        <?php
            
            $search = $_POST['search'];

        ?>
            
            <h2>Foods on Your Search <a href="#" class="text-white">"<?php echo $search; ?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
            
                   

                   $sql = "SELECT * FROM food WHERE title LIKE '%$search%' OR description LIKE '%$search%'";

                   $res = mysqli_query($conn, $sql);

                   $count = mysqli_num_rows($res);

                   if($count>0)
                   {
                      while($row=mysqli_fetch_assoc($res))
                      {
                      $id = $row['id'];
                      $title = $row['title'];
                      $price = $row['price'];
                      $description = $row['description'];
                      $image_name = $row['image_name'];
                      $qnty=1;
                      ?>

                    <div class="food-menu-box">
                        <div class="food-menu-img">
                            <?php
                            
                                 if($image_name=="")
                                 {
                                    echo "<div class='error'>Image Not Available.</div>";
                                 }
                                 else
                                 {
                                    ?>
                                    <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                    <?php
                                 }

                            ?>
                           
                        </div>

                           <div class="food-menu-desc">
                               <h4><?php echo $title; ?></h4>
                               <p class="food-price"><?php echo $price; ?></p>
                               <p class="food-detail">
                                   <?php echo $description; ?>
                               </p>
                               <br>

                               <form action="" method="POST">
                                   
                                   <button name="add_to_cart">Add To Cart</button>
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
                      echo "<div class='error'>Food Not Available.</div>";
                   }


                   if(isset($_POST['add_to_cart']))
                   {
               
                   
               
                       
                        
                            
                            $food=$_POST['title'];
                            $price1=$_POST['price'];
                            $qnty1=$_POST['qnty'];
               
                            if(isset($_SESSION['cart']))
                            {
                            $check = array_column($_SESSION['cart'],'food');
                            if(in_array($food,$check))
                            {
                               echo "<script>
                                               alert('Item Already Added');
                                               window.location('index.php');
                                               </script>";
               
                            }
                            else
                            {
                            $count=count($_SESSION['cart']);
                            $_SESSION['cart'][$count]= array('food' => $food,
                                                    'fprice' => $price1, 
                                                    'fqnty' => $qnty1);
                                    
                                    echo "<script>
                                                
                                                window.location('index.php');
                                                </script>";
                                          
                            }
                    }
                         
                    else
                     {
                                    $_SESSION['cart'][] = array('food' => $food,
                                                    'fprice' => $price1, 
                                                    'fqnty' => $qnty1,);
                                               
                                    echo "<script>
                                              
                                                window.location('index.php');
                                                </script>";
                    }                                                    
                                        
                
               } 
               
               ?>
               
            





            



            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    

    <?php include('../partials-front/footer.php'); ?>