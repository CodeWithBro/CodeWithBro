<?php
namespace Cart;

use ___PHPSTORM_HELPERS\object;

include "Database.php";
class Product  {

    private $database ;
   private $Cart_Handler ;
    public function __construct()
    {
          $this->database = new  \Cart\Db;
          $this->Cart_Handler = new  \Cart\Handler();
    }

    public function addProduct(array $newProduct)
    {
       $smst = "insert into product(product_name, product_description, date_added, thumbnail , price) value(?,?,?,?,?)";
       $param = "ssssi";
       return $this->database->Insert($smst, $param, $newProduct);
    }

    public  function listProduct(array $details)
    {
        $cast = (object) $details;
        $qty = null;
        ob_start();

        if(($index = $this->Cart_Handler->productInCart($cast->id))!== false) {
            $qty = (int) $this->Cart_Handler->getItem($cast->id , 'product_qty') ;
        }

        $itemId = $qty ? $qty : 1;

   ?>
        <form action="add.php" method="post" onsubmit="">
        <img src="<?= $cast->imgPath ?>" alt="">
        <h2 align="center"><?= $cast->productName ?></h2>
      
        <div class="qty">
            <button onclick="qty(this, 'desc')" type="button" id="dec"><i class="fa fa-minus"></i></button>
            <input type="number" name="total_qty" id="" value="<?= $itemId ?>" min="1">
            <button onclick="qty(this, 'inc')" type="button" id="dec"><i class="fa fa-plus"></i></button>
        </div>

        <div class="price-tag">
            <span>Price</span>
            <span class="priceNumber"><?= number_format($cast->price) ?> Naira</span>
        </div>
        <div class="button">
        <button type="submit" class="buy"> Buy</button>
        <?php if( $qty > 0) : ?>
        <a href="remove.php?code=<?= $cast->id ?>" class="btn-remove"> remove</a>
        <?php  endif; ?>
        </div>
        <input type="hidden" name="price" value="<?= $cast->price ?>">
        <input type="hidden" name="product_id" value="<?= $cast->id ?>">
        <input type="hidden" name="product_name" value="<?= $cast->productName ?>">
        <input type="hidden" name="product_image" id="" value="<?= $cast->imgPath ?>">
     </form>

   <?php
    echo ob_get_clean();
    }


    public  function showProduct($condition = null)
    {
        $smt = "SELECT * FROM product";
        if( $condition ) $smt .= $condition;
        return $this->database->Query($smt);
    }
}