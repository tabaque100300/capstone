<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add User</h1>

        <br>



        <?php 
            if(isset($_SESSION['add'])) //Checking Whether the Session is checked or not
            {
                echo $_SESSION['add']; //Display Session Message if Set
                unset($_SESSION['add']); //Remove Session Message
            }
        ?>

        <form action="" method="POST">

        <table class="tbl-30">
            
            <tr>
                <td>Full name:</td>
                <td><input type="text" name="full_name" placeholder="Enter your name" required>
            </td>

            </tr>

            <tr>
                <td>Username:</td>
                <td><input type="email" name="username" placeholder="Your username" required>
                </td>

            </tr>

           

            <tr>
                <td>password:</td>
                <td><input type="password" name="password" placeholder="Your Password" required>
            </td>

            </tr>

            <tr>
                    <td>Usertype: </td>
                    <td>
                        <select name="usertype" type="name" id="">
                            <option value="cashier">Cashier</option>
                            <option value="kiosk">Kiosk</option>
                        </select>
                    </td>
                </tr>

            <tr>
                <td colspan="2">
                    <input type="submit" name="submit" value="Add User" class="btn-secondary">
                </td>
            </tr>

        </table>
        </form>
    </div>
</div>

<?php include('partials/footer.php'); ?>



<?php
    //Process the Value from Form and Save it in Database
    
    //Check whether the submit button is clicked or not
    if(isset($_POST['submit']))
    {
        //button Clicked
        //echo "Button Clicked";

        //Get the data from form
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $usertype = $_POST['usertype']; 

        // Check password strength
        if (strlen($password) < 8 || !preg_match("#[0-9]+#", $password) || !preg_match("#[A-Z]+#", $password) || !preg_match("#[a-z]+#", $password)) {
            $_SESSION['add'] = "<div class='errr'>Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, and one number.</div>";
            $_SESSION['full_name'] = $full_name;
            $_SESSION['username'] = $username;
            $_SESSION['usertype'] = $usertype;
            header("location: add-admin.php");
            exit();
        }

        // Password is strong, proceed to save data
        $password = md5($password);

        // SQL Query to Save the data into database
        $sql = "INSERT INTO employee SET
            full_name='$full_name',
            username='$username',
            password='$password',
            userType='$usertype'";

        $res = mysqli_query($conn, $sql) or die(mysqli_error());
        if($res==TRUE)
        {
            echo "<script> Swal.fire({
                type: 'success',
                text: 'Employee Added Successfully!',
                timer:2000,
                showConfirmButton:false
                }).then(function() {
            window.location = 'manage-admin.php';
        })
        </script>";
        }
        else
        {            
            echo "<script> Swal.fire({
                type: 'error',
                text: 'employee not added!',
                timer:2000,
                showConfirmButton:false
                }).then(function() {
            window.location = 'manage-admin.php';
        })
        </script>";
        }
    }
?>





