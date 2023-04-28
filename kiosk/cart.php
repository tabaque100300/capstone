<?php include('../partials-front/menu.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center border rounded bg-light my-5">
                <h1>MY CART</h1>
            </div>
            <br><br>

    <div class="col-lg-8">
        <table class="table2">
               <thead class="text-center">
                 <tr>
                    <th scope="col">no:</th>
                    <th scope="col">Item Name</th>
                    <th scope="col">Item Price</th>
                    <th scope="col">Total Price</th>
                    <th scope="col">qty</th>
                    <th scope="col">Actions</th>
                 </tr>
               </thead>
           <tbody class="text-center">
       
           <?php
            $tprice=0;
            $tamount=0;
            $total=0;
            $sn=1;
            if(isset($_SESSION['cart']))
            {
               
                foreach ($_SESSION['cart'] as $key => $value) 
                {
                    $tprice = $value['fprice'] * $value['fqnty'];
                    $total+=$value['fprice'] * $value['fqnty'];
                    $id= $value['fid'];
         ?>
                <tr>
                    <td><?php  echo $sn++; ?></td>
                    <td><?php echo $value['food']; ?></td>
                    <td><?php echo $value['fprice']; ?></td>
                    <td><?php echo number_format($tprice, 2) ?></td>
                    <form action="" method="POST">
                    <td><input class='text-center' name="qnty" type='number' value="<?php echo $value['fqnty']; ?>" min='1' max='10'></td>
              
                    <td>
                    
                    <button name='update' class='btn btn-sm btn-outline-danger'>Update</button>
                    <button name='cancel' class='btn btn-sm btn-outline-danger' onclick="return confirm('Are you sure you want to cancel your order?')">Remove</button>
                          <input type='hidden' name='item' value="<?php echo $value['food']; ?>">
                          <input type='hidden' name='id' value="<?php echo $value['fid']; ?>">
                          <input type='hidden' name='qty' value="<?php echo $value['fqnty']; ?>">
                      </form>
                    </td>
                </tr>    
             
             <?php
           }
           }
           if(isset($_POST['cancel'])) {
            foreach ($_SESSION['cart'] as $key => $value) {
                if($value['food'] === $_POST['item']) {
                    $sql4="UPDATE food SET Stocks = Stocks + '$value[fqnty]' WHERE id= '$value[fid]'";
                                    $res4=mysqli_query($conn, $sql4);
                                    unset($_SESSION['cart'][$key]);
                                    $_SESSION['cart'] = array_values($_SESSION['cart']);

                                    echo "<script> Swal.fire({
                                                        type: 'success',
                                                        text: 'item Removed!',
                                                        timer:2000,
                                                        showConfirmButton:false
                                                        }).then(function() {
                                                        window.location = 'cart.php';
                                                    })
                                                    </script>";
                }
            }
           }
           
           if(isset($_POST['cancel_order']))
                {
                    foreach($_SESSION['cart'] as $key => $value)
                    {
                        $id= $_POST['id'];
                        $qnty2=$_POST['qty'];
                        $new_stock=$value['fqnty'];
                        $sql4="UPDATE food SET Stocks = Stocks + $new_stock WHERE id= '$id'";
                        $res4=mysqli_query($conn, $sql4);
                    }
                    unset($_SESSION['cart']);
                    echo "<script> Swal.fire({
                        type: 'success',
                        text: 'Order cancelled!',
                        timer:2000,
                        showConfirmButton:false
                        }).then(function() {
                        window.location = 'cart.php';
                    })
                    </script>";
                }
 
             if(isset($_POST['update']))
             {
                foreach($_SESSION['cart'] as $key => $value)
                {
                    if($value['food'] === $_POST['item'])
                    {
                    $_SESSION['cart'][$key]['fqnty'] = $_POST['qnty'];
                    $id= $_POST['id'];
                    $qnty2=$_POST['qty'];
                    $new_stock=$_POST['qnty'] - $qnty2;
                    $sql4="UPDATE food SET Stocks = Stocks - $new_stock WHERE id= '$id'";
                    $res4=mysqli_query($conn, $sql4);
                    if($res4 == TRUE)
                    {
                        echo "<script> Swal.fire({
                            type: 'success',
                            text: 'Item Updated!',
                            timer:2000,
                            showConfirmButton:false
                            }).then(function() {
                        window.location = 'cart.php';
                    })
                    </script>";
                    }
                       
                    }
                }
             }
           ?>
               
           </tbody>
        </table>               


    </div>

    <div class="col-lg-4">
       <div class="border bg-light round p-4">
        <br><br>
           <h4 class="text-right">Total:</h4>
           <h5 class="text-right">Php <?php echo number_format($total, 2)  ?></h5>
           <br>
           <form action="" method="POST">
           <div>
            <label>Customer Name</label> <br>
            <input class="Cusname" type="text" name="cus_name"  placeholder="please enter your name" required> <br><br>
                <div class="chckbx">
                    <input type="radio" name="order_type" value="Dine-in" class="chckbx" required> Dine-in
                    <input type="radio" name="order_type" value="Take-out" class="chckbx" required> Take-out
                </div>
                </div>
            <br>
            <button class="makepurchase" type="submit" name="purchase">Make Purchase</button>
           </form>
           <?php
    if(isset($_POST['purchase']))
    {
        $date=date('m d y');
        $sql1="INSERT INTO `order` (`cus_name`, `total`,`date`,`order_type`) VALUES ('$_POST[cus_name]', '$total', NOW(),'$_POST[order_type]' )";
        if(mysqli_query($conn, $sql1))
        {
            $id=mysqli_insert_id($conn);
            $sql2="INSERT INTO `order_details`(`id`, `item_name`, `price`, `qty`,`total_price`) VALUES (?,?,?,?,?)";
            $stmt=mysqli_prepare($conn, $sql2);
            if($stmt)
            {
                mysqli_stmt_bind_param($stmt,'isdid',$id,$item_name,$price,$qty,$total);
                foreach($_SESSION['cart'] as $key => $values)
                {
                    $item_name=$values['food'];
                    $price=$values['fprice'];
                    $qty=$values['fqnty'];
                    $total=$values['fprice'] * $values['fqnty'];
                    mysqli_stmt_execute($stmt);
                }
                unset($_SESSION['cart']);

                echo "<script> Swal.fire({
                    type: 'success',
                    text: 'Order Placed!',
                    timer:2000,
                    showConfirmButton:false
                    }).then(function() {
                window.location = 'index.php';
                })
                </script>";
                
            }
       
            else
            {
               echo "<script>
                  alert('SQL Query Prepare Error');
                  window.location.href='cart.php';
                </script>";
            }
        }
    } 
    ?>     
       </div>
    </div>

    </div>

</div>
</body>
</html>


