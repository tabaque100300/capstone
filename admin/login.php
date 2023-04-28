<?php 
      include('../config/constants.php');
?>
<html>
        <head>

            <title>Login</title>
            <link rel="stylesheet" type="text/css" href="../fontawesome/css/all.min.css">
            <link rel="stylesheet" type="text/css" href="../css/index.css">
        </head>
    <body>
        <div class="container">
            <div class="header">
                <h1>login</h1>
                <?php 
            if(isset($_SESSION['login']))
            {
                echo $_SESSION['login']; 
                unset($_SESSION['login']); 
            }

            if(isset($_SESSION['no-login-message']))
            {
                echo $_SESSION['no-login-message']; 
                unset($_SESSION['no-login-message']); 
            }
            if(isset($_SESSION['erro']))
            {
                echo $_SESSION['erro']; 
                unset($_SESSION['erro']); 
            }


        ?>
            </div>
                <div class="main">
                    <form method="POST" class="text-center">
                        <span>
                        
                            <i class="fa fa-user"></i>
                            <input type="text" placeholder="Username" name="username" required>
                        </span><br>
                        <span>
                            <i class="fa fa-lock"></i>
                            <input type="password" placeholder="password" name="password" required>
                        </span><br>

                            <input type="submit" value="Login" name="submit" class="textcenter" >
                            <br><br>
                    </form>
                            <!-- Login Form Ends Here -->

                            <p class="text-center">Created By - <a href="">Tech Phantoms</a></p>

                </div>
        </div>
    </body>
</html>


<?php


?>
<script>
function showPassword() {
    var passwordField = document.getElementById("password");
    if (passwordField.type === "password") {
        passwordField.type = "text";
    } else {
        passwordField.type = "password";
    }
}
</script>
<?php if (isset($_POST['submit'])) {
    //get data from form
    $user_name = mysqli_real_escape_string($conn, $_POST['username']);
    $password = md5(mysqli_real_escape_string($conn, $_POST['password']));

    //check sql if username and password exists

    $sql =
        "SELECT * FROM employee  WHERE username ='$user_name'
        AND password = '$password' and status = 1";
    //execute query
    $res = mysqli_query($conn, $sql);

    $count = mysqli_fetch_assoc($res);

    if ($count['userType'] == 'admin') {
        $_SESSION['login'] = "<div class='success'>Login Successful. Welcome Admin.</div>";
        $_SESSION['user'] = $user_name;
        header('location:index.php');
    }
     else if ($count['userType'] == 'cashier')  {
        $_SESSION['login'] = "<div class='success'>Login Successful. Welcome Cashier. </div>";
        $_SESSION['user'] = $user_name;
        header('location:../cashier/index.php');
            
        }
        else if ($count['userType'] == 'kiosk') {
        $_SESSION['login'] = "<div class='success'>Login Successful. Welcome Cashier. </div>";
        $_SESSION['user'] = $user_name;
        header('location:../kiosk/index.php');
        }
        else{
            $_SESSION['erro'] = "<div class='error'>User not found. </div>";
         
            header('location:../kiosk/index.php');
        
              header('location:login.php');
           
        }
   
} ?>

