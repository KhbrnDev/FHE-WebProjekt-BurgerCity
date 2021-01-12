<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../assets/css/styles.css">
</head>
<body>
<?php
    include '../../views/headfoot/header1.php'
?>
 <div class="productItem-body">

    <h1>Burgername</h1>
    <div class="product-flex">
        <div class="product-left">
            <img class="product-picture" src="../../assets/images/burger1.png" alt="">

        </div>
        <div class="product-right">

            <h3>Zutaten:</h3>
            <span>Tomaten, BeffPatty, Majo und knusprige Brötchen</span>
            <div class="product-preis">
                <h3>Preis:</h3>
                <h5>nur</h5>
                <h2>6,99€</h2>
            </div>
            <form action="product.php" mehtod="GET">
                <input style="display: none;" type="text" name="warenbork" value="true" >
                <input class="addToWarenkorb" type="submit" value="In den Waarenkorb">
            </form>
        </div>
        
    </div>
 </div>


</body>
</html>