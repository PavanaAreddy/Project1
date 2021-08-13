<?php
session_start();
include("config.php");
$name=$_POST["name"];
$category=$_POST["category"];
$stock=$_POST["stock"];
$price=$_POST["price"];

//$loginsql="insert into `grocery`.`login`(`cid`,`username`,`password`) values(
if (isset($_POST['submit_image'])) {
    include "config.php";
        $image1 = $_FILES["_image"]["tmp_name"];
        $image2 =addslashes (file_get_contents($image1));
        $sql = "INSERT INTO products(pid,categoryid,name,price,stock,image)
        VALUES('?','{$category}','$name','{$price}','{$stock}','{$image2}')";
        $current_id = mysqli_query($con, $sql) or die("<b>Error:</b> Problem on Image Insert<br/>" . mysqli_error($con));
       
    
}
?>

