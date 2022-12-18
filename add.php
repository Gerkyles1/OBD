<?php 
 require_once("includes/connection2.php");
 if(empty( $_POST['nameprod'])||empty($_POST['price']))
{
            header("Location: poba.php");
            die();
}
 if ($_POST['order_id']==0)
 {
     mysqli_query($conn, "INSERT INTO `product` (`id`, `name`, `price`, `order_id`, `stock_id`) VALUES (NULL, '$_POST[nameprod]', $_POST[price], NULL, $_POST[stock_id])");
 }
 else
 {
     mysqli_query($conn, "INSERT INTO `product` (`id`, `name`, `price`, `order_id`, `stock_id`) VALUES (NULL, '$_POST[nameprod]', $_POST[price], $_POST[order_id], $_POST[stock_id])");
 }

?>
<style>
    body
    {
        background-color: #000;
    }
    a
    {
        color: #ffa833;
        font-size: 40px;
    }
    a:hover
    {
        color: #45aaff;
    }
</style>
<p><a href="main.php"> ЕЛЕМЕНТ ДОДАНО УСПІШНО </a></p>
