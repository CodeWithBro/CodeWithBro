<?php

namespace Cart;

use mysqli;

 class Db 
 {
     public $handle;
     private $host = "localhost";
     private  $user = 'root';
     private $pass = "";
    //  make sure to create a database called shopping_cart.
     private $db = "shopping_cart";
     public $error ;
     public function __construct()
     {
        $this->handle =  $this->connect();
     }
     private function connect()  {
         return new mysqli($this->host, $this->user, $this->pass, $this->db);
     }
     
   

     public function Query( $q )
     {
       return $this->handle->query($q);
     }
     
     public function Insert($q,$param,$data)
     {
        $sql = $this->handle->prepare($q);
        if(!empty($param) and ! empty($data))
        {
        $this->bindQuery($sql,$param,$data);
        }
        return $sql->execute();
     }

     public function myQuery($q, $param, $data)
     {
           $sql = $this->handle->prepare($q);
           $this->bindQuery($sql,$param,$data);
           if(  $sql->execute() )
           {
           $res  = $sql->get_result();
           while ($f = $res->fetch_object()) {
               $result[] =  $f;
           }
           if(!empty($result))
           {
               return $result;
           }else return null;
           }else {
               echo  $this -> handle-> mysqli_error();
           }
          
     }
     public function Update($q, $param, $data)
     {
       $sql = $this->handle->prepare($q);
       $this->bindQuery($sql,$param,$data);
        return $sql->execute();
     }
     public function Delete($q, $param, $data)
     {
       $sql = $this->handle->prepare($q);
       $this->bindQuery($sql,$param,$data);
        return $sql->execute() ;
     }


     private function bindQuery($sql, $param ,$data)
     {
         $databind[]= &$param;
         for($i  = 0; $i < count($data); $i++)
         {
             $databind[] = &$data[$i];
         }
         call_user_func_array(array($sql, 'bind_param'), $databind);
     }

     public function __destruct()
     {
         $this->handle->close();
     }
 }