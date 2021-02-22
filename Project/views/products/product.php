<div class="productItem-body">

    <h1><?=$product->description?></h1>
    <div class="product-flex">
        <div class="product-left">
            <img class="product-picture" src="<?=IMAGESPATH.$product->pictureURL?>" alt="<?=htmlspecialchars($product->altText)?>">

        </div>
        <div class="product-right">

            <h3>Zutaten:</h3>
            <span>
            <?php

            for($index = 0; $index < count($ingredients); $index++)
            {
                
                echo(htmlspecialchars($ingredients[$index]->description)); 
                if($index < count($ingredients)-1){
                    echo(", "); 
                }
            }
            ?>

            </span>
            <div class="product-preis">
                <h3>Preis:</h3>
                <h5>nur</h5>
                <h2><?=htmlspecialchars($product->price)?></h2>
            </div>
            <form mehtod="POST">
                <input style="display:none;" type="text" name="productsId" value="<?=htmlspecialchars($product->productsId)?>">
                <input class="addToCard-Button" type="submit" value="In den Warenkorb">
            </form>
        </div>
        
    </div>
 </div>


</body>
</html>