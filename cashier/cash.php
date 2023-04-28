<?php 

       include('../config/constants.php');
       
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="cashier.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body>

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">Navbar</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="update-pssword.php?username=<?php echo $_SESSION['user']; ?>">Change Password</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Logout</a>
              </li>
              
            </ul>
          </div>
        </div>
      </nav>

      <br><br><br>
      <h1 class="txt-align">Orders</h1>
      <br>

    

    <table class="table">
        <thead>
          <tr>
            <th scope="col">Customer Name</th>
            <th scope="col">Order Type</th>
            <th scope="col">Total Amount</th>
            <th scope="col">Order Details</th>
            <th scope="col">Process</th>
          </tr>

          <?php
          
            $sql="SELECT * FROM `order` WHERE status=0";
            $res=mysqli_query($conn, $sql);
            while($user_fetch=mysqli_fetch_assoc($res))
            {
              ?>

                <tr>
                  <td><?php echo $user_fetch['cus_name']; ?></td>
                  <td><?php echo $user_fetch['order_type']; ?></td>
                  <td><?php echo $user_fetch['total']; ?></td>
                  <td>
                      <table>
                        <colgroup>

                        <col width=53%>
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
                              
                                $sql1="SELECT * FROM `order_details` WHERE id='$user_fetch[id]'";
                                $res1=mysqli_query($conn, $sql1);
                                while($user_fetch1=mysqli_fetch_assoc($res1))
                                {
                                  $id=$user_fetch['id'];
                                  ?>

                                      <tr>
                                        <td><?php echo $user_fetch1['item_name']; ?></td>
                                        <td><?php echo $user_fetch1['price']; ?></td>
                                        <td><?php echo $user_fetch1['qty']; ?></td>
                                      </tr>

                                  <?php
                                }

                              
                              ?>
                          </tbody>
                      </table>
                  </td>
                  <td>
                     <a href="cashier.php?id=<?php echo $id; ?>"><button class="bbt">Process</button>
                     <a href="delete-order.php?id=<?php echo $id; ?>"><button class="bbn">Cancel</button>
                  </td>
                  
                </tr>

              <?php
            }
          
          ?>

        
          
          
        </tbody>
      </table>
    
</body>
</html>