


<?php

session_start();
include('config.php');
$status="";
if (isset($_POST['code']) && $_POST['code']!=""){
$code = $_POST['code'];
$result = mysqli_query($con,"SELECT * FROM `products` WHERE `code`='$code'");
$row = mysqli_fetch_assoc($result);
$name = $row['name'];
$code = $row['code'];
$price = $row['price'];
$image = $row['image'];

$cartArray = array(
	$code=>array(
	'name'=>$name,
	'code'=>$code,
	'price'=>$price,
	'quantity'=>1,
	'image'=>$image)
);

if(empty($_SESSION["shopping_cart"])) {
	$_SESSION["shopping_cart"] = $cartArray;
	$status = "<div class='box'style='width=960px;margin-left:auto;margin-right:auto;'>Product is added to your cart!</div>";
}else{
	$array_keys = array_keys($_SESSION["shopping_cart"]);
	if(in_array($code,$array_keys)) {
		$status = "<div class='box' style='color:red;width:960px;'>
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
    </head>
    <body>
        <div>
            <a href="products.php?id=1">Vegetables</a>
            <a href="products.php?id=2">Fruits</a>
            <a href="products.php?id=3">Diary Products</a>
            <a href="products.php?id=9">Foodgrains, Oil, Masala</a>
            <a href="products.php?id=4">Beverages</a>
            <a href="products.php?id=10">Snacks, Packed Food</a>
            <a href="products.php?id=5">Bread & Bakery Products</a>
            <a href="products.php?id=6">Canned foods/Ketchup</a>
            <a href="products.php?id=7">Cleaning and Household</a>
            <a href="products.php?id=8">Personal Care</a>
            <a href="products.php?id=10"></a>
        </div>
<?php
include 'config.php';
$sql="select `categ_name` from `categories`";
$result = mysqli_query($con,$sql);

if(!empty($_SESSION["shopping_cart"])) {
$cart_count = count(array_keys($_SESSION["shopping_cart"]));
?>
<div class="cart_div">
<a href="cart1.php"><img src="cart-icon.png" alt="cart"/> Cart<span><?php echo $cart_count; ?></span></a>
</div>
<?php
}

$result = mysqli_query($con,"SELECT * FROM `products`");
while($row = mysqli_fetch_assoc($result)){
		echo "<div class='product_wrapper'>
			  <form method='post' action=''>
			  <input type='hidden' name='code' value=".$row['code']." />";
			echo"  <div class='image'>";?>
            <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['image']); ?>" width="50" height="40"/> 

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
</html>