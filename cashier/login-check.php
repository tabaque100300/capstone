<?php
    //Authorization - access control
    //check whether the user is loggedin or not
    if(!isset($_SESSION['user'])) //if user session is not set
    {
        //user not logged in
        //redirect to login page with message
        $_SESSION['no-login-message'] = "<div class='error'>Please Login to access Cashier Panel. </div>";
        header('location:login.php');
    }

?>