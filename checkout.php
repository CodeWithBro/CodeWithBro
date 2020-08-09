<?php
 session_start();
 include "cart/handler.php";
 include "header.php";


 $Cart_Instance = (new Cart\Handler)->checkOut();


 $total = null;
?>

 <div class="wrap">
 <h2>Check Out</h2>
     <div class="check-content">
  
     <?php if(! $Cart_Instance ) {  ?>
     <p>NO ITEM IN CART</p>
     <?php }else {
      foreach( $Cart_Instance as $key => $val ) {   
      $price_per_item =  $Cart_Instance[$key]['price']  * $Cart_Instance[$key]['product_qty'];
      $total  += $price_per_item;
     ?>
      <div class="checkout">
          <a href="remove.php?code=<?= $Cart_Instance[$key]['product_id'] ?>&r=checkout.php"><i class="fa fa-times delete"></i></a>
      <img width="150" src="<?= $Cart_Instance[$key]['image'] ?>" alt="">
      <h3 align="center"><?= $Cart_Instance[$key]['name']  ?></h3>
      <div class="checkout-details">
       <b> Price:</b>  <?= number_format( $Cart_Instance[$key]['price'] ) ?> Naira
        <br>
       <b> Quantity: </b>  <?= $Cart_Instance[$key]['product_qty'] ?>
        <br>
      <b>  Amount: </b>  <?= number_format($price_per_item) ?> Naira
      </div>
      </div>
   
     <?php }} ?>
     </div>
     
      <?php if($total) : ?>

     <div class="payment">
         <div class="price">
        <b>Total Price: </b> <?= number_format($total) ?> Naira.
         </div>
         <div class="btn-checkout">
             <a href="#D">Continue With PayStack</a>
         </div>
     </div>
      <?php endif; ?>
 </div>

<?php
 include "footer.php";
?>
 