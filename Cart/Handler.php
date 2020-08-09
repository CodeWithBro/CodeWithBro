<?php

namespace Cart;
class Handler  {

    private $cart;
    public function __construct()
    {
        if(! isset($_SESSION['cart']) )  
        {
         $_SESSION['cart'] = serialize(array());
        }
        $this->cart =& $_SESSION["cart"];
    }

    public function addProduct( $item )
    {
       $cart = unserialize($this->cart);
       $status = null;

       if(($index =  $this->productInCart( $item['product_id'] ) )!== false  )
       {
         if( $item['product_qty'] <> $cart[$index]['product_qty'] )
         {
            $cart[$index]['product_qty'] = $item['product_qty'];
            $status = "Updated";
         } 
       }
       else {
        $cart[$item['product_id']] = $item;
        $status = "Added";
       }
       $this->cart = serialize($cart);
       return  $status;
    }

    public function productInCart( $product_id )
    {
        $cart = unserialize($this->cart);
        foreach ( $cart as $key => $val ) { 
            if( $key == $product_id )
            {
                return $key;
                break;
            }
        }
        return false;
    }

    public function totalItem()
    {
       echo count(unserialize($this->cart));
    }

    public function getItem( $id,  $item )
    {
        $cart = unserialize($this->cart);
        return $cart[$id][$item];
    }

    public function removeItem( $itemId )
    {
        $cart = unserialize( $this->cart );
        $cartItem = $this->productInCart( $itemId );
        
        if( $cartItem !== false )
        {
           unset( $cart[ $itemId ] );
           $this->cart = serialize($cart);
           return true;
        }
    }

    public function checkOut()
    {
        $cart  = unserialize( $this->cart );

        if( count( $cart )  > 0 )
        {
            return $cart;
        }else{
            return false;
        }
    }
}