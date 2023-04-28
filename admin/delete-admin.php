<?php 

     include('../config/constants.php');

    //1. get the id of an admin to be deleted
    $id = $_GET['id'];

    //2. create SQL Query to delete admin
    // $sql = "DELETE FROM employee WHERE id=$id";
$sql="UPDATE employee SET status = 0 WHERE id = $id";
    //execute the query
    $res = mysqli_query($conn, $sql);
    // check whether the query is executed successfully or not
    if($res==true)
    {
        //Query Executed successfully and Admin Deleted
        //echo "Admin Deleted";
        //create a session variable to display a message
        $_SESSION['delete'] = "<div class='errr'>User Disabled</div>";
        //redirect to manage admin page
        header('Location:manage-admin.php');
    }
    else
    {
        //Failed to Delete Admin
        //echo "Failed to Delete Admin";
        //create a session variable to display a message
        $_SESSION['delete'] = "<div class='error'>Failed  to Delete Admin. try again later</div>";
        header('Location:manage-admin.php');
        
    }

    //3. Redirect to Manage admin mage with message (success/error)


?>