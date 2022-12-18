<?php 
 require_once("includes/connection2.php"); 
?>
<!DOCTYPE html>
 <html>
 <head>
    <title>sergaegewgrrwgewf</title>
    <style>
        body
    {
        background-color: #000;
        color: #ffa833;
        font-size: 22px;

    }

    table
    {
        border-color: #00f;
        color: #ffa833;
        font-size: 20px;
        font-style: italic;

    }

    input
    {
        margin: 15px;
        background-color: #ff610c;
        order-color: #00f;
        font-size: 20px;
    }

    select
    {
        margin: 15px;
        background-color: #ff610c;
        order-color: #00f;
        font-size: 20px;
    }

    </style>

 </head>
 <body>
     <table border="1" >
    <?php
        echo "<tr><td>"."id"."</td><td>"."продукт"."</td><td>"."ціна"."</td><td>"."склад"."</td><td>"."фірма"."</td></tr>";

        $result = mysqli_query($conn, "SELECT * FROM `product` ");
        $firms = mysqli_query($conn, "SELECT * FROM `factory` WHERE `factory`.`id` IN (SELECT `factory_id` FROM `stock` WHERE `stock`.`id`IN(SELECT`product`.`stock_id`FROM `product`WHERE `product`.`id`=1))");

        while ($r1=mysqli_fetch_assoc($result)) 
        {
            echo "<tr><td>"."$r1[id]"."</td><td>"."$r1[name]"."</td><td>"."$r1[price]₴"."</td><td>"."$r1[stock_id]"."</td>";

            $firms = mysqli_query($conn, "SELECT * FROM `factory` WHERE `factory`.`id` IN (SELECT `factory_id` FROM `stock` WHERE `stock`.`id`IN(SELECT `product`.`stock_id`FROM `product`WHERE `product`.`id`=$r1[id]))");

            $firm = mysqli_fetch_assoc($firms);
            echo "<td>". "$firm[FirmName]"." </td><tr></tr>";
        }
    ?>
</table>





<form action="edit.php" method="POST">номер продукту
    <select name="delId">
        <?php
            $result=mysqli_query($conn, "SELECT * FROM `product` ORDER BY `id`"); 

            while ($r1=mysqli_fetch_assoc($result))
            {
                echo"<option >"."$r1[id]"."</option>";
            }
         ?>
    </select>
    <br>
    назва продукту
        <input type="text" name="nameprod"/><br/>
        ціна
        <input type="number" name="price" min="0" max="1000000000" value="10"/><br/>
        номер заказу
        <select name="order_id">
            <?php
                $result=mysqli_query($conn, "SELECT * FROM `order` ORDER BY `id`"); 

                while ($r1=mysqli_fetch_assoc($result))
                {
                    echo"<option >"."$r1[id]"."</option>";
                }
             ?>
        </select><br/>
        номер складу де він зберігається
        <select name="stock_id">
            <?php
                $result=mysqli_query($conn, "SELECT * FROM `stock` ORDER BY `id`"); 

                while ($r1=mysqli_fetch_assoc($result))
                {
                    echo"<option >"."$r1[id]"."</option>";
                }
             ?>
        </select><br/>
        <input name="edit" type="submit" value="редагувати"/>

</form>
    <p><a href="main.php"> назад </a></p>

 </body>