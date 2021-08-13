<div style="margin-left: 100px;">
<?php
session_start();
include("dbcontroller.php");
$db_handle = new DBController();
if(!empty($_GET["action"])) {

switch($_GET["action"]) {
	case "add":
		if(!empty($_POST["quantity"])) {
			$productByCode = $db_handle->runQuery("SELECT pid,name,price,image FROM products WHERE pid='" . $_GET["pid"] . "'");
			$itemArray = array($productByCode[0]["pid"]=>array('name'=>$productByCode[0]["name"], 'pid'=>$productByCode[0]["pid"], 'quantity'=>$_POST["quantity"], 'price'=>$productByCode[0]["price"], 'image'=>$productByCode[0]["image"]));
			
			if(!empty($_SESSION["cart_item"])) {
				if(in_array($productByCode[0]["pid"],array_keys($_SESSION["cart_item"]))) {
					foreach($_SESSION["cart_item"] as $k => $v) {
							if($productByCode[0]["pid"] == $k) {
								if(empty($_SESSION["cart_item"][$k]["quantity"])) {
									$_SESSION["cart_item"][$k]["quantity"] = 0;
								}
								$_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
							}
					}
				} else {
					$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
				}
			} else {
				$_SESSION["cart_item"] = $itemArray;
			}
		}
	break;

case "remove":
		if(!empty($_SESSION["cart_item"])) {
			foreach($_SESSION["cart_item"] as $k => $v) {
					if($_GET["pid"] == $k)
						unset($_SESSION["cart_item"][$k]);				
					if(empty($_SESSION["cart_item"]))
						unset($_SESSION["cart_item"]);
			}
		}
	break;
	case "empty":
		unset($_SESSION["cart_item"]);
	break;	
}
}
?>

<html>
<head>
<title></TITLE>
<link href="style.css" type="text/css" rel="stylesheet" />
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
      <a href="menu2.php">Home</a>
    <h2 class="logo">Online Grocery Store</h2>
    <button class="menu-open" aria-label="open menu">☰</button>
    <ul class="socials">
       
    </ul>
  </div>
</nav>


<div id="shopping-cart">
<div class="txt-heading">Shopping Cart</div>

<a id="btnEmpty" href="menu2.php?action=empty">Empty my Cart</a>
<?php
if(isset($_SESSION["cart_item"])){
    $total_quantity = 0;
    $total_price = 0;
?>	
<table class="tbl-cart" cellpadding="10" cellspacing="1">
<tbody>
<tr>
<th style="text-align:left;">Name</th>
<th style="text-align:left;">id</th>
<th style="text-align:right;" width="5%">Stock</th>
<th style="text-align:right;" width="10%">Unit Price</th>
<th style="text-align:right;" width="10%">Price</th>
<th style="text-align:center;" width="5%">Remove</th>
</tr>
<?php		
    foreach ($_SESSION["cart_item"] as $item){
        $item_price = $item["quantity"]*$item["price"];
		?>
				<tr>
                                    <td><img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($item['image']); ?>" class="cart-item-image"/><?php echo $item["name"]; ?></td>
				<td><?php echo $item["pid"]; ?></td>
				<td style="text-align:center;"><?php echo $item["quantity"]; ?></td>
				<td  style="text-align:center;"><?php echo "Rs ".$item["price"]; ?></td>
				<td  style="text-align:center;"><?php echo "Rs ". number_format($item_price,2); ?></td>
				<td style="text-align:center;"><a href="menu2.php?action=remove&pid=<?php echo $item["pid"]; ?>" class="btnRemoveAction"><img src="icon-delete.png" alt="Remove Item" /></a></td>
				</tr>
				<?php
				$total_quantity += $item["quantity"];
				$total_price += ($item["price"]*$item["quantity"]);
		}
		?>

<tr>
<td colspan="2" align="right">Total:</td>
<td align="right"><?php echo $total_quantity; ?></td>
<td align="right" colspan="2"><strong><?php echo "Rs. ".number_format($total_price, 2); ?></strong></td>
<td></td>
</tr>
</tbody>
</table>
<div id="shopping-cart">
<a id="btnEmpty" href="checkout.php?bill=<?php echo $total_price; ?>&items=<?php echo $total_quantity; ?>" style="color:green;">CHECK OUT</a>
</div>
  <?php
} else {
?>
<div class="no-records">Your Cart is Empty</div>
<?php 
}
?>
</div>


<div id="product-grid" style="margin-left:100px;">
	<div class="txt-heading">Products</div>
	<?php
        $cat=$_GET['cad'];
	$product_array = $db_handle->runQuery("SELECT `pid`,`name`,`price`,`image` FROM `products` where`categoryid`=$cat");
	if (!empty($product_array)) { 
		foreach($product_array as $key=>$value){
                    
                  ?>
		<div class="product-item">
			<form method="post" action="menu2.php?action=add&pid=<?php echo $product_array[$key]["pid"]; ?>">
                            <div class="product-image"><img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($product_array[$key]['image']); ?>"style="width:70; height:70;" ></div>
			<div class="product-tile-footer">
                            <div class="product-title"><?php echo $product_array[$key]["name"]; ?>&times;<?php echo "Rs".$product_array[$key]["price"]; ?></div>
                        <div class="cart-action"><input type="number" class="product-quantity" name="quantity" min="1" value="1" size="2" height="10" width="20" /><input type="image" src="addbtn.jpg" class="cart-item-image"style="width:50; height:50;" /></div>
			</div>
			</form>
		</div>
	<?php
		}
	}
	?>
</div></div>
</BODY>
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
