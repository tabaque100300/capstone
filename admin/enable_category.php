<?php 

   include('../config/constants.php');

   if(isset($_GET['id']) AND isset($_GET['image_name']))
   {
         $id = $_GET['id'];
         $image_name = $_GET['image_name'];
         $sql = "UPDATE category SET status = 1 WHERE id=$id";

         $res = mysqli_query($conn, $sql);

         if($res==true)
         {
            $_SESSION['delete'] = "<div class='success'>Category Enabled. </div>";
            header('Location:manage-category.php');
         }
         else
         {
            $_SESSION['delete'] = "<div class='error'>Failed to Delete Category. </div>";
            header('Location:manage-category.php');
         }

   }
   else
   {
         header('Location:manage-category.php');
   }
?>