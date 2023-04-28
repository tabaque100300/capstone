
<?php include('menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <div class="cont">
            <?php 
            if(isset($_GET['id']))
            {
                $id=$_GET['id'];


                $sql="SELECT * FROM `order` WHERE `id`=$id";
                $res=mysqli_query($conn, $sql);
                $row=mysqli_fetch_assoc($res);

?>
          
            
        
        <div class="orders">
             <br>
            <div class="border"><span class="title2">Customer Name:   <?php echo $row['cus_name']; ?></span></div>
   <div class="title">
    <span>Food Name:</span><br><br>
    <span>Price:</span><br><br>
    <span>Quantity:</span><br><br>
    <span>Total Price:</span><br>
   </div>
          
        

    
<div class="container">
    <?php
    $sql="SELECT * FROM `order_details` WHERE `id`=$id";
    $res=mysqli_query($conn, $sql);
    while($rows=mysqli_fetch_assoc($res))
    {
        ?>
        <div class="content">
            <ul>
                <li> <?php echo $rows['item_name']; ?>
</li>
<li><?php echo number_format($rows['price'],2); ?></li>
<li> <?php echo $rows['qty']; ?></li>
<li> <?php echo number_format($rows['total_price'],2);  ?></li>
            </ul>
   
      
     
     
      </div>
        <?php
    }
    ?>
   </div>

           <br>
           <div><span class="title3">Total Amount: Php <?php echo number_format($row['total'],2); ?></span><span><type="text"></span></div>
        </div>
  
  <?php
    }
            
?>



    
        <div class="calc">
            <form action="" method="POST">
            <div><span class="title">Amount to Pay</span><span><input type="number" value="<?php echo $row['total']; ?>" disabled><input type="hidden" name="total" value="<?php echo $row['total']; ?>" ></span></div>
            <div><span class="title">Cash</span><span><input type="number" name="cash" required></span></div>
            <button type="hidden" name="change"></button>
       
            <?php
            if(isset($_POST['cash']))
            {
                $tamount=$_POST['cash']-$_POST['total'];
                $cash=$_POST['cash'];
            }
          ?>
               </form>
               <form action="" method="POST">
                <input type="hidden" name="cash1" value="<?php echo $cash; ?>">
                <input type="hidden" name="change1" value="<?php echo $tamount; ?>">
            <div><span class="title">Change</span><span><input type="number" name="change" value="<?php echo $tamount; ?>" disabled></span></div>
           
          <button class="btn" name="submit">Process Payments</button>
          </form>
        </div>

        
        <?php
if(isset($_POST['submit']))
{
    $query="UPDATE `order` SET cash = '$_POST[cash1]', change_amount='$_POST[change1]', time=NOW(), status=1 WHERE id=$id";
    $result=mysqli_query($conn, $query);
    if($result)
    {
        echo "success";
        header('Location: index.php');
    }
    else{
        echo "failed";
    }
}


?>
        </div>
    </div>
</div>