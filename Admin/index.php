<?php
 $admin = true;
include "../Cart/Handler.php";
 include "../header.php";
 include "../cart/product.php";
 if(isset($_POST) and !empty($_POST))
 {
   if( !empty($_POST['product_name']) and
       ! empty($_POST['product_price']) and 
       !empty($_POST['product_desc']) and
       ! empty($_POST['product_price'])
    ) {
      if( isset( $_FILES ) and !empty($_FILES['product_image']['tmp_name']) ) {
          $image = $_FILES['product_image'];
      }else{
          $message['error'] = "Please do upload a valid Image for product.";
      }
      if( ! ctype_digit($_POST['product_price']) )
      {
          $message['error'] = "Price Must Be In Digit Format.";
      }

      if( empty($message['error']) )
      {
      
        $product = new Cart\Product;
        $date = new DateTime(null , new DateTimeZone('Africa/Lagos'));
        $date = $date->format('Y-m-d H:i:s');
        $thumbnail = $image['name'];
        $rename = substr($thumbnail , 0, strrpos($thumbnail, '.'));
        $ext = '.' . end(explode('.', $thumbnail));
        $thumbnail  =  $rename.explode('.', microtime(true))[0].$ext;
        $newProduct = array($_POST['product_name'], $_POST['product_desc'] , $date, $thumbnail, $_POST['product_price']);
       if( move_uploaded_file( $image['tmp_name'] , "../uploads/".$thumbnail) )
       {
         $message['success'] = "Upload Done...";
         if( $product->addProduct($newProduct) )
         {
             $message['success'] .= "<br> New Product Added To Shop";
         }
       }else {
           echo "Upload Went, Please Contact Bro";
       }
      }
    }else{
        $message['error'] = "All field must not be left empty";
    }
 }
?>

 <div class="wrap">
 <div class="addproduct">
     <h2>Add New Product</h2>
     <?php  if(isset($message))  {
       foreach($message as $key => $val)
       {
           ?>
            <div class="message <?= $key ?>">
               <?= $val ?>
          </div>
           <?php
       }
     }?>
      
     <form action="/shop/admin/index.php" method="post" enctype="multipart/form-data">
     
       <div class="form-control">
           <label for="">Enter Product Name</label>
           <input type="text" name="product_name" id="">
       </div>

       <div class="form-control">
           <label for="">Enter Product Price</label>
           <input type="text" name="product_price" id="">
       </div>
       <div class="form-control">
           <label for="">Select Product Thumbnail (Picture)</label>
           <input type="file" name="product_image" id="" accept="image/*">
       </div>
       <div class="form-control">
           <label for="">Enter Product Details</label>
          <textarea name="product_desc" id="" cols="30" rows="10"></textarea>
       </div>
       <div class="form-control">
            <button type="submit" class="addNew"><i class="fa fa-plus"></i> Add New Product</button>
      </div>

    </form>
 </div>
 </div>


<?php
 include "../footer.php";
?>