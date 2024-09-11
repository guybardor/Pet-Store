<?php 
include "db_config.php";

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="proj2022.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>

<body>

        <table class="table">
            <?php
                switch($id_quey=$_GET['id_query'])
                {
                    case 9:
                    {
                        if($_GET['order_number'] > 0 and $_GET['worker_id'] > 0 )
                        {
                            $order_number=$_GET['order_number'];
                            $worker_id=$_GET['worker_id'];
                            $query_pr="call animal_pat_g.update_order('$order_number','$worker_id')";
                            $handle=$connection->prepare($query_pr);
                            $handle->execute();
                            $query_2="select * from my_order;";
                            $result = mysqli_query($connection,$query_2);
                            if(!$result)
                            {
                                die("reuslt is null");
                                exit();
                            }
                            echo
                                "
                                    case 9<br>
                                    <thead>
                                        <tr>
                                            <th>o_id</th>
                                            <th>w_id</th>
                                            <th>send_date</th>
                                        </tr>
                                    </thead>
                                ";
                            while($row=mysqli_fetch_assoc($result))
                            {
                                echo
                                "
                                    <tbody>
                                        <tr>
                                            <td>".$row['o_id']. " </td>
                                            <td>".$row['w_id']. "</td>
                                            <td>".$row['send_date']. " </td>
                                        </tr>
                                    </tbody>
                                ";
                            }
                        }
                        else
                        {
                            echo"case9<br>";
                            echo"you try update your order<br>";
                            if($_GET['order_number']<0 or $_GET['order_number'] == 0)
                            {
                                echo " but your order number is wrong<br>";
                            }
                            elseif($_GET['worker_id'] < 0 or $_GET['worker_id'] == 0 ){
                                echo "your worker_id is wrong ";
                            }
                            else{
                                echo "both of your input are wrong<br>";
                            }
                            exit();
                        }
                        break;
                    }
                    case 10:
                    {
                        if($_GET['quantity_of_product'] > 0 and $_GET['quantity_of_days'] > 0 )
                        {
                            $quantity_of_product=$_GET['quantity_of_product'];
                            $quantity_of_days=$_GET['quantity_of_days'];
                            $query_pr="call report_product('$quantity_of_product','$quantity_of_days')";
                            $result = mysqli_query($connection,$query_pr);
                            if(!$result)
                            {
                                die("reuslt is null");
                                exit();
                            }
                            echo
                                "
                                    case 10<br>
                                    <thead>
                                        <tr>
                                            <th>P_name</th>
                                            <th>count</th>
                                        </tr>
                                    </thead>
                                ";
                            while($row=mysqli_fetch_assoc($result))
                            {
                                echo
                                "
                                    <tbody>
                                        <tr>
                                            <td>".$row['p_name']. " </td>
                                            <td>".$row['count(*)']. "</td>
                                        </tr>
                                    </tbody>
                                ";
                            }
                        }
                        else
                        {
                            echo "you try watch best sell product in x days<br>";
                            if($_GET['quantity_of_product']<= 0)
                            {
                                echo " but your quantity_of_product is wrong<br>";
                            }
                            elseif($_GET['quantity_of_days'] <= 0){
                                echo " but your quantity_of_days is wrong <br>";
                            }
                            else{
                                echo "both of input is wrong<br>";
                            }
                            exit();
                        }
                        break;
                    }
                    case 11:
                    {
                        if($_GET['order_number'] > 0 and $_GET['order_discount'] > 0 )
                        {
                            $order_number=$_GET['order_number'];
                            $order_discount=$_GET['order_discount'];
                            $query_pr="call animal_pat_g.discount_order('$order_number','$order_discount')";
                            $handle=$connection->prepare($query_pr);
                            $handle->execute();
                            $query_pr2="select * from my_order;";
                            $result = mysqli_query($connection,  $query_pr2);
                            if(!$result)
                            {
                                die("reuslt is null");
                                exit();
                            }
                            echo
                                "
                                    case 11<br>
                                    <thead>
                                        <tr>
                                            <th>O_ID</th>
                                            <th>C_id</th>
                                            <th>w_id</th>
                                            <th>o_date</th>
                                            <th>send_date</th>
                                            <th>o_price</th>
                                        </tr>
                                    </thead>
                                ";
                            while($row=mysqli_fetch_assoc($result))
                            {
                                echo
                                "
                                    <tbody>
                                        <tr>
                                            <td>".$row['o_id']. " </td>
                                            <td>".$row['c_id']."</td>
                                            <td>".$row['w_id']."</td>
                                            <td>".$row['o_date']."</td>
                                            <td>".$row['send_date']."</td>
                                            <td>".$row['o_price']."</td>
                                        </tr>;
                                    </tbody>
                                ";
                            }
                        }
                        else
                        {
                            echo "you try watch product price after discount";
                            if($_GET['order_number']<= 0)
                            {
                                echo " but your order_number is wrong<br>";
                            }
                            elseif($_GET['order_discount'] <= 0){
                                echo " but your order_discount is wrong <br>";
                            }
                            else{
                                echo "both of input is wrong<br>";
                            }
                            exit();
                        }
                        break;
                    }
                    case 14:
                    {
                        if($_GET['worker_name'] !=  NULL and $_GET['month'] > 0 and $_GET['year'] > 0  )
                        {
                            $worker_name=$_GET['worker_name'];
                            $month=$_GET['month'];
                            $year=$_GET['year'];
                            $query_pr="select income_worker('$worker_name','$month','$year');";
                            // $handle=$connection->prepare($query_pr);
                            // $handle->execute();
                            $result = mysqli_query($connection,$query_pr);
                            if(!$result)
                            {
                                die("reuslt is null");
                                exit();
                            }
                            echo
                                "
                                    case 14<br>
                                    <thead>
                                        <tr>
                                            <th>income_worker('$worker_name','$month','$year')</th>
                                        </tr>
                                    </thead>
                                ";
                            while($row=mysqli_fetch_assoc($result))
                            {
                                echo
                                "
                                    <tbody>
                                        <tr>
                                            <td>".$row["income_worker('$worker_name','$month','$year')"]. " </td>
                                        </tr>;
                                    </tbody>
                                ";
                            }
                        }
                        else
                        {
                            echo "you try see the  amount income of worker in month";
                            if($_GET['worker_name'] == null)
                            {
                                echo " but your worker_name is wrong<br>";
                            }
                            elseif($_GET['month'] <= 0){
                                echo " but your month is wrong <br>";
                            }
                            elseif($_GET['year'] <= 0){
                                echo " but your year is wrong <br>";
                            }
                            else{
                                echo "some of input are wrong<br>";
                            }
                            exit();
                        }
                        break;
                    }

                }

        ?>
        </table>
</body>
</html>