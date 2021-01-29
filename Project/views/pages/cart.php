<div class="cart-body">
    <h1>Einkaufswagen</h1>
    <p class="total-number-of-products">Summe (3 Artiekl):<p class="sum-of-total-products"> 61.38€</p></p>
    
    <form method="POST">
        <input class ="goToCartReview" type="submit" name="goToCartReview" id="goToCardReview" value="Zur Kasse gehen">
    </form>

    <?php for($int = 0; $int < 4 ; $int++){ ?>
    <form method="POST">
        <div class="cart-product-box">
            <!-- <a class="cart-product-picture" href=""> -->
                <img class="cart-product-picture"src="<?=IMAGESPATH.'German_Burger.png'?>" alt="">
            <!-- </a> -->

            <div class="cart-product-box-right">
                <h4>German Burger</h4>
                

                <div class="cart-item-id">
                    <input type="number" name="productId" id="productsId" required>
                </div>

                <label class="totalProductPrice" for="totalProductPrice">14.00€</label>
                
                <label class="singleProductPrice"for="singleProductPrice">(1.147€ / Stück)</label>

               

                <label class="label-numberOfItem" for="numberOfItem">Anzahl:</label>
                <input class="input-numberOfItem" type="number" name="numberOfItem" id="numberOfItem" min="0" placeholder="6" required>
            </div>

                <input type="submit" name="deleteItem" id="deleteItem" value="Löschen">
                <input type="submit" name="saveItemCount" id="saveItemCount" value="Anzahl speichern">
        </div>
    </form>
    <?php }?>

    <h5>Lieferinformationen</h5>
    <textarea name="" id="" maxlenght="255"></textarea>
    <!-- <p class="total-number-of-products">Summe (3 Artiekl):<p class="sum-of-total-products"> 61.38€</p></p>
    
    <form method="POST">
        <input class ="goToCartReview" type="submit" name="goToCartReview" id="goToCardReview" value="Zur Kasse gehen">
    </form> -->


</div>