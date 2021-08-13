<?php
include 'config.php';
?>
<!DOCTYPE html>
<html>
<title>administartor</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
html,body,h1,h2,h3,h4,h5 {font-family: "Raleway", sans-serif}
</style>
<body class="w3-light-grey">

<!-- Top container -->
<div class="w3-bar w3-top w3-black w3-large" style="z-index:4">
  <button class="w3-bar-item w3-button w3-hide-large w3-hover-none w3-hover-text-light-grey" onclick="w3_open();"><i class="fa fa-bars"></i>  Menu</button>
  <span class="w3-bar-item w3-right">Online Grocery Store</span>
</div>

<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-collapse w3-white w3-animate-left" style="z-index:3;width:300px;" id="mySidebar"><br>
  <div class="w3-container w3-row">
    <div class="w3-col s4">
        <img src="ad.jpg" class="w3-circle w3-margin-right" style="width:46px">
    </div>
    <div class="w3-col s8 w3-bar">
      <span>Welcome, <strong>Admin</strong></span><br>
          </div>
  </div>
  <hr>
  <div class="w3-container">
    <h5>Menu</h5>
  </div>
  <div class="w3-bar-block">
    <a href="#" class="w3-bar-item w3-button w3-padding-16 w3-hide-large w3-dark-grey w3-hover-black" onclick="w3_close()" title="close menu"><i class="fa fa-remove fa-fw"></i>  Close Menu</a>
    <a href="administrator.php" class="w3-bar-item w3-button w3-padding w3-blue"><i class="fa fa-users fa-fw"></i>  Overview</a>
    <a href="addproducts.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-eye fa-fw"></i> Add products</a>
    <a href="view.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-users fa-fw"></i> View/update products</a>
    <a href="vieworder.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-bullseye fa-fw"></i>View orders</a>
  </div>
</nav>


<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

  <!-- Header -->
  <header class="w3-container" style="padding-top:22px">
    <h5><b><i class="fa fa-dashboard"></i> My Dashboard</b></h5>
  </header>
<?php

include 'config.php';
echo"<table class='w3-table w3-striped w3-white'>

<caption><h3>Products</h3></caption>
<tr>
<th width='3%'>Id</th>
<th width='10%'>Image</th>
<th width='10%'>Product name</th>
<th width='10%'>Price</th>
<th width='15%'>Stock</th>
<th width='10%'>category id</th>
</tr>";
$sql="select * from products";
$result=  mysqli_query($con, $sql);
while($row=mysqli_fetch_array ($result))
{
echo "<tr>";
          
echo  "<td width='3%'>".$row ['pid']."</td>";
echo  "<td width='7%'>";?>
<img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['image']); ?>" width="60" height="50"/> 
<?php
echo  "<td width='10%'>".$row ['name']."</td>";
echo  "<td width='10%'>".$row ['price']. "</td>";
//echo  "<td width='10%'>".$row ['stock']."</td>";
echo  "<td width='10%'>".$row ['categoryid']."</td>";

echo '<td width="3%"><b><a href="deletecase.php?id=' . $row['pid'] . '">Delete</a></font></b></td>';


echo "</tr>";
}
echo"</table>";
?>
</div>
    </div>
    </div>
</body>
</html>

  