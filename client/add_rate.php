<?php 
include 'config.php';
?>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.0/css/bootstrap.min.css" integrity="sha384-SI27wrMjH3ZZ89r4o+fGIJtnzkAnFs3E4qz9DIYioCQ5l9Rd/7UAa8DHcaL8jkWt" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
    <link rel="stylesheet" href="css/123.css">
</head>
<body>
    
<div class="container">

<div class="products">

   <h1 class="heading">latest products</h1>

   <div class="box-container">

   <?php
      $select_product = mysqli_query($conn, "SELECT * FROM `product`") or die('query failed');
      if(mysqli_num_rows($select_product) > 0){
         while($fetch_product = mysqli_fetch_assoc($select_product)){
   ?>
      <form method="post" class="box" action="">
         <img src="images/<?php echo $fetch_product['image']; ?>" alt="">
         <div class="name"><?php echo $fetch_product['name']; ?></div>
         <div class="price">RM<?php echo $fetch_product['price']; ?></div>
         <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
         <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">
         <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
         <!--<input type="submit" value="view product" name="view_product" class="btn1">-->
      </form>
   <?php
      };
   };
   ?>

   </div>

</div>


    <div class="row">
 
<form action="add_rate.php" method="post">
 
    <div>
        <h3>Product Rating</h3>
    </div>
 
    <div>
         <label>Name</label>
        <input type="text" name="name">
    </div>
            <div>
         <label>Product Name</label>
        <input type="text" name="product">
    </div>
        <div>
         <label>Comment</label>
        <input type="text" name="comment">
    </div>
 
         <div class="rateyo" id= "rating"
         data-rateyo-rating="4"
         data-rateyo-num-stars="5"
         data-rateyo-score="3">
         </div>
 
    <span class='result'>0</span>
    <input type="hidden" name="rating">
 
    </div>
 
    <div><input type="submit" name="add" class="btn2"> </div>
    
    <div class="box-container">

        <table align="center" border="10px" style="width: 600px; line-height: 60px;">
            <tr>
                <th colspan="4"><h2>Order Record</h2></th>
            </tr>
            <t>
                <th>Name</th>
                <th>Product</th>
                <th>Rate</th>
                <th>Comment</th>
            </t>
            
         <?php
         $results = mysqli_query($conn, "SELECT * FROM `rating`");
            while($rows= mysqli_fetch_assoc($results)){
                ?>
            <tr>
                <th><?php echo $rows['name']; ?></th>
                <th><?php echo $rows['product']; ?></th>
                <th><?php echo $rows['rate']; ?></th>
                <th><?php echo $rows['comment']; ?></th>
            </tr>
            <?php
            }
            ?>
            
        </table>

    </div>

</form>

</div>
</div>
<center><a href="index.php"><input type="submit" class="btn1" value="Back"></a></center>
    
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
 
<script>
 
 
    $(function () {
        $(".rateyo").rateYo().on("rateyo.change", function (e, data) {
            var rating = data.rating;
            $(this).parent().find('.score').text('score :'+ $(this).attr('data-rateyo-score'));
            $(this).parent().find('.result').text('rating :'+ rating);
            $(this).parent().find('input[name=rating]').val(rating); //add rating value to input field
        });
    });
 
</script>
</div>
</body>
 
</html>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $name = $_POST["name"];
    $product = $_POST["product"];
    $comment = $_POST["comment"];
    $rating = $_POST["rating"];
 
    $sql = "INSERT INTO rating (name, product, comment, rate) VALUES ('$name', '$product', '$comment' ,'$rating')";
    if (mysqli_query($conn, $sql))
    {
        echo "New Rate addedddd successfully";
    }
    else
    {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    mysqli_close($conn);
}
?>