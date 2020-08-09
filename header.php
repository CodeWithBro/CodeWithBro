
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../webfonts/all.css">
     <link rel="stylesheet" href="/shop/styles.css">
    <title>Shop</title>
</head>
<body>

<header>
    <div class="wrap">
    <a href="/shop"><h2>Shop</h2> </a>
    <nav>
        <ul>
            <li><a href="/shop/admin" >Admin</i> </a></li>
            <?php if(! isset($admin)) : ?>
            <li><a href="checkout.php" class="cart_tracker"> Cart
     (<?php  (new Cart\Handler)->totalItem()?>) 
        </i> 

            </a>
        </li>
<?php endif; ?>
        </ul>
    </nav>
    </div>
</header>