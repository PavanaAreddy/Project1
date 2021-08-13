<?php
session_start();
$Admin=$_POST['name'];
$Password=$_POST['psw'];

include("config.php");

$sql = "select * from admin where ad_name='".$Admin."' and password='".$Password."'";
$result = mysqli_query($con,$sql);
$records = mysqli_num_rows($result);
$row = mysqli_fetch_array($result);
if ($records==0)
{
echo $records;
echo '<script type="text/javascript">alert("Retype");window.location=\'index.php\';</script>';
} 
else 
{
header("location:administrator.php");
}
mysqli_close($con);
?>