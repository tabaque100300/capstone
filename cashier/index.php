<?php include('menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Marinos Cafe</h1>
        
        <br><br>


                    <?php 
                        if(isset($_SESSION['login']))
                        {
                         echo $_SESSION['login']; //Displaying Session Message
                        unset($_SESSION['login']); //Removing Session Message
                        }
                        
                     ?>

                     <?php 
                        if(isset($_SESSION['change-pwd']))
                        {
                         echo $_SESSION['change-pwd']; //Displaying Session Message
                        unset($_SESSION['change-pwd']); //Removing Session Message
                        }
                        
                     ?>

                    <?php 
                        if(isset($_SESSION['pwd-not-match']))
                        {
                         echo $_SESSION['pwd-not-match']; //Displaying Session Message
                        unset($_SESSION['pwd-not-match']); //Removing Session Message
                        }
                        
                     ?>

                    <?php 
                        if(isset($_SESSION['user-not-found']))
                        {
                         echo $_SESSION['user-not-found']; //Displaying Session Message
                        unset($_SESSION['user-not-found']); //Removing Session Message
                        }
                        
                     ?>



        <br /> <br />

                 <!-- button to Add Admin-->
        

                 <br />
                 <h1 class="txt-align">Orders</h1>
                 <br><br>

                 
                 <table class='tbl-full'>
                        <colgroup>
                    
                    <col width=15%>
                    <col width=10%>
                    <col width=10%>
                    <col width=50%>
                    <col width=15%>
                
                    
                    </colgroup>

                            <tr>
                                <th>Customer name</th>
                                <th>Order Type</th>
                                <th>Total Amount</th>
                                <th>Order Details</th>
                                <th>Process</th>

                            </tr>
                    <?php
                    
                    $sql="SELECT * FROM `order` WHERE status=0";
                    $user_result=mysqli_query($conn, $sql);
                    while($user_fetch=mysqli_fetch_assoc($user_result))
                    {
                        ?>
                          <tr>
                             <td><?php echo $user_fetch['cus_name']; ?></td>
                             <td><?php echo $user_fetch['order_type']; ?></td>
                             <td><?php echo $user_fetch['total']; ?></td>
                             <td>
                             <table class='tbl-full'>
                                <colgroup>            
                    <col width=40%>
                    <col width=30%>
                    <col width=30%>
                    </colgroup>
                                    <thead>
                                        <tr>
                                            <th>Item Name</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                        </tr>


                                    </thead>

                                    <tbody>
                                        
                             <?php  
                    $sql1="SELECT * FROM `order_details` WHERE id=' $user_fetch[id]'";
                    $user_result1=mysqli_query($conn, $sql1);
                    while($user_fetch1=mysqli_fetch_assoc($user_result1))
                    {
                        $id=$user_fetch1['id'];
                                ?>
                                        <tr>
                                        <td><?php echo $user_fetch1['item_name']; ?></td>
                                        <td><?php echo $user_fetch1['price']; ?></td>
                                            <td><?php echo $user_fetch1['qty']; ?></</td>
                                        </tr>
                                <?php
                    }
                    ?>
                                    </tbody>





                                </table>
    
                          
                                    
                             </td>
                         
                             <td>
                                <a href="cashier.php?id=<?php echo $id; ?>"><button class="btn-secondary">Process Order</button></a><br><br>
                                <a href="delete-order.php?id=<?php echo $id; ?>" class="btn-danger">Delete Order</a>
                            </td>
                             
                             </tr>
                             <?php
                    }
                    ?>
                    

                    

                   
</table>
</div>

</div>



