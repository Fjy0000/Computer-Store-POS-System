<?php
    include 'config.php';
    session_start();
    $user_id = $_SESSION['user_id'];
    
if(isset($_GET['remove'])){
   $remove_id = $_GET['remove'];
   mysqli_query($conn, "DELETE FROM `wish` WHERE id = '$remove_id'") or die('query failed');
   header('location:wishlist.php');
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/wish.css">
        <title></title>
    </head>
    <body>        
                <table align="center" border="10px" style="width: 600px; line-height: 60px;">
            <tr>
                <th colspan="6"><h2>Order Record</h2></th>
            </tr>
            <t>
                <th>Image</th>
                <th>Name</th>
                <th>Price</th>
                <th>Action</th>
            </t>
            
         <?php
         $cart_query = mysqli_query($conn, "SELECT * FROM `wish` WHERE user_id = '$user_id'") or die('query failed');
         if(mysqli_num_rows($cart_query) > 0){
            while($fetch_cart = mysqli_fetch_assoc($cart_query)){
                ?>
            <tr>

                <th><?php echo $fetch_cart['image']; ?></th>
                <th><?php echo $fetch_cart['name']; ?></th>
                <th><?php echo $fetch_cart['price']; ?></th>
                            <th>
                <a href="wishlist.php?remove=<?php echo $fetch_cart['id']; ?>" class="delete-btn2" onclick="return confirm('remove item from wishlist?');">remove</a>
<!--                <a href="wishlist.php?id=.$fetch_cart['id']" class="btn">Delete</a>-->
            </th>
            </tr>
            <?php
            }
         }
            ?>
        </table>
         <center><a href="index.php"><input type="submit" class="btn2" value="Back"></a></center>
    </body>
</html>
