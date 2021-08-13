<?php
session_start();
$total=$_GET['bill'];
$products=$_GET['items'];
include 'actionpage.php';
include 'config.php';
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body {
  font-family: Arial;
  font-size: 17px;
  padding: 8px;
}

* {
  box-sizing: border-box;
}

.row {
  display: -ms-flexbox; /* IE10 */
  display: flex;
  -ms-flex-wrap: wrap; /* IE10 */
  flex-wrap: wrap;
  margin: 0 -16px;
}

.col-25 {
  -ms-flex: 25%; /* IE10 */
  flex: 25%;
}

.col-50 {
  -ms-flex: 50%; /* IE10 */
  flex: 50%;
}

.col-75 {
  -ms-flex: 75%; /* IE10 */
  flex: 75%;
}

.col-25,
.col-50,
.col-75 {
  padding: 0 16px;
}

.container {
  background-color: #f2f2f2;
  padding: 5px 20px 15px 20px;
  border: 1px solid lightgrey;
  border-radius: 3px;
}

input[type=text] {
  width: 100%;
  margin-bottom: 20px;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 3px;
}

label {
  margin-bottom: 10px;
  display: block;
}

.icon-container {
  margin-bottom: 20px;
  padding: 7px 0;
  font-size: 24px;
}

.btn {
  background-color: #4CAF50;
  color: white;
  padding: 12px;
  margin: 10px 0;
  border: none;
  width: 100%;
  border-radius: 3px;
  cursor: pointer;
  font-size: 17px;
}

.btn:hover {
  background-color: #45a049;
}

a {
  color: #2196F3;
}

hr {
  border: 1px solid lightgrey;
}

span.price {
  float: right;
  color: grey;
}

/* Responsive layout - when the screen is less than 800px wide, make the two columns stack on top of each other instead of next to each other (also change the direction - make the "cart" column go on top) */
@media (max-width: 800px) {
  .row {
    flex-direction: column-reverse;
  }
  .col-25 {
    margin-bottom: 20px;
  }
}
</style>
</head>
<body>

<h2>Checkout Prerequisites</h2>
<div class="row">
  <div class="col-25">
    <div class="container">
        <h4>Cart <span class="price" style="color:black"><i class="fa fa-shopping-cart"></i> <b><?php echo $products;?></b></span></h4>
      <p></p>
      <hr>
      <p>Total <span class="price" style="color:black"><b><?php echo 'Rs '.$total;?></b></span></p>
    </div>
  </div>
  <div class="col-75">
    <div class="container">
      <form action="orderplaced.php" method="post">
      
        <div class="row">
          <div class="col-50">
            <h3>Billing Address</h3>
            <label for="fname"> Full Name</label>
            <input type="text" id="fname" name="firstname" placeholder="enter your name">
            <label for="email"> Email</label>
            <input type="text" id="email" name="email" placeholder="eg@gmail.com">
            <label for="adr"> Address</label>
            <input type="text" id="adr" name="address" placeholder="enter address">
            </div>
          </div>

          <div class="col-50">
            <h3>Payment</h3>
        
            <label for="cname">Name on Card</label>
            <input type="text" id="cname" name="cardname" placeholder="name on card" required>
            <label for="ccnum">Credit card number</label>
            <input type="text" id="ccnum" name="cardnumber" placeholder="xxxx-xxxx-xxxx-xxxx" required>
            <label for="expmonth">Exp Month</label>
            <input type="text" id="expmonth" name="expmonth" placeholder="05"required>
            <div class="row">
              <div class="col-50">
                <label for="expyear">Exp Year</label>
                <input type="text" id="expyear" name="expyear" placeholder="xxxx"required>
              </div>
              <div class="col-50">
                <label for="cvv">CVV</label>
                <input type="text" id="cvv" name="cvv" placeholder="xxx" required>
              </div>
            </div>
          </div>
        </div>
      <input type="submit" name="place" value="Continue to checkout" class="btn">
      </form>
    </div>
  </div>

</body>
</html>
<?php
include 'actionpage.php';
$date=date("y/m/d");
$time=date("h:i:s");
$addr=$_POST['adr'];
if(isset($_POST['place']))
{
   $sql="insert into orders(cid,total,address,date,time) values('$customer_id','$total','$addr','$date','$time)";
   $result=  mysqli_query($con, $sql);

} 
?>
