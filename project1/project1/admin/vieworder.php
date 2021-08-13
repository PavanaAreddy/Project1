<html>
<title>vieworders</title>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
html,body,h1,h2,h3,h4,h5 {font-family: "Raleway", sans-serif}
</style>
<body class="w3-light-grey">
    <div class="w3-main" style="margin-left:200px;margin-top:43px;margin-right:200px;">

<?php

include 'config.php';
echo"<table class='w3-table w3-striped w3-white'>

<caption><h3><b>orders</b></h3></caption>
<tr>
<th width='3%'>Id</th>
<th width='10%'>customer Id</th>
<th width='10%'>total Bill</th>
<th width='10%'>date</th>
<th width='10%'>time</th>
</tr>";
$sql="select * from orders";
$result=  mysqli_query($con, $sql);
while($row=mysqli_fetch_array ($result))
{
echo "<tr>";
          
echo  "<td width='3%'>".$row ['oid']."</td>";
echo  "<td width='10%'>".$row ['cid']."</td>";
echo  "<td width='10%'>".$row ['total']. "</td>";
echo  "<td width='10%'>".$row ['date']."</td>";
echo  "<td width='10%'>".$row ['time']."</td>";
echo "</tr>";
}
echo"</table>";
?>
</div>
    </div>
    </div>
    </div>
</body>
</html>
