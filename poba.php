<?php 
 require_once("includes/connection2.php"); 
?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>sergaegewgrrwgewf</title>
 	<style>
 		input
 		{
            margin: 15px;
            background-color: #ff610c;
            order-color: #00f;
            font-size: 20px;
 		}
 		body
 		{
 			background-color: #000;
            color: #ffa833;
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
 	<form action="add.php" method="POST">
 		назва продукту
 		<input type="text" name="nameprod"/><br/>
 		ціна
 		<input type="number" name="price" min="0" max="1000000000" value="10"/><br/>
 		номер заказу(якщо заказу не було вибрати 0)
 		<select name="order_id">
 			<?php
 				$result=mysqli_query($conn, "SELECT * FROM `order` ORDER BY `id`"); 
                echo"<option >"."0"."</option>";

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
		<input name="add" type="submit" value="додати"/>
 	</form>
    <p><a href="main.php"> назад </a></p>

 </body>
 </html>