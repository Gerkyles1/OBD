<?php 
 require_once("includes/connection2.php"); 
 session_start();
?>
<!DOCTYPE html>
<html>
<head>
        <link href="css/style2.css" media="screen" rel="stylesheet">
        <style >
            body
            {
                background-color:#000;
            }
            .center 
            {
              margin-left: auto;
              margin-right: auto;
            }
        </style>
</head>
<body>

    <div id="con2">
        <p><h1 align="center"><font color="#ffa833">Ваші закази</font></h1></p>
                <table border="1" class="center">
                <?php
                    $num=mysqli_query($conn, "SELECT COUNT(`product`.`id`) AS num FROM `product` WHERE `product`.`order_id`IN(SELECT `order`.`id`FROM `order` WHERE `order`.`client_id`= $_SESSION[cl_id])");
                    $num=mysqli_fetch_array($num)[0];
                    if ($num!=0)
                    {
                        echo "<tr><td>"."продукт"."</td><td>"."ціна"."</td><td>"."фірма"."</td></tr>";

                    }
                    else
                    {
                        echo "<tr><td colspan="."2".">ви ще не зробили замовлення</td></tr>";
                    }
                    $result = mysqli_query($conn, "SELECT * FROM `product` WHERE `product`.`order_id`IN(SELECT `order`.`id`FROM `order` WHERE `order`.`client_id`= $_SESSION[cl_id])");
                    $firms = mysqli_query($conn, "SELECT * FROM `factory` WHERE `factory`.`id` IN (SELECT `factory_id` FROM `stock` WHERE `stock`.`id`IN(SELECT`product`.`stock_id`FROM `product`WHERE `product`.`id`=1))");

                    while ($r1=mysqli_fetch_assoc($result)) 
                    {
                        echo "<tr><td>"."$r1[name]"."</td><td>"."$r1[price]₴"."</td>";

                        $firms = mysqli_query($conn, "SELECT * FROM `factory` WHERE `factory`.`id` IN (SELECT `factory_id` FROM `stock` WHERE `stock`.`id`IN(SELECT`product`.`stock_id`FROM `product`WHERE `product`.`id`=$r1[id]))");

                        $firm = mysqli_fetch_assoc($firms);
                        echo "<td>". "$firm[FirmName]"." </td><tr></tr>";
                    }
                ?>
                    <tr>
                        <td>
                            <form action="addOrderCl.php">
                                <input name="baton" type="submit" value="+"/>
                            </form>
                        </td>
                        <?php 
                        if ($num!=0)
                        {
                        ?>
                        <td colspan="3">
                            <form action="delOrderCl.php">
                                <input type="submit" name="baton2"value="-"/>
                            </form>
                        </td>
                        <?php 
                        } 
                        ?>
                    </tr>
                </table>
                <p><h1 align="center"><font color="#ffa833"><a href="logout.php">Выйти</a> из системы</font></h1></p>
            </div>
</body>
</html>