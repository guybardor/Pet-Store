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
                    $action=$_GET['id_query'];
                    switch($action)
                    {
                            case 1:
                            {

                                    $query = "select * from team1_product;";
                                    $result = mysqli_query($connection,$query);
                                    if(!$result)
                                    {
                                        die("result is null");
                                        exit();
                                    }
                                    echo
                                        "
                                            case1 :
                                            <h1>הצג את כל המוצרים</h1>
                                            <thead>
                                                <tr>
                                                    <th>P_ID</th>
                                                    <th>p_name</th>
                                                    <th>p_price</th>
                                                    <th>p_quantity</th>
                                                </tr>
                                            </thead>
                                        "
                                    ;
                                    while($row=mysqli_fetch_assoc($result))
                                    {
                                        echo
                                        "

                                            <tbody>
                                                <tr>
                                                    <td>".$row['p_id']. " </td>
                                                    <td>".$row['p_name']."</td>
                                                    <td>".$row['p_price']."</td>
                                                    <td>".$row['p_quantity']."</td>
                                                </tr>;
                                            </tbody>
                                        "
                                        ;
                                    }
                                break;
                            }
                            case 2:
                            {

                                $date = date('Y-m-d');
                                $week_number=0;
                                echo
                                "

                                   <section id='change_form'>
                                        <form method=get action=change.php  >
                                            <span>please enter number of weeks</span>
                                            <input type=number name=week_number>
                                            <input type=submit name=submit value='enter number of weeks'>
                                            <input type=hidden value=2 name=id_query>
                                        </form>
                                    </section>
                                   

                                ";
                                if($_GET['week_number'] != 0)
                                {
                                    $week_number=$_GET['week_number'];
                                }
                                $query ="SELECT o_id,o_date  from   team1_my_order where (TIMESTAMPDIFF(WEEK, o_date,'$date') < $week_number)";
                                $result = mysqli_query($connection,$query);
                                if(!$result)
                                {
                                    die("result is null");
                                    exit();
                                }
                                echo
                                    "
                                        case2 :
                                        <h1>order in the last - $week_number</h1>
                                        <thead>
                                            <tr>
                                                <th>o_id</th>
                                                <th>o_date</th>
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
                                                <td>".$row['o_date']."</td>
            
                                            </tr>;
                                        </tbody>
                                    "
                                    ;
                                }
                                break;
                            }
                            case 3:
                            {

                                $query = "SELECT  w_position ,w_name ,w_address ,w_PHONE from team1_worker
                                left join team1_my_order on team1_my_order.w_id = team1_worker.w_id group by team1_worker.w_id order by count(team1_my_order.w_id) desc limit 1;";
                                $result = mysqli_query($connection, $query);
                                if(!$result)
                                {
                                    die("reuslt is null");
                                    exit();

                                }
                                echo
                                "
                                    case3
                                    <h1>העובד שמכר הכי הרבה מוצרים<h1>
                                    <thead>
                                        <tr>
                                            <th>w_position</th>
                                            <th>w_name</th>
                                            <th>w_address</th>
                                            <th>w_PHONE</th>
                                        </tr>
                                    </thead>
                                ";
                                while($row=mysqli_fetch_assoc($result))
                                {
                                    echo
                                    
                                    "
                                        <tr>
                                            <td>".$row['w_position']. " </td>
                                            <td>".$row['w_name']."</td>
                                            <td>".$row['w_address']."</td>
                                            <td>".$row['w_PHONE']."</td>
                                        </tr>
                                    ";

                                }
                            break;

                        }
                        case 4:
                        {
                            $query = "SELECT  w_position ,w_name ,w_address ,w_PHONE,sum(team1_my_order.o_price) from team1_worker left join team1_my_order on my_order.w_id = worker.w_id group by team1_worker.w_id order by sum(team1_my_order.o_price) desc ;";
                            $result = mysqli_query($connection, $query);
                            if(!$result)
                            {
                                die("reuslt is null");
                                exit();

                            }
                            echo
                            "
                                
                                CASE 4
                                <h1>העובדים שהכניסו הכי הרבה כסף בסדר יורד</h1>
                                <thead>
                                    <tr>
                                        <th >w_position</th>
                                        <th >w_name</th>
                                        <th >w_address</th>
                                        <th>w_PHONE</th>
                                        <th>sum(my_order.o_price)</th>
                                    </tr>
                                </thead>
                            ";
                            while($row=mysqli_fetch_assoc($result))
                            {
                                echo"
                                    <tbody>
                                        <tr>
                                            <td>".$row['w_position']. " </td>
                                            <td>".$row['w_name']."</td>
                                            <td>".$row['w_address']."</td>
                                            <td>".$row['w_PHONE']."</td>
                                            <td>".$row['sum(my_order.o_price)']."</td>
                                        </tr>
                                    </tbody>
                                ";
                            }
                            break;
                        }
                        case 5 :
                        {
                            $query = "SELECT * from team1_my_order inner join team1_customer on team1_my_order.c_id=team1_customer.c_id
                            where team1_my_order.send_date = '0000-00-00';";
                            $result = mysqli_query($connection, $query);
                            if(!$result)
                            {
                                die("reuslt is null");
                                exit();

                            }
                            echo 
                            "
                                case5
                                <h1>הזמנות פתוחות והלקוח שהזמין </h1>
                                <thead>
                                    <tr>
                                        <th>o_id</th>
                                        <th>c_id</th>
                                        <th scope=>w_id</th>
                                        <th>o_date</th>
                                        <th>send_date</th>
                                        <th>o_price</th>
                                        <th >c_id</th>
                                        <th>c_name</th>
                                        <th>C_PHONE</th>
                                        <th>c_address</th>
                                        <th >c_animel_id</th>
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
                                            <td>".$row['c_id']."</td>
                                            <td>".$row['c_name']."</td>
                                            <td>".$row['C_PHONE']."</td>
                                            <td>".$row['c_address']."</td>
                                            <td>".$row['c_animal_id']."</td>
                                        </tr>
                                    </tbody>
                                ";
                            }
                            break;
                        }
                        case 6 :
                        {
                            $query = "SELECT c_name ,C_PHONE ,c_address  from team1_customer left join team1_my_order on (team1_my_order.c_id = team1_customer.c_id ) group by team1_customer.c_id having count(team1_my_order.c_id) = 0 ;";
                            $result = mysqli_query($connection, $query);
                            if(!$result)
                            {
                                die("reuslt is null");
                                exit();

                            }
                            echo
                            "
                                case6
                                <h1>לקוחות שלא ביצעו אף הזמנה</h1> 
                                <thead>
                                    <tr>
                                        <th>c_name</th>
                                        <th>C_PHONE</th>
                                        <th scope=>c_address</th>
                                    </tr>
                                </thead>
                            ";
                            while($row=mysqli_fetch_assoc($result))
                            {
                                echo
                                "
                                    <tbody>
                                        <tr>
                                            <td>".$row['c_name']. " </td>
                                            <td>".$row['C_PHONE']."</td>
                                            <td>".$row['c_address']."</td>
                                        </tr>
                                    </tbody>
                                ";
                            }
                            break;
                        }
                        case 7 :
                        {
                            $query ="SELECT c_name ,C_PHONE ,c_address  from team1_customer left join team1_my_order on (team1_my_order.c_id = team1_customer.c_id ) group by team1_customer.c_id having count(team1_my_order.c_id) > 1 ;";
                            $result = mysqli_query($connection, $query);
                            if(!$result)
                            {
                                die("reuslt is null");
                                exit();

                            }
                            echo
                            "
                                case7
                                <h1>לקוחות חוזרים</h1>
                                <thead>
                                    <tr>
                                        <th>c_name</th>
                                        <th>C_PHONE</th>
                                        <th scope=>c_address</th>
                                    </tr>
                                </thead>
                            ";
                            while($row=mysqli_fetch_assoc($result))
                            {
                                echo
                                "
                                    <tbody>
                                        <tr>
                                            <td>".$row['c_name']. " </td>
                                            <td>".$row['C_PHONE']."</td>
                                            <td>".$row['c_address']."</td>
                                        </tr>
                                    </tbody>
                                ";
                            }
                            break;
                        }
                        case 8 :
                        {
                            $date = date('Y-m-d');
                            $week_number=0;
                            echo
                            "
                                <section id='change_form'>
                                    <form method='get' action='change.php'>
                                        <span>please enter number of weeks</span>
                                        <input type=number name=week_number>
                                        <input type=submit name=submit value='enter number of weeks'>
                                        <input type=hidden value=8 name=id_query>
                                    </form>
                                </section>
                            ";
                            if($_GET['week_number'] != 0)
                            {
                                $week_number=$_GET['week_number'];
                            }
                            $query = "SELECT sum(o_price) from   team1_my_order  where (TIMESTAMPDIFF(MONTH, o_date, '$date') < $week_number)";
                            $result = mysqli_query($connection, $query);
                            if(!$result)
                            {
                                die("reuslt is null");
                                exit();

                            }
                            echo
                            "
                                <h1>הכנסות באיקס שבועות אחרונים </h1> 
                                <thead>
                                    <tr>
                                        <th>Sum</th>
                                    </tr>
                                </thead>
                            ";
                            while($row=mysqli_fetch_assoc($result))
                            {
                                echo
                                "
                                    <tbody>
                                        <tr>
                                            <td>".$row['sum(o_price)']. " </td>
        
                                        </tr>
                                    </tbody>
                                ";
                            }
                            break;
                        }
                        case 9:
                        {
                            echo
                            "
                                <section id='change_form'>
                                    <form method='get' action='procedure1.php'>
                                        <span>please enter order_number</span>
                                        <input type=number name=order_number>
                                        <span>please enter worker_id</span>
                                        <input type=number name=worker_id>
                                        <input type=hidden value=9 name=id_query>
                                        <input type=submit name=submit>
                                    </form>
                                </section>
                                                            ";
                            break;


                        }
                        case 10:
                        {
                            echo
                            "
                                case 10
                                <section id='change_form'>
                                    <form method='get' action='procedure1.php'>
                                        <span>please enter the quantity of product</span>
                                        <input type=number name=quantity_of_product>
                                        <span>please enter quantity of days</span>
                                        <input type=number name=quantity_of_days>
                                        <input type=hidden value=10 name=id_query>
                                        <input type=submit name=submit>

                                    </form>
                                </section>
                            ";
                            break;


                        }
                        case 11:
                        {
                            echo
                            "
                                case 11
                                <section id='change_form'>
                                    <form method='get' action='procedure1.php'>
                                        <span>please enter order_number</span>
                                        <input type=number name=order_number>
                                        <span>please enter order_discount</span>
                                        <input type=number name=order_discount>
                                        <input type=hidden value=11 name=id_query>
                                        <input type=submit name=submit>

                                    </form>
                                </section>
                            ";
                            break;


                        }
                        case 12:
                        {
                            echo  $action;
                            $query_pr="call update_price_order();";
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

                                    <thead>
                                        <tr>
                                            <th>o_id</th>
                                            <th>c_id</th>
                                            <th>w_id</th>
                                            <th>o_date</th>
                                            <th>send_date</th>
                                            <th>p_id</th>
                                            <th>p_quanity</th>
                                            <th>o_price/th>
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
                                            <td>".$row['c_id']. "</td>
                                            <td>".$row['w_id']. " </td>
                                            <td>".$row['o_date']. " </td>
                                            <td>".$row['send_date']. " </td>
                                            <td>".$row['p_id']. " </td>
                                            <td>".$row['p_quanity']. " </td>
                                            <td>".$row['o_price']. " </td>
                                        </tr>
                                    </tbody>
                                ";
                            }
                            break;
                        }

                        case 13:
                        {
                            echo  $action;
                            $query_pr="call update_product_quantity ();";
                            $handle13=$connection->prepare($query_pr);
                            $handle13->execute();
                            $query_2="select * from product;";
                            $result = mysqli_query($connection,$query_2);
                            if(!$result)
                            {
                                die("reuslt is null");
                                exit();
                            }
                            echo
                                "

                                    case 13<br>
                                    <thead>
                                        <tr>
                                            <th>p_id</th>
                                            <th>p_name</th>
                                            <th>p_price</th>
                                            <th>p_quantity</th>
                                        </tr>
                                    </thead>
                                ";
                            while($row=mysqli_fetch_assoc($result))
                            {
                                echo
                                "
                                    <tbody>
                                        <tr>
                                            <td>".$row['p_id']. " </td>
                                            <td>".$row['p_name']. "</td>
                                            <td>".$row['p_price']. " </td>
                                            <td>".$row['p_quantity']. " </td>
                                        </tr>
                                    </tbody>
                                ";
                            }
                            break;
                        }
                        
                        case 14:
                        {
                            echo
                            "
                                echo  $action;
                                case 14
                                <section id='change_form'>
                                    <form method='get' action='procedure1.php'>
                                        <span>please enter the name of worker</span>
                                        <input type=text name=worker_name>
                                        <span>please enter month </span>
                                        <input type=number name=month>
                                        <span>please enter year </span>
                                        <input type=number name=year>
                                        <input type=hidden value=14 name=id_query>
                                        <input type=submit name=submit>

                                    </form>
                                </section>
                            ";
                            break;


                        }


                    }



                ?>

    </table>

</body>

</html>

<?php
//close DB connection
    mysqli_close($connection);
?>
