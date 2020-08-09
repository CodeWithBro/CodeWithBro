<?php

session_start();
include "cart/handler.php";
include "cart/product.php";


if(isset($_POST)  and  ! empty($_POST))
{
    $product_id  = $_POST['product_id'];
    $product_qty = $_POST['total_qty'];
    $product_price = $_POST['price'];
    $product_image = $_POST['product_image'];
    $product_name = $_POST['product_name'];
    $product_arr = array(
        'product_id' => $product_id,
        'product_qty' => $product_qty,
        'price' => $product_price,
        'image' => $product_image,
        'name' => $product_name
    );
    $Cart_Handler = new Cart\Handler();

    $status = $Cart_Handler->addProduct( $product_arr );

    if( $status == "Updated" )
    {
        $_SESSION['message'] = "Your Cart Has Been Updated";
    }elseif( $status == "Added" )
    {
        $_SESSION['message'] = "One Item Added To Your Cart";
    }else
    {
       $_SESSION['message'] = "error";
    }

   header("Location: /shop");

}


