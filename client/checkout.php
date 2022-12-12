<?php

include 'config.php';
include 'index.php';

if(isset($_POST['order_btn'])){

   $name = $_POST['name'];
   $number = $_POST['number'];
   $email = $_POST['email'];
   $method = $_POST['method'];
   $flat = $_POST['flat'];
   $street = $_POST['street'];
   $city = $_POST['city'];
   $state = $_POST['state'];
   $country = $_POST['country'];
   $postal_code = $_POST['postal_code'];
   $date = date("Y-m-d");
   $delivery = "Preparing";

   $cart_query = mysqli_query($conn, "SELECT * FROM `cart`");
   $price_total = 0;
   if(mysqli_num_rows($cart_query) > 0){
      while($product_item = mysqli_fetch_assoc($cart_query)){
         $product_name[] = $product_item['name'] .' ('. $product_item['quantity'] .') ';
         $product_price = number_format($product_item['price'] * $product_item['quantity']);
         $price_total += ((int)$product_price);
      };
   };

   $total_product = implode(', ',$product_name);
   $detail_query = mysqli_query($conn, "INSERT INTO `orders`(name, number, email, method, flat, street, city, state, country, postal_code, total_product, total_price, date, delivery_status) "
           . "VALUES('$name','$number','$email','$method','$flat','$street','$city','$state','$country','$postal_code','$total_product','$grand_total','$date', '$delivery')") or die('query failed');

   if($cart_query && $detail_query){
      echo "
      <div class='order-message-container'>
      <div class='message-container'>
         <h3>thank you for shopping!</h3>
         <div class='order-detail'>
            <span class='total'> total : RM".$grand_total."  </span>
         </div>
         <div class='customer-details'>
            <p> your name : <span>".$name."</span> </p>
            <p> your number : <span>".$number."</span> </p>
            <p> your email : <span>".$email."</span> </p>
            <p> your address : <span>".$flat.", ".$street.", ".$city.", ".$state.", ".$country." - ".$pin_code."</span> </p>
            <p> your payment mode : <span>".$method."</span> </p>
         </div>
            <a href='index.php' class='btn'>continue shopping</a>
         </div>
      </div>
      ";
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>checkout</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/checkout.css">

</head>
<body>


<div class="container">

<section class="checkout-form">

    <h1 class="heading">complete your order</h1>
    <center>
           <div class="total_product">
            <p>Product and Total</p>
                  <?php
                $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
                if(mysqli_num_rows($cart_query) > 0){
                   while($fetch_cart = mysqli_fetch_assoc($cart_query)){
             ?>
            <?php echo $fetch_cart['name']; ?>
            RM<?php echo $fetch_cart['price']; ?>,

      <?php
         $grand_total;
            }
         }else{
            echo '<tr><td style="padding:20px; text-transform:capitalize;" colspan="6">no item added</td></tr>';
         }
      ?>
    </center>
    <center>
        <p class="total_product">grand total : RM<?php echo $grand_total; ?></p>
    </center>


   <form action="" method="post">

       <div class="flex">
         <div class="inputBox">
            <span>your name</span>
            <input type="text" placeholder="enter your name" name="name" required>
         </div>
         <div class="inputBox">
            <span>your number</span>
            <input type="number" placeholder="enter your number" name="number" required>
         </div>
         <div class="inputBox">
            <span>your email</span>
            <input type="email" placeholder="enter your email" name="email" required>
         </div>
         <div class="inputBox">
            <span>payment method</span>
            <select name="method">
               <option value="credit cart">Credit Card</option>
            </select>
         </div>
         <div class="inputBox">
            <span>name of card</span>
            <input type="text" placeholder="John More Doe" name="flat" required>
         </div>
         <div class="inputBox">
            <span>Credit card number</span>
            <input type="text" placeholder="1111-2222-3333-4444" name="flat" required>
         </div>
         <div class="inputBox">
            <span>Expiration (mm/yy)</span>
            <input type="text" placeholder="MM/YY" name="flat" required>
         </div>
         <div class="inputBox">
            <span>CVV</span>
            <input type="text" placeholder="cvv" name="flat" required>
         </div>
         <div class="inputBox">
            <span>address line 1</span>
            <input type="text" placeholder="e.g. flat no." name="flat" required>
         </div>
         <div class="inputBox">
            <span>address line 2</span>
            <input type="text" placeholder="e.g. street name" name="street" required>
         </div>
         <div class="inputBox">
            <span>city</span>
            <input type="text" placeholder="e.g. mumbai" name="city" required>
         </div>
         <div class="inputBox">
            <span>state</span>
            <input type="text" placeholder="e.g. maharashtra" name="state" required>
         </div>
         <div class="inputBox">
            <span>country</span>
            <input type="text" placeholder="e.g. india" name="country" required>
         </div>
         <div class="inputBox">
            <span>pin code</span>
            <input type="text" placeholder="e.g. 123456" name="pin_code" required>
         </div>
      </div>
      <input type="submit" value="order now" name="order_btn" class="btn">
   </form>

</section>

</div>

<!-- custom js file link  -->
<script src="js/script.js"></script>
   
</body>
</html>