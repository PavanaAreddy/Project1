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

  <div class="w3-row-padding w3-margin-bottom">
    <div class="w3-quarter">
      <div class="w3-container w3-red w3-padding-16">
        <div class="w3-left"><i class="fa fa-comment w3-xxxlarge"></i></div>
        <div class="w3-right">
          <?php 
          $date=  date("y/m/d");
          $sql="select count(*) as ord from orders where date='$date'";
          $r=  mysqli_query($con, $sql);
          while($row=  mysqli_fetch_array($r)){
          echo "<h3>".$row['ord']."</h3>";
          }
          ?>        
        </div>
        <div class="w3-clear"></div>
        <h4>Today</h4>
      </div>
    </div>
    <div class="w3-quarter">
      <div class="w3-container w3-blue w3-padding-16">
        <div class="w3-left"><i class="fa fa-comment w3-xxxlarge"></i></div>
        <div class="w3-right">
          <?php 
            function x_week_range($date) {
                $ts = strtotime($date);
                $start = (date('w', $ts) == 0) ? $ts : strtotime('last sunday', $ts);
                return array(date('Y-m-d', $start),date('Y-m-d', strtotime('next saturday', $start)));
            }
            list($start_date, $end_date) = x_week_range('2021-01-02');
            $sql="select count(*) as ord from orders  where date between'".$start_date."' and'".$end_date."'";
            $r=  mysqli_query($con, $sql);
          while($row=  mysqli_fetch_array($r)){
          echo "<h3>".$row['ord']."</h3>";
          }
          ?>
        </div>
        <div class="w3-clear"></div>
        <h4>This week</h4>
      </div>
    </div>
    <div class="w3-quarter">
      <div class="w3-container w3-teal w3-padding-16">
        <div class="w3-left"><i class="fa fa-comment w3-xxxlarge"></i></div>
        <div class="w3-right">
            <?php 
          $year=  date("y");
          $today=date("y/m/d");
          $date="$year/01/01";
          $sql="select count(*) as ord from orders  where date between'".$date."' and'".$today."'";
          $r=  mysqli_query($con, $sql);
          while($row=  mysqli_fetch_array($r)){
          echo "<h3>".$row['ord']."</h3>";
          }
          ?>  
        </div>
        <div class="w3-clear"></div>
        <h4>Year</h4>
      </div>
    </div>
   
  </div>

  <div class="w3-panel">
    <div class="w3-row-padding" style="margin:0 -16px">
      <div class="w3-twothird">
        <h5>Feeds</h5>
        <table class="w3-table w3-striped w3-white">
          <tr>
            <td><i class="fa fa-user w3-text-blue w3-large"></i></td>
            <td>Customers</td>
            <?php 
          $sql="select count(*) as cust from customer";
          $r=mysqli_query($con, $sql);
          while($row=mysqli_fetch_array($r)){
          echo "<td><i>".$row['cust']."</i></td>";
          }
          ?>  
          </tr>
          <tr>
            <td><i class="fa fa-bell w3-text-red w3-large"></i></td>
            <td>Orders till now</td>
            <?php
            $sql="select count(*) as ord from orders";
          $r=  mysqli_query($con, $sql);
          while($row=  mysqli_fetch_assoc($r)){
            echo "<td><i>".$row['ord']."</i></td>";
          }
          ?>
          </tr>
          <tr>
            <td><i class="fa fa-bookmark w3-text-blue w3-large"></i></td>
            <td>Transactions till now.</td>
           <?php
            $sql="select sum(total) as tot from orders";
            $r=  mysqli_query($con, $sql);
            while($row=  mysqli_fetch_array($r)){
                echo "<td><i>".$row['tot']."</i></td>";
            }
            ?>
          </tr>
        </table>
      </div>
    </div>
  </div>
  <hr>
 >

  
  <!-- End page content -->
</div>

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

</body>
</html>
