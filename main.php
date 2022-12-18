<!DOCTYPE html>
<html>
<head>
    <?php 
        $servername = "localhost";
        $database = "baza2";
        $username = "root";
        $password = "";


        $conn = mysqli_connect("$servername", $username, $password, $database);

        if (!$conn) 
        {
            die("Connection failed: " . mysqli_connect_error());
        } 

    ?>

	<title>aslkgowihf</title>

    <style>
        body
        {
            background-color:#000;
        }

        .container
        {

            display: flex;
            flex-direction: row;
            justify-content: flex-start;

            margin-left: 10%;
            margin-top: 10px;
            padding-top: 10px;

        }

        #con1
        {
            width: auto;
            height: auto;
            font-style: italic;
            align-self: center;
            margin-right: 10%;

        }
        #con2
        {
            width: auto;
            height: auto;
            font-style: italic;


        }
        table
        {
            border-color: #00f;
            color: #ffa833;
            font-size: 20px;
        }

        input
        {
            background-color: #ff610c;
            width: 100%;
            font-size: 20px;
        }
    </style>
</head>
    <body>
        <div class="container">
            <div id="con1">
                <table border="1">
                    <?php
                        echo "<tr><td>"."ім'я"."</td><td>"."e-mail"."</td><td>"."до оплати"."</td></tr>";

                        $result = mysqli_query($conn, "SELECT * FROM `client` WHERE `blackList`<>1; ");

                        while ($r1=mysqli_fetch_assoc($result)) 
                        {
                            $suma=mysqli_query($conn,"SELECT SUM(`product`.`price`) FROM `product` WHERE `product`.`order_id` IN (SELECT `order`.`id`FROM `order` WHERE `order`.`client_id`=$r1[id]);");
                            $sum=mysqli_fetch_array($suma)[0];
                            if($sum==NULL)
                            {
                                $sum=0;
                            }
                            echo "<tr><td>"."$r1[name]"."</td><td>"."$r1[email]"."</td><td>".$sum."</td></tr>"; 
                        }

                    ?>
                </table>
            </div>

            <div id="con2">
                <table border="1">
                <?php
                    echo "<tr><td>"."продукт"."</td><td>"."ціна"."</td><td>"."склад"."</td><td>"."фірма"."</td></tr>";

                    $result = mysqli_query($conn, "SELECT * FROM `product` ");
                    $firms = mysqli_query($conn, "SELECT * FROM `factory` WHERE `factory`.`id` IN (SELECT `factory_id` FROM `stock` WHERE `stock`.`id`IN(SELECT`product`.`stock_id`FROM `product`WHERE `product`.`id`=1))");

                    while ($r1=mysqli_fetch_assoc($result)) 
                    {
                        echo "<tr><td>"."$r1[name]"."</td><td>"."$r1[price]₴"."</td><td>"."$r1[stock_id]"."</td>";

                        $firms = mysqli_query($conn, "SELECT * FROM `factory` WHERE `factory`.`id` IN (SELECT `factory_id` FROM `stock` WHERE `stock`.`id`IN(SELECT`product`.`stock_id`FROM `product`WHERE `product`.`id`=$r1[id]))");

                        $firm = mysqli_fetch_assoc($firms);
                        echo "<td>". "$firm[FirmName]"." </td><tr></tr>";
                    }
                ?>
                    <tr>
                        <td>
                            <form action="poba.php">
                                <input name="baton" type="submit" value="+"/>
                            </form>
                        </td>
                        <td>
                            <form action="poba2.php">
                                <input type="submit" name="baton2"value="-"/>
                            </form>
                        </td>
                        <td colspan="2">
                            <form action="poba3.php">
                                <input name="baton" type="submit" value="редагувати"/>
                            </form>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <p><a href="logout.php">Выйти</a> из системы</p>
    </body>
</html>

