
<?php include('partials/menu.php'); ?>

        <!-- Main Content section Starts -->
        <div class="main-content">
            <div class="wrapper">
                <h1>Manage User</h1>
                
                <br/>
                
                <?php 
                    if(isset($_SESSION['add']))
                    {
                        echo $_SESSION['add']; //Displaying Session Message
                        unset($_SESSION['add']); //Removing Session Message
                    }
                    
                    if(isset($_SESSION['delete']))
                    {
                        echo $_SESSION['delete']; 
                        unset($_SESSION['delete']); 
                    }
                    
                    if(isset($_SESSION['update']))
                    {
                        echo $_SESSION['update']; 
                        unset($_SESSION['update']); 
                    }
                    
                    if(isset($_SESSION['user-not-found']))
                    {
                        echo $_SESSION['user-not-found']; 
                        unset($_SESSION['user-not-found']); 
                    }

                    if(isset($_SESSION['pwd-not-match']))
                    {
                        echo $_SESSION['pwd-not-match']; 
                        unset($_SESSION['pwd-not-match']); 
                    }

                    if(isset($_SESSION['change-pwd']))
                    {
                        echo $_SESSION['change-pwd']; 
                        unset($_SESSION['change-pwd']); 
                    }
                ?>

                <br><br><br>

                <!-- button to add Admin -->
                <a href="add-admin.php" class="btn-primary">Add User</a>

                <br/><br/><br/>

                <table class="tbl-full">
                    <tr>
                        <th>S.N</th>
                        <th>Full_name</th>
                        <th>username</th>
                        <th>userType</th>
                        <th>actions</th>
                    </tr>

                    <?php 
                        //Query to Get all Admin
                        $sql ="SELECT * FROM employee WHERE usertype != 'admin'";
                        //Execute the Query
                        $res = mysqli_query($conn, $sql);

                        //check whether the query is executed or not
                        if($res==TRUE)
                        {
                            // Count Rows to Check whether we have data in database or not
                            $count = mysqli_num_rows($res); //Functions to get all rows in database
                            $sn=1;

                            //Check the num of rows
                            if ($count>0);
                            {
                                //we have data in database
                                while($rows=mysqli_fetch_assoc($res))
                                {
                                    //using while loop to get all the data from database.
                                    //And while loop will run as long as we have data in database

                                    //Get individual Data
                                    $id=$rows['id'];
                                    $full_name=$rows['full_name'];
                                    $username=$rows['username'];
                                    $userType=$rows['userType'];

                                    //Display the Values in our Table
                                    ?>

                                       <tr>
                                          <td><?php echo $sn++; ?></td>
                                          <td><?php echo $full_name; ?></td>
                                          <td><?php echo $username; ?></td>
                                          <td><?php echo $userType; ?></td>
                                          <td>
                                              
                                              <a href="update-admin.php?id=<?php echo $id; ?>" class="btn-primary">Update User</a>

                                              <?php
                                                    if(  $userType=$rows['status'] == 1)
                                                    {
                                                        ?>
                                                        <a href="delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Disable User</a>
                                                    <?php
                                                    }
                                                    else
                                                    {
                                                        ?>
                                                        <a href="enable_user.php?id=<?php echo $id; ?>" class="btn-secondary">Enable User</a>
                                                    <?php
                                                    }
                                                  
                                              ?>
                                              
                                          </td>

                                        </tr>

                                    <?php
                                }
                            }
                        }

                            else
                            {
                               //We do not have Data in Database
                            }
                            
                        
                        

                    ?>

                    

                </table>


            </div>
        </div>
        <!-- Main Content section Ends -->

<?php include('partials/footer.php'); ?>