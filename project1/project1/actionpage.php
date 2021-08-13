<?php
session_start();
$UserName=$_POST['uname'];
$Password=$_POST['psw'];

include("config.php");

$sql = "select * from login where username='".$UserName."' and password='".$Password."'";
$result = mysqli_query($con,$sql);
$records = mysqli_num_rows($result);
while($row=  mysqli_fetch_array($result)){
$customer_id=$row['cid'];
}
if ($records==0)
{
echo $records;
echo '<script type="text/javascript">alert("Wrong UserName or Password");window.location=\'index.php\';</script>';
} 
else 
{
header("location:menu2.php");
}
mysqli_close($con);
?>