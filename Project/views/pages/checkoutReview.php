
<div class="checkoutReview-body">

    <h1>CheckoutReview </h1> <!-- TODO Namen für alle überschriften, buttons etc. anpassen anpassen--->
    <?php
        if(isset($errors) && count($errors) > 0):
            ?>

            <div class="logsing-error-message">
                <h4><?=$errors['title']?></h4>
            <ul>
            <?php
                for($Index = 0; $Index < count($errors)-1; $Index++)
                {
                    ?>
                    <li><?=$errors[$Index]?></li>
                    <?php
                }   
            ?>
            </ul>
            </div>
            <?php
        endif;
    ?>

    <form method="POST">
        
        <div class="checkoutReview-body-right">
            <p class="total-number-of-products">Summe (<?=htmlspecialchars($preloadGesamtSumme['gesamtAnzahl'])?> Artiekl):<p class="sum-of-total-products"> <?=htmlspecialchars($preloadGesamtSumme['gesamtSumme'])?> €</p></p>
            <input class="goTo-CheckoutSuccess" type="submit" name="nextStep" value="Jetzt Bestellen">
            <textarea class="goToCart-Lieferhinweise"  name="lieferhinweise" id="lieferhinweise" cols="10" rows="4"><?=isset($preloadLieferHinweise) ? htmlspecialchars($preloadLieferHinweise) : ""?></textarea>
        </div>

        <div class="checkoutReview-body-left">
            <div class="checkout-product-box">
                <div class="lieferadresse">
                    <h3>Lieferadresse</h3>
                    <p><?=htmlspecialchars($preloadCartHelper['adress']->street) . " " . htmlspecialchars($preloadCartHelper['adress']->number)?></p>
                    <p><?=htmlspecialchars($preloadCartHelper['adress']->zipCode) . " " . htmlspecialchars($preloadCartHelper['adress']->city)?></p>
                </div>

                <div class="choose-payment">
                    <h3>Zahlungsmethode</h3>
                    <?php
                        if(isset($preloadCartHelper['payment']))
                        {
                        ?>
                            <p class="checkoutReview-payment-method"><?=$preloadCartHelper['payment']['method']?></p>
                            <?php
                            switch ($preloadCartHelper['payment']['method'])
                            {
                                case 'Barzahlung':
                                    break;
                                case 'Kartenzahlung':
                                    ?>
                                    <p>Karteninhaber: <?=htmlspecialchars($preloadCartHelper['payment']['accountHolder'])?></p>
                                    <p>IBAN: <?=htmlspecialchars($preloadCartHelper['payment']['iban'])?></p>
                                    <?php
                                    break;
                                case 'PayPal':
                                    ?>
                                    <p>PayPal-Email: <?=htmlspecialchars($preloadCartHelper['payment']['emailPaypal'])?></p>
                                    <?php
                                    break;
                                default:
                                    break;
                            }
                        
                        }
                    ?>
                </div>
            </div>        
                <?php
                    foreach($preloadOrders as $orderItem):
                ?>
                    <div class="cart-product-box">
                        <a class="cart-product-picture-link" href="">
                            <img class="cart-product-picture"src="<?=IMAGESPATH.$orderItem['product']->pictureURL?>" alt="<?=htmlspecialchars($orderItem['product']->altText)?>">
                        </a>

                        <div class="cart-product-box-right">
                            <h3><?=htmlspecialchars($orderItem['product']->description)?></h3>
                            

                            <div class="cart-item-id">
                                <input type="number" name="productsId" id="productsId" value="<?=htmlspecialchars($orderItem['product']->productsId)?>" required readonly>
                            </div>

                            <label class="totalProductPrice" for="totalProductPrice"><?=htmlspecialchars($orderItem['product']->price * $orderItem['quantity'])?> €</label>
                            
                            <label class="singleProductPrice"for="singleProductPrice">(<?=htmlspecialchars($orderItem['product']->price)?> € / Stück)</label>

                            <br>

                            <p>Anzahl: <?=htmlspecialchars($orderItem['quantity'])?></p>

                        </div>
                    </div>
                <?php
                    endforeach;
                ?>
        </div>
    </form>



</div>