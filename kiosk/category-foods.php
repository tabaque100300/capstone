<?php include('../partials-front/menu.php'); ?>

<?php
    if(isset($_GET['category_id']))
    {
        $category_id = $_GET['category_id'];

        $sql = "SELECT title FROM category WHERE id=$category_id";

        $res = mysqli_query($conn, $sql);

        $row = mysqli_fetch_assoc($res);

        $category_title = $row['title'];

    }
    else
    {
        header('Location:' .SITEURL);
    }

?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Foods on <a href="#" class="text-white">"<?php echo $category_title; ?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
            
                  $sql2 = "SELECT * FROM food WHERE category_id=$category_id";
                  
                  $res2 = mysqli_query($conn, $sql2);

                  $count2 = mysqli_num_rows($res2);

                  if($count2>0)
                  {
                    while($row2=mysqli_fetch_assoc($res2))
                    {   
                        $id = $row2['id'];
                        $title = $row2['title'];
                        $price = $row2['price'];
                        $description = $row2['description'];
                        $image_name = $row2['image_name'];
                        $Stocks = $row2['Stocks'];
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
                                <h4 class="lkt"><?php echo $title; ?></h4>
                                <br> 
                                <h4>Stocks: <?php echo $Stocks; ?></h4>
                                <p class="food-price">₱<?php echo $price; ?></p>
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
                    echo "<div class='error'>Food not Available.</div>";
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
                                                   $sql1="UPDATE food SET Stocks = Stocks - $qnty WHERE id = '$id'";
                                                   $res1=mysqli_query($conn, $sql1);
                                                   if($res1 == TRUE)
                                                   {
                                                    echo "<script>
                                                    alert('Added to cart');
                                                    window.location.href='index.php';
                                                  </script>";
                                                   }
                                   
                                         
                           }
                   }
                        
                   else
                    {
                                   $_SESSION['cart'][] = array('food' => $food,
                                                   'fprice' => $price1, 
                                                   'fqnty' => $qnty1,);
                                              
                                                   $sql1="UPDATE food SET Stocks = Stocks - $qnty WHERE id = '$id'";
                                                   $res1=mysqli_query($conn, $sql1);
                                                   if($res1 == TRUE)
                                                   {
                                                    echo "<script>
                                                    alert('Added to cart');
                                                    window.location.href='index.php';
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