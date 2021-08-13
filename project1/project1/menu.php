<div style="width: 960px; margin:auto;">
    <a href="menu.php">Back</a>
</div>
<div style="width:700px; margin:50 auto;">

<?php

session_start();
echo session_id();
include('config.php');
$status="";
if (isset($_POST['pid']) && $_POST['pid']!=""){
$pid = $_POST['pid'];
$result = mysqli_query($con,"SELECT * FROM `products` WHERE `pid`='$pid'");
$row = mysqli_fetch_assoc($result);
$name = $row['name'];
$price = $row['price'];
$image = $row['image'];

$cartArray = array(
	$pid=>array(
        'pid'=>$pid,
	'name'=>$name,
	'price'=>$price,
	'quantity'=>1,
	'image'=>$image)
);

if(empty($_SESSION["shopping_cart"])) {
	$_SESSION["shopping_cart"] = $cartArray;
	$status = "<div class='box'>Product is added to your cart!</div>";
}else{
	$array_keys = array_keys($_SESSION["shopping_cart"]);
	if(in_array($pid,$array_keys)) {
		$status = "<div class='box' style='color:red;'>
		Product is already added to your cart!</div>";	
	} else {
	$_SESSION["shopping_cart"] = array_merge($_SESSION["shopping_cart"],$cartArray);
	$status = "<div class='box'>Product is added to your cart!</div>";
	}

	}
}
?>



<html>
<head>
<link rel='stylesheet' href='css/style.css' type='text/css' media='all' />
<style>
* {
  padding: 0;
  margin: 0;
  box-sizing: border-box;
}

ul {
  list-style: none;
}

button {
  border: none;
  background: transparent;
  outline: none;
  cursor: pointer;
}

button:active {
  color: black;
}

a {
  text-decoration: none;
  color: black;
}

body {
  font: normal 16px/1.5 Helvetica, sans-serif;
}


/* .top-banner
–––––––––––––––––––––––––––––––––––––––––––––––––– */

.top-banner {
  display: flex;
  width: calc(100% - 150px);
  height: 100vh;
  transform: translateX(150px);
  background: url(https://s3-us-west-2.amazonaws.com/s.cdpn.io/162656/unsplash.jpg) no-repeat center / cover;
}

.top-banner-overlay {
  display: flex;
  flex-direction: column;
  justify-content: center;
  width: 350px;
  padding: 20px;
  transition: transform .7s;
  color: white;
  background: rgba(0, 0, 0, .7);
}

.top-banner-overlay.is-moved {
  transform: translateX(350px);
}

.top-banner-overlay.is-moved::before {
  content: '';
  position: absolute;
  top: 0;
  bottom: 0;
  right: 100%;
  width: 20px;
  box-shadow: 0 0 10px black;
}

.top-banner-overlay p {
  font-size: 1rem;
  margin-top: 10px;
}

.top-nav li + li {
  margin-top: 7px;
}


/* .menu-wrapper
–––––––––––––––––––––––––––––––––––––––––––––––––– */
.top-nav .menu-wrapper {
  position: fixed;
  top: 0;
  left: 0;
  bottom: 0;
  width: 350px;
  padding: 20px;
  transform: translateX(-200px);
  transition: transform .7s;
  background: #B1FFE5;
}

.top-nav .menu-wrapper.is-opened {
  transform: translateX(150px);
}

.top-nav .menu-wrapper .menu {
  opacity: 0;
  transition: opacity .4s;
}

.top-nav .menu-wrapper.is-opened .menu {
  opacity: 1;
  transition-delay: .6s;
}

.top-nav .menu-wrapper .menu a {
  font-size: 1.2rem;
}

.top-nav .menu-wrapper .sub-menu {
  padding: 10px 0 0 7px;
}

.top-nav .menu-wrapper .menu-close {
  position: absolute;
  top: 20px;
  right: 20px;
  font-size: 1.6rem;
}


/* .fixed menu
–––––––––––––––––––––––––––––––––––––––––––––––––– */

.top-nav .fixed-menu {
  position: fixed;
  top: 0;
  left: 0;
  bottom: 0;
  display: flex;
  flex-direction: column;
  width: 150px;
  padding: 20px;
  background: aquamarine;
}

.top-nav .fixed-menu .menu-open {
  font-size: 1.8rem;
  text-align: left;
  margin: 30px 0 auto;
  width: 28px;
}

</style>
</head>
<body>
<!--html-->

<nav class="top-nav">
  <div class="menu-wrapper">
    <ul class="menu">
        <li><a href="products.php?cad=1">Vegetables</a></li>
        <li><a href="products.php?cad=2">Fruits</a></li>
        <li><a href="products.php?cad=3">Diary Products</a></li>
        <li><a href="products.php?cad=9">Foodgrains, Oil, Masala</a></li>
      <li><a href="products.php?cad=4">Beverages</a></li>
      <li><a href="products.php?cad=10">Snacks, Packed Food</a></li>
      <li><a href="products.php?cad=5">Bread & Bakery Products</a></li>
      <li><a href="products.php?cad=6">Canned foods/Ketchup</a></li>
      <li><a href="products.php?cad=7">Cleaning and Household</a></li>
      <li><a href="products.php?cad=8">Personal Care</a></li>
           
    </ul>
    <button class="menu-close" aria-label="close menu">✕</button>
  </div>
  <div class="fixed-menu">
      <a href="menu.php">Home</a>
    <h2 class="logo">Online Grocery Store</h2>
    <button class="menu-open" aria-label="open menu">☰</button>
    <ul class="socials">
       
    </ul>
  </div>
</nav>


<?php
include 'config.php';
if(!empty($_SESSION["shopping_cart"])) {
$cart_count = count(array_keys($_SESSION["shopping_cart"]));
?>


<div class="cart_div">
    <a href="cart1.php"><img src="cart-icon.png"/> Cart<span><?php echo $cart_count; ?></span></a>
</div>
<?php
}

$result = mysqli_query($con,"SELECT `pid`,`name`,`price`,`image` FROM `products`");
while($row = mysqli_fetch_assoc($result)){
		echo "<div class='product_wrapper'>
			  <form method='post' action=''>
			  <input type='hidden' name='pid' value=".$row['pid']." />";
			echo"  <div class='image'>";?>
            <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['image']); ?>" width="100" height="80"/> 

<?php echo"</div>";
			 echo" <div class='name'>".$row['name']."</div>
		   	  <div class='price'>Rs.".$row['price']."</div>
			  <button type='submit' class='buy'>Buy Now</button>
			  </form>
		   	  </div>";

}
mysqli_close($con);
?>

<div style="clear:both;"></div>

<div class="message_box" style="margin:10px 0px;">
<?php echo $status; ?>
</div>
    </body>
    <script type="text/javascript">
    const menuOpen = document.querySelector(".top-nav .menu-open");
const menuClose = document.querySelector(".top-nav .menu-close");
const menuWrapper = document.querySelector(".top-nav .menu-wrapper");
const topBannerOverlay = document.querySelector(".top-banner-overlay");

function toggleMenu() {
  menuOpen.addEventListener("click", () => {
    menuWrapper.classList.add("is-opened");
    topBannerOverlay.classList.add("is-moved");
  });
  
  menuClose.addEventListener("click", () => {
    menuWrapper.classList.remove("is-opened");
    topBannerOverlay.classList.remove("is-moved");
  });
}

toggleMenu();
</script>
</html>