<div class="cart-body">
    <h1>Einkaufswagen</h1>


    <?php
        if(count($preloadOrders) !== 0):
    ?>

    <div class="cart-body-right">
        <p class="total-number-of-products">Summe (<?=htmlspecialchars($preloadGesamtSumme['gesamtAnzahl'])?> Artiekl):<p class="sum-of-total-products"> <?=htmlspecialchars( getGermanNumber($preloadGesamtSumme['gesamtSumme']))?></p></p>
        
        <form method="POST">
            <input class ="goToCartReview" type="submit" name="goToCartReview" id="goToCardReview" value="Zur Kasse gehen">
            <label class="goToCart-Label" for="lieferhinweise">Lieferhinweise</label>
            <br>
            <textarea class="goToCart-Lieferhinweise"  name="lieferhinweise" id="lieferhinweise" cols="10" rows="4"><?=isset($preloadLieferHinweise) ? htmlspecialchars($preloadLieferHinweise) : ""?></textarea>
        </form>
    </div>

    
    <div class="cart-body-left">
        <?php foreach($preloadOrders as $orderItem){ ?>
        <form method="POST">
            <div class="cart-product-box">
                <a class="cart-product-picture-link" href="index.php?c=products&a=product&f=<?=$orderItem['product']->productsId?>">
                    <img class="cart-product-picture"src="<?=IMAGESPATH.$orderItem['product']->pictureURL?>" alt="<?=htmlspecialchars($orderItem['product']->altText)?>">
                </a>

                <div class="cart-product-box-right">
                    <h3><?=htmlspecialchars($orderItem['product']->description)?></h3>
                    

                    <div class="cart-item-id">
                        <input type="number" name="productsId" id="productsId" value="<?=htmlspecialchars($orderItem['product']->productsId)?>" required readonly>
                    </div>

                    <label class="totalProductPrice" for="totalProductPrice"><?=htmlspecialchars(getGermanNumber($orderItem['product']->price * $orderItem['quantity']))?></label>
                    
                    <label class="singleProductPrice"for="singleProductPrice">(<?=htmlspecialchars(getGermanNumber($orderItem['product']->price))?> / Stück)</label>

                <br>

                    <label class="label-numberOfItem" for="numberOfItem">Anzahl:</label>
                    <input class="input-numberOfItem" type="number" name="numberOfItems" min="0" max="100" step="1" value="<?=htmlspecialchars($orderItem['quantity'])?>" required>
                
                </div>
                <div class="cart-product-box-buttons">
                    <input type="submit" name="deleteItem" id="deleteItem" value="Löschen">
                    <input type="submit" name="saveItemCount" id="saveItemCount" value="Anzahl speichern">
                </div>
            </div>
        </form>
        <?php }?>
        
        <?php
            else:
        ?>  

        Sie haben noch keine Artikel im Einkaufswagen. Sie können sich <a href="index.php?c=products&a=menue">hier</a> welche aussuchen
        <br>
        <img class="cart-picture" src="<?=IMAGESPATH.'einkaufswagen.png'?>" alt="schöner schlichter Einkaufswagen">


        <?php 
            endif;
        ?>

    </div>


</div>