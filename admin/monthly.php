
<?php include('reports.php'); ?>


<?php

    if(isset($_POST['submit']))
    {
        if($_POST['month'] && $_POST['year'] > 0)
        {
            $month = $_POST['month'];
            $month = date('F', mktime(0, 0, 0, $month = 10));
            $year = $_POST['year'];
        }
        else
        {
            $month = date('F');
            $year = date('Y');

        }
    }
    else
    {
        $month = date('F');
        $year = date('Y');
    }

?>




<div class="calendar">

    <form action="" method="post">

            <select name="month" id="month" class="date" required> 
                <option value="0">Select Month</option>
                <option value="01">January</option>
                <option value="02">February</option>
                <option value="03">March</option>
                <option value="04">April</option>
                <option value="05">May</option>
                <option value="06">June</option>
                <option value="07">July</option>
                <option value="08">August</option>
                <option value="09">September</option>
                <option value="10">October</option>
                <option value="11">November</option>
                <option value="12">December</option>
            </select>

            <select name="year" id="month" class="date" required>

                <option value="0">Select Year</option>
                <option value="2023">2023</option>
                <option value="2024">2024</option>
                <option value="03">2025</option>
                <option value="04">2026</option>
                <option value="05">2027</option>
                <option value="06">2028</option>
                <option value="07">2029</option>
                <option value="08">2030</option>
                <option value="09">2031</option>
                <option value="10">2032</option>
                <option value="11">2033</option>
                <option value="12">2034</option>
            </select>

            <button class="earch" name="submit">Search</button>




    <button class="print">Print Reports</button>
    </form>



</div>




<div class="ban">
    <h2>Monthly Reports</h2>
    <table class="dex">
    <colgroup>
                    
        <col width=20%>
        <col width=20%>
        <col width=20%>
        <col width=20%> 

        <?php
        
           
        
        ?>
                    
                
                    
    </colgroup>


    <?php

        if(isset($_POST['submit']))
        {
                if($_POST['month'] && $_POST['year'] > 0)
            {

     
                $current_month = $_POST['month'];
                $current_year = $_POST['year'];
                $sn=1;

                $sql = "SELECT DATE(date) as `order_date`, COUNT(*) as `total_orders`, SUM(total) as `total_sales` FROM `order` WHERE MONTH(date) = $current_month AND YEAR(date) = $current_year and status != 0 GROUP BY date";
                $result = $conn->query($sql);
                $count = mysqli_num_rows($result);
                if ($count > 0)
                {

                    ?>
                            <thead>
                                <tr>
                                    <th>Number</th>
                                    <th>Date</th>
                                    <th>Total Orders</th>
                                    <th>Total Sales</th>
                                </tr>
                            </thead>
                    <?php

                    $orders = [];
                    while ($row = $result->fetch_assoc())
                    {
                        $orders[$row['order_date']] = ['total_orders' => $row['total_orders'], 'total_sales' => $row['total_sales'],];
                    }

                    foreach ($orders as $date => $order)
                    {
                        $date1 = new DateTime($date);
                        $date1 = $date1->format('F, d, Y');
                        ?>

                            <tbody>
                                <tr>
                                    <td><?php echo $sn++; ?></td>
                                    <td><?php echo $date; ?></td>
                                    <td><?php echo $order['total_orders']; ?></td>
                                    <td><?php echo number_format ($order['total_sales'],2); ?></td>
                                </tr>
                            </tbody>

                        <?php
                    }

                }
            }
        }
        else
        {
            $date=date('F, d, y');
            $current_month = date('m');
            $current_year = date('Y');
            $sn=1;
            $sql = "SELECT DATE(date) as `order_date`, COUNT(*) as `total_orders`, SUM(total) as `total_sales` FROM `order` WHERE MONTH(date) = $current_month AND YEAR(date) = $current_year and status != 0 GROUP BY date";
                $result = $conn->query($sql);
                $count = mysqli_num_rows($result);
                if ($count > 0)
                {

                    ?>
                            <thead>
                                <tr>
                                    <th>Number</th>
                                    <th>Date</th>
                                    <th>Total Orders</th>
                                    <th>Total Sales</th>
                                </tr>
                            </thead>
                    <?php

                    $orders = [];
                    while ($row = $result->fetch_assoc())
                    {
                        $orders[$row['order_date']] = ['total_orders' => $row['total_orders'], 'total_sales' => $row['total_sales'],];
                    }

                    foreach ($orders as $date => $order)
                    {
                        $date1 = new DateTime($date);
                        $date1 = $date1->format('F, d, Y');
                        ?>

                            <tbody>
                                <tr>
                                    <td><?php echo $sn++; ?></td>
                                    <td><?php echo $date; ?></td>
                                    <td><?php echo $order['total_orders']; ?></td>
                                    <td><?php echo number_format ($order['total_sales'],2); ?></td>
                                </tr>
                            </tbody>

                        <?php
        }
    }
}
      

    ?>




</table>
</div>
<br>


<?php

    if(isset($_POST['submit']))
    {
        // $month= new DateTime($_POST['month']);
        // $month = $month->format('Y-m-d');
        $month=$_POST['month'];
        $year= $_POST['year'];
        $query="SELECT SUM(total) as sum from `order` WHERE MONTH(date) = $month AND YEAR(date) = $year and status =1";
        $result=mysqli_query($conn, $query);
        $row=mysqli_fetch_assoc($result);
        ?>
          <h3 class="ttl_sales">Total Sales: ₱<?php echo number_format($row['sum'],2); ?></h3>
        <?php

    }
    else
    {
        $current_month = date('m');
        $current_year = date('Y');
        $query="SELECT SUM(total) as sum from `order` WHERE MONTH(date) = $current_month AND YEAR(date) = $current_year and status =1";
        $result=mysqli_query($conn, $query);
        $row=mysqli_fetch_assoc($result);
        ?>
          <h3 class="ttl_sales">Monthly Total Sales: ₱<?php echo number_format($row['sum'],2); ?></h3>
        <?php
    }

?>




