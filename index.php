<?php
 session_start();
 include "cart/handler.php";
 include "header.php";
 include "cart/product.php";

 $products_Instance = new Cart\Product;
 $products =  $products_Instance->showProduct();
?>
 

 <div class="wrap">
  <h2>Our Products</h2>
    <?php
        if(isset($_SESSION['message']) )
        {
            echo "<div class='message-front'>";
            if( $_SESSION['message'] !== "error") {
            echo "<div class='message success' >";
            echo  $_SESSION['message'];
            echo "</div>";
            }
            if( $_SESSION['message'] == "error") {
            echo "<div class='message error'>";
            echo  "No changes to make";
            echo "</div>";
            }
            unset($_SESSION['message']);

            echo "</div>";
        }
    ?>

    <div class="productList">
         
    <?php 
     
     while( $product =  $products->fetch_object()  )
     {
         $producti['productName'] = $product->product_name;
         $producti['imgPath'] = 'uploads/'.$product->thumbnail; 
         $producti['price'] = $product->price;
         $producti['id'] = $product->product_id;
         $products_Instance->listProduct($producti);
     }
     
    ?>
    
    </div>
 </div>



<?php
 include "footer.php";
?>