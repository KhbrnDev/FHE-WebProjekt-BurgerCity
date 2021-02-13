<div class="productItem-body">

    <h1><?=$product->description?></h1>
    <div class="product-flex">
        <div class="product-left">
            <img class="product-picture" src="<?=IMAGESPATH.$product->pictureURL?>" alt="<?=$product->altText?>">

        </div>
        <div class="product-right">

            <h3>Zutaten:</h3>
            <span>
            <?php

            //for($index = 0; $index < count($ingredients); $index++)
            //{
              //  echo($ingredients[$index]->description); 
            //}
            ?>

            </span>
            <div class="product-preis">
                <h3>Preis:</h3>
                <h5>nur</h5>
                <h2><?=$product->price?></h2>
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