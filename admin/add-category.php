<?php include('partials/menu.php'); ?>
     
     <div class="main-content">
        <div class="wrapper">
            <h1>Add Category</h1>

            <br><br>

            <?php 
                 if(isset($_SESSION['add'])) //Checking Whether the Session is checked or not
                 {
                   echo $_SESSION['add']; //Display Session Message if Set
                   unset($_SESSION['add']); //Remove Session Message
                 }

                 if(isset($_SESSION['upload'])) 
                 {
                   echo $_SESSION['upload']; 
                   unset($_SESSION['upload']); 
                 }
           ?>
           <br><br>

            <!--add categorry Starts-->
            <form action="" method="POST" enctype="multipart/form-data">
                <table class="tbl-30">
                    <tr>
                        <td>Title: </td>
                        <td>
                            <input type="text" name="title" placeholder="Category Title" required>
                        </td>
                    </tr>

                    <tr>
                        <td>Select Image: </td>
                        <td>
                            <input type="file" name="image">
                        </td>
                    </tr>

                    <tr>
                        <td>Featured:</td>
                        <td>
                            <input type="radio" name="featured" value="Yes" required> Yes
                            <input type="radio" name="featured" value="No"> No
                        </td>
                    </tr>

                    <tr>
                        <td>Active: </td>
                        <td>
                            <input type="radio" name="active" value="Yes" required> Yes
                            <input type="radio" name="active" value="No" > No
                        </td>

                    </tr>

                    <tr>
                        <td colspan="2">
                             <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                        </td>
                    </tr>


                </table>
            </form>
            <!--add categorry Ends-->

            <?php 
            
                 if(isset($_POST['submit']))
                 {
                    //echo "clicked";
                    $title = $_POST['title'];

                    //for radio input. to check the button selected or not
                    if(isset($_POST['featured']))
                    {
                        $featured = $_POST['featured'];
                    }
                    else
                    {
                        $featured = "No";
                    }

                    if(isset($_POST['active']))
                    {
                        $active = $_POST['active'];
                    }
                    else
                    {
                        $active = "No";
                    }

                    //check whether the image is selected or not, set the value of image accordingly
                    //print_r($_FILES['image']);

                    //die(); // break the code

                    if(isset($_FILES['image']['name']))
                    {
                        //upload the image
                        $image_name = $_FILES['image']['name'];
                        
                        
                        //upload the image only if image is selected
                        if($image_name != "")
                        {

                        

                          //autorename our image
                          $ext = end(explode('.', $image_name));

                          //rename the image
                          $image_name = "Food_Category_".rand(000, 999).'.'.$ext;

                          $source_path = $_FILES['image']['tmp_name'];

                          $destination_path = "../images/category/".$image_name;

                          $upload = move_uploaded_file($source_path, $destination_path);

                          if($upload==false)
                          {
                              $_SESSION['upload'] = "<div class='error'>Failed to upload Image. </div>";
                              header('Location:add-category.php');
                              die();
                          }

                          

                        }

                    }
                    else
                    {
                        //dont upload image
                        $image_name="";
                    }

                    $sql = "INSERT INTO category SET
                        title='$title',
                        image_name='$image_name',
                        featured='$featured',
                        active='$active'
                    
                    
                    ";

                    $res = mysqli_query($conn, $sql);

                    if($res==true)
                    {
                        $_SESSION['add'] = "<div class='success'>Category Added Successfully. </div>";
                        header('Location:manage-category.php');
                    }
                    else
                    {
                        $_SESSION['add'] = "<div class='error'>Failed to Add Category. </div>";
                        header('Location:add-category.php');
                    }

                    

                    
                 }
            
            
            ?>
        </div>
     </div>


<?php include('partials/footer.php'); ?>