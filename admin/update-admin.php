<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update User</h1>
        <br><br>

        <?php
          //1. get the ID of selected admin
          $id=$_GET['id'];
          //2. Create a query to get the details
          $sql="SELECT * FROM employee WHERE id=$id";
          //3. execute the query
          $res=mysqli_query($conn, $sql);
          //check whether the query is executed or not
          if($res==true)
          {
            //Check whether the data is available or not
            $count = mysqli_num_rows($res);
            //check whether we have admin data or not
            if($count==1)
            {
                //get the details
                //echo "Admin Available";
                $rows=mysqli_fetch_assoc($res);

                $full_name = $rows['full_name'];
                $username = $rows['username'];
            }
            else
            {
                //redirect to manage admin page
                header('Location:manage-admin.php');
            }
          }
        
        
        ?>

        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                  
                    <td>Full Name</td>
                    <td>
                        <input type="text" name="full_name" value="<?php echo $full_name; ?>">
                    </td>
                </tr>

                <tr>
                    
                    <td>Username</td>
                    <td>
                        <input type="text" name="username" value="<?php echo $username; ?>">
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
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>
    </div>
</div>

<?php 
  //check whether the submit button is clicked or not
  if(isset($_POST['submit']))
  {
    //echo"button Clicked";
    //get all the values from form
    $id = $_POST['id'];
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $usertype = $_POST['usertype'];

    //create sql query to update admin
    $sql = "UPDATE employee SET
    full_name = '$full_name',
    username = '$username'
    WHERE id='$id'
    ";

    //execute the query
    $res = mysqli_query($conn, $sql);
    //query executed successfully or not
    if($res==true)
    {
        echo "<script> Swal.fire({
            type: 'success',
            text: 'Employee Updated Successfully!',
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
            text: 'Unable to Update Employee!',
            timer:2000,
            showConfirmButton:false
            }).then(function() {
        window.location = 'manage-admin.php';
    })
    </script>";
    }
  }
?>




<?php include('partials/footer.php'); ?>