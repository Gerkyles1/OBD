<?php 
     require_once("includes/connection2.php");
     
     mysqli_query($conn, "DELETE FROM `product` WHERE `product`.`id` = $_POST[delId]");
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
<p><a href="main.php"> ЕЛЕМЕНТ ВИДАЛЕНО УСПІШНО </a></p>