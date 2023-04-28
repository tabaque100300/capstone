<?php include('partials/menu.php'); ?>


<div class="main-content">
      <div class="wrapper">
           <h1>Add Food</h1>

           <br><br>

           <?php 
       
                if(isset($_SESSION['upload']))
                {
                    echo $_SESSION['upload']; 
                    unset($_SESSION['upload']);
                }
       
       
           ?>

           <form action="" method="POST" enctype="multipart/form-data">

           <table class="tbl-30">
            <tr>
                <td>Title:</td>
                <td>
                    <input type="text" name="title" placeholder="Title of the Food">
                </td>
            </tr>

            <tr>
                <td>Description:</td>
                <td>
                    <textarea name="description"  cols="30" rows="5"placeholder="Food Description"></textarea>
                </td>
            </tr>

            <tr>
                <td>Price:</td>
                <td>
                   <input type="number" name="price">
                </td>
            </tr>

            <tr>
                <td>Select Image</td>
                <td>
                    <input type="file" name="image" >
                </td>
            </tr>

            <tr>
                <td>Stocks:
                    <td>
                    <input type="number" name="Stocks">
                    </td>
                </td>
            </tr>

            <tr>
                <td>Category:</td>
                <td>
                    <select name="category">
                        <?php
                        //php code to display Categories from database
                        $sql = "SELECT * FROM category WHERE active='Yes'";

                        $res = mysqli_query($conn, $sql);

                        $count = mysqli_num_rows($res);

                        if($count>0)
                        {
                            while($row=mysqli_fetch_assoc($res))
                            {
                            $id = $row['id'];
                            $title = $row['title'];
                            


                            ?>

                            <option value="<?php echo $id; ?>"><?php echo $title; ?></option>

                            <?php
                            }
                        }
                        else
                        {
                            ?>
                             <option value="0">No Category Found</option>
                            <?php
                        }
                        
                        ?>

                    </select>
                </td>
            </tr>

            <tr>
                <td>Featured:</td>
                <td>
                    <input type="radio" name="featured" value="Yes"> Yes
                    <input type="radio" name="featured" value="No"> No
                </td>
            </tr>

            <tr>
                <td>Availability:</td>
                <td>
                    <input type="radio" name="active" value="Yes"> Yes
                    <input type="radio" name="active" value="No"> No
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                </td>
            </tr>

           </table>

           </form>


           <?php
             
             if(isset($_POST['submit']))
             {
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $category = $_POST['category'];
                $Stocks = $_POST['Stocks'];
                if(isset($_POST['featured']))
                {
                    $featured = $_POST['featured']; //setting the default value
                }
                else
                {
                    $featured  = "No";
                }

                if(isset($_POST['active']))
                {
                    $active = $_POST['active']; //setting the default value
                }
                else
                {
                    $active  = "No";
                }

                if(isset($_FILES['image']['name']))
                {
                    $image_name = $_FILES['image']['name'];

                    if($image_name!="")
                    {
                        //image selected
                        //extension of selected image
                        $ext = end(explode('.', $image_name));

                        //new name for image
                        $image_name ="Food Name" .rand(0000,9999).".".$ext;

                        //source and destination path
                        $src=$_FILES['image']['tmp_name'];

                        //destination of image to be uploaded
                        $dst = "../images/food/" .$image_name;

                        $upload = move_uploaded_file($src, $dst);

                        if($upload==false)
                        {
                            $_SESSION['upload'] = "<div class='error'>Failed to Upload Image. </div>";
                            header('Location:add-food.php');
                            die();
                        }
                        

                    }
                }
                else
                {
                    $image_name = "";
                }
                //kung numerical no need to pass value sa sulod ka quotes '' kung string value kinahanglan gid mag butang ka quotes ''
                $sql2 = "INSERT INTO food SET
                     title = '$title',
                     description = '$description',
                     price = $price,
                     image_name = '$image_name',
                     Stocks = '$Stocks',
                     category_id = $category,
                     featured = '$featured',
                     active = '$active'
                
                ";

                $res2 = mysqli_query($conn, $sql2);

                if($res2==true)
                {
                    $_SESSION['add'] = "<div class='success'>Food Added Successfully. </div>";
                    header('Location:manage-food.php');
                }
                else
                {
                    $_SESSION['add'] = "<div class='error'>Failed to Add Food. </div>";
                    header('Location:manage-food.php');
                }

             }
             

           
           ?>


      </div>
</div>

<?php include('partials/footer.php'); ?>