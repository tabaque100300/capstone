
<?php include('partials/menu.php'); ?>



<div class="main-content">
    <div class="wrapper">
        <h1>Orders</h1>

        <br /> <br />

                 <!-- button to Add Admin-->
        

                 <br /> <br /> <br />

                 
                 <table class='tbl-full'>
                        <colgroup>
                    
                    <col width=20%>
                    <col width=20%>
                    <col width=60%>
                    
                
                    
                    </colgroup>

                            <tr>
                                <th>Customer name</th>
                                <th>Total Amount</th>
                                <th>Order Details</th>
                                

                            </tr>
                    <?php
                    
                    $sql="SELECT * FROM `order`";
                    $user_result=mysqli_query($conn, $sql);
                    while($user_fetch=mysqli_fetch_assoc($user_result))
                    {
                        $id=$user_fetch['id'];
                        ?>
                          <tr>
                             <td><?php echo $user_fetch['cus_name']; ?></td>
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
                        
                            
                             

                             </tr>
                             <?php
                    }
                    ?>
                    

                    

                   
</table>
</div>

</div>


<?php include('partials/footer.php'); ?>