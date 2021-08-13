<!DOCTYPE html>
<?php
session_start()
?>
<html>
<title>administrator</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
html,body,h1,h2,h3,h4,h5 {font-family: "Raleway", sans-serif}
input[type=text], input[type=number], input[type=submit] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}
</style>
<script>
// Get the Sidebar
var mySidebar = document.getElementById("mySidebar");

// Get the DIV with overlay effect
var overlayBg = document.getElementById("myOverlay");

// Toggle between showing and hiding the sidebar, and add overlay effect
function w3_open() {
  if (mySidebar.style.display === 'block') {
    mySidebar.style.display = 'none';
    overlayBg.style.display = "none";
  } else {
    mySidebar.style.display = 'block';
    overlayBg.style.display = "block";
  }
}

// Close the sidebar with the close button
function w3_close() {
  mySidebar.style.display = "none";
  overlayBg.style.display = "none";
}
</script>
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
      <!--<a href="#" class="w3-bar-item w3-button"><i class="fa fa-envelope"></i></a>
      <a href="#" class="w3-bar-item w3-button"><i class="fa fa-user"></i></a>
      <a href="#" class="w3-bar-item w3-button"><i class="fa fa-cog"></i></a>-->
    </div>
  </div>
  <hr>
  <div class="w3-container">
    <h5>Dashboard</h5>
  </div>
  <div class="w3-bar-block">
    <a href="#" class="w3-bar-item w3-button w3-padding-16 w3-hide-large w3-dark-grey w3-hover-black" onclick="w3_close()" title="close menu"><i class="fa fa-remove fa-fw"></i>  Close Menu</a>
    <a href="administrator.php" class="w3-bar-item w3-button w3-padding w3-blue"><i class="fa fa-users fa-fw"></i>  Overview</a>
    <a href="addproducts.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-eye fa-fw"></i> Add products</a>
    <a href="view.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-users fa-fw"></i> View/update/delete products</a>
    <a href="vieworder.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-bullseye fa-fw"></i>View orders</a>
  </div>
</nav>


<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">

  <!-- Header -->
  <header class="w3-container" style="padding-top:22px">
    <h5><b><i class="fa fa-dashboard"></i> Add products</b></h5>
  </header>
  
  
  <form action="add.php" method="POST" enctype="multipart/form-data">
    <div class="container">
   
    <hr>

    <label for="name"><b>Product name</b></label>
    <input type="text" placeholder="product name" name="name" id="name" required>
    
    <label for="categories"><b>Category</b></label>
    <select name="category">
        <option value="" disabled selected>Select...</option>
    <option value="1">Vegetables</option>
    <option value="2">Fruits</option>
    <option value="3">Diary</option>
    <option value="4">Beverages</option>
    <option value="5">Bread/Bakery</option>
    <option value="6">Canned/bottle foods</option>
    <option value="7">Cleaning & Household</option>
    <option value="8">personal care</option>
    <option value="9">Food grains,oil,masala</option>
    </select>

    <label for="price"><b>Price Rs.</b></label>
    <input type="number" placeholder="Price" name="price" id="price" required>
    <label for="stock"><b>Stock</b></label>
    <input type="number" placeholder="stock" name="stock" id="stock" required>
    <label for="image"><b>Product image</b></label>
    <input type="file" name="_image" id="image" required>
    <input type="submit" name="submit_image" value="Upload"style="background-color:red;color: white;">
  
  
  <!-- End page content -->
</div>
</form>
</body>
</html>


