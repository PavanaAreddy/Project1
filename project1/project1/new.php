<?php
session_start();

include('config.php');
$name=$_POST["name"];
$email=$_POST["email"];
$new_password=$_POST["new-psw"];
$address=$_POST["address"];

if(isset($_POST["signup"]))
{
    
$sql="insert into `customer`(`cid`,`name`,`email`,`password`,`address`) values('?',$name','$email','$new_password',$address)";
$res=mysqli_query($con,$sql);
echo'<script type="text/javascript">alert("regs")</script>';
//sleep(5);
$row=mysqli_query($con,"select * from `customer` where `username`='$name' and password='$new_password'");
$rec= mysqli_fetch_assoc($row);
if($rec){
    $customer_id=$rec['cid'];
}
echo'<script type="text/javascript">alert("log")</script>';

$query="insert into `grocery`.`login`(`cid,`username`,`password`,) values('$customer_id','$name','$email','$new_password')";
$myquery=  mysqli_query($con, $query);
//$loginsql="insert into `grocery`.`login`(`cid`,`username`,`password`) values(
echo'<script type="text/javascript">alert("Successfully registered.Please login to continue...happy shopping")</script>';
header("location:index.php");
}
else
{
echo 'error';
}
?>
