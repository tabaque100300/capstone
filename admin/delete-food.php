<?php

     include('../config/constants.php');

     if(isset($_GET['id']) &&  isset($_GET['image_name']))
     {
         $id = $_GET['id'];
         $image_name = $_GET['image_name'];

         $sql ="UPDATE food SET status = 0 WHERE id=$id";

         $res = mysqli_query($conn, $sql);

         if($res==true)
         {
            $_SESSION['delete'] = "<div class='errr'>Food Disabled. </div>";
            header('Location:manage-food.php');
         }
         else
         {
            $_SESSION['delete'] = "<div class='error'>Failed to Delete Food. </div>";
            header('Location:manage-food.php');
         }
     }
     else
     {
         $_SESSION['unauthorize'] = "<div class='error'>Unauthhorized Access. </div>";
         header('Location:manage-food.php');
     }

?>