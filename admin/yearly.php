<?php include('reports.php'); ?>

<div class="calendar">

    <form action="" method="post">

        <select name="year" id="month" class="date" required>

            <option value="0">Select Year</option>
            <option value="2023">2023</option>
            <option value="2024">2024</option>
            <option value="2025">2025</option>
            <option value="2026">2026</option>
            <option value="2027">2027</option>
            <option value="2028">2028</option>
            <option value="2029">2029</option>
            <option value="2030">2030</option>
            <option value="2031">2031</option>
            <option value="2032">2032</option>
            <option value="2033">2033</option>
            <option value="2034">2034</option>
        </select>

        <button class="earch" name="submit">Search</button>

              
    <button class="print">Print Reports</button>
    </form>

</div>  

<div class="ban">
    <h2>Yearly Reports</h2>
    <table class="dex">
    <colgroup>
                    
            <col width=20%>
            <col width=20%>
            <col width=20%>
            <col width=20%> 
            

                                
                            
                              
     </colgroup>


            <?php
            
            

                if(isset($_POST['submit']))
                {
                        if($_POST['year'] > 0)
                    {
        
                        $current_year = $_POST['year'];
                        $sn=1;
        
                        $sql = "SELECT DATE(date) as `order_date`, COUNT(*) as `total_orders`, SUM(total) as `total_sales` FROM `order` WHERE  YEAR(date) = $current_year and status != 0 GROUP BY MONTH(date)";
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
                                $date = $date1->format('F, Y');
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
                   
                    $current_year = date('Y');
                    $sn=1;
                    $sql = "SELECT DATE(date) as `order_date`, COUNT(*) as `total_orders`, SUM(total) as `total_sales` FROM `order` WHERE  YEAR(date) = $current_year and status != 0 GROUP BY MONTH(date)";
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
                                $date = $date1->format('F, Y');
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
        $current_year=$_POST['year'];
        $sql = "SELECT  SUM(total) as `total_sales` FROM `order` WHERE YEAR(date) = $current_year and status != 0 ";
        $res = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($res);
        ?>
            <h3 class="ttl_sales">Yearly Total Sales: ₱<?php echo number_format($row['total_sales'],2); ?></h3>
        <?php
    }
    else
    {
        $current_year = date('Y');
        $sql = "SELECT  SUM(total) as `total_sales` FROM `order` WHERE YEAR(date) = $current_year and status != 0 ";
        $res = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($res);
        ?>
            <h3 class="ttl_sales">Yearly Total Sales: ₱<?php echo number_format($row['total_sales'],2); ?></h3>
        <?php
    }

?>