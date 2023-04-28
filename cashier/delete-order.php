<?php 

   include('../config/constants.php');

   if(isset($_GET['id']))
   {
         $id = $_GET['id'];
         



         $sql = "DELETE  FROM `order` WHERE `id`=$id";

         $res = mysqli_query($conn, $sql);

         if($res==true)
         {
            $_SESSION['delete'] = "<div class='success'>Order Deleted Successfully. </div>";
            header('Location:cash.php');
         }
         else
         {
            $_SESSION['delete'] = "<div class='error'>Failed to Delete Order. </div>";
            header('Location:index.php');
         }

   }
   else
   {
         header('Location:cash.php');
   }
?>