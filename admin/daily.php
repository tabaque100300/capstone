
<?php include('reports.php'); ?>

        

<div class="calendar">
    <form action="" method="post">
    <input type="date" name="date1" class="date">
    <span class="to">to</span>
    <input type="date" name="date2" class="date">
    <button class="earch" name="submit">Search</button>

    <button class="print">Print Reports</button>
    </form>
</div>



<div class="ban">
    <h2>Daily Reports</h2>
    <table class="flex">
        <thead>
            <tr>
                <th>Number</th>
                <th>Customer Name</th>
                <th>Amount Payed</th>
                <th>Cash</th>
                <th>Change</th>
                <th>Time</th>
                <th>Date</th>
            </tr>

                <?php
                if(isset($_POST['submit']))
                {

                    $date1= new DateTime($_POST['date1']);
                    $date1 = $date1->format('Y-m-d');
                    $date2= new DateTime($_POST['date2']);
                    $date2 = $date2->format('Y-m-d');
                    $sql="SELECT * FROM `order` WHERE date between '$date1' and '$date2' and status=1";
                    $res=mysqli_query($conn, $sql);
                    $sn=1;
                    while($user_fetch=mysqli_fetch_assoc($res))
                    {
                        ?>

                            <tr>
                                <td><?php echo $sn++ ?></td>
                                <td><?php echo $user_fetch['cus_name'] ?></td>
                                <td><?php echo $user_fetch['total'] ?></td>
                                <td><?php echo $user_fetch['cash'] ?></td>
                                <td><?php echo $user_fetch['change_amount'] ?></td>
                                <td><?php echo $user_fetch['time'] ?></td>
                                <td><?php echo $user_fetch['date'] ?></td>
                            </tr>

                        <?php
                    }
                
                }

               else{
                $date=date('Y-m-d');

                $sql="SELECT * FROM `order` WHERE date='$date' and status=1";
                $res=mysqli_query($conn, $sql);
                $sn=1;
                while($user_fetch=mysqli_fetch_assoc($res))
                {
                    ?>

                        <tr>
                            <td><?php echo $sn++ ?></td>
                            <td><?php echo $user_fetch['cus_name'] ?></td>
                            <td><?php echo $user_fetch['total'] ?></td>
                            <td><?php echo $user_fetch['cash'] ?></td>
                            <td><?php echo $user_fetch['change_amount'] ?></td>
                            <td><?php echo $user_fetch['time'] ?></td>
                            <td><?php echo $user_fetch['date'] ?></td>
                        </tr>

                    <?php
                }

               } 
                  
                ?>

        </thead>

 

    </table>



</div>
<br>
<?php
if(isset($_POST['submit']))

{
    $date1= new DateTime($_POST['date1']);
    $date1 = $date1->format('Y-m-d');
    $date2= new DateTime($_POST['date2']);
    $date2 = $date2->format('Y-m-d');
$query="SELECT SUM(total) as sum from `order` WHERE date between '$date1' and '$date2' and status =1";
$result=mysqli_query($conn, $query);
$row=mysqli_fetch_assoc($result);
    ?>
       <h3 class="ttl_sales">Total Sales: ₱<?php echo number_format($row['sum'],2); ?></h3>
    <?php
}
else
{
    $date=date('Y-m-d');
    $query="SELECT SUM(total) as sum from `order` WHERE date= '$date' and status =1";
    $result=mysqli_query($conn, $query);
    $row=mysqli_fetch_assoc($result);
    ?>
<h3 class="ttl_sales">Total Sales: ₱<?php echo number_format($row['sum'],2); ?></h3>
    <?php
}

?>




