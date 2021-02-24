<div class="checkout-body">
    
    <h1>Checkout</h1>
    
    <!-- Hier PHP fuer ErrorMessage inefuegen -->
    <?php   if(isset($success['success']) && $success['success'] === true)
        {
            ?>
            <div class="logsing-success-message">
                <?=$success['message']?>
            </div>
            <?php
        }
        elseif(isset($errors) && count($errors) > 0)
        {
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
        }
?>
  
    <form method="POST">
        
        <div class="checkout-body-right">
            <input class="goTo-CheckoutReview" type="submit" name="nextStep" value="nächster Schritt">
        </div>

        <div class="checkout-body-left">

            <div class="lieferadresse">
                <h3>Lieferadresse auswählen</h3>
                <a href="index.php?c=account&a=account" >Falls ihr gewünschte Lieferadresse nicht angezeigt wird legen Sie diese bitte in ihrem Account an.</a>
                <div class="checkout-adress-box">
                    <?php foreach($preloadAdresses as $adress):?>
                        <input type="radio" id="adressId<?=$adress->adressId?>" name="adressId" value="<?=$adress->adressId?>" required>
                        <label for="adressId<?=$adress->adressId?>" ><?=$adress->street . " " . $adress->number . " " . $adress->city . " " . $adress->zipCode?></label>
                        <br>
                    <?php endforeach;?>
            </div>
            
            </div>
            <h3>Zahlungsmethode wählen</h3>
            <div class="choose-payment">
                <input class="card-input" type="radio" name="payment" id="card" value="card" required>
                <label class="card-label" for="card">EC-Karte</label>
                <div class="payment-card">
                    <label class="card-name-label" for="accountHolder">Kontoinhaber</label>
                    <input class="card-name-input" type="text" name="accountHolder" id="accountHolder">

                    <label class="card-iban-label" for="iban">IBAN:</label>
                    <input class="card-iban-input" type="text" name="iban" id="iban">
                    <br>
                    Format: AB12 1234 1234 1234 1234 oder AB123456789012345678
                </div>
                
                <br>

                <input class="paypal-input" type="radio" name="payment" id="paypal" value="paypal" required readonly>
                <label class="paypal-label" for="paypal">PayPal</label>
                <div class="payment-Paypal">
                    <label class="paypal-label" for="emailPaypal">EMail Adresse des PayPal Kontos</label>
                    <input class="paypal-input" type="email" name="emailPaypal" id="emailPaypal">
                </div>

                <br>

                <input class="cash-input" type="radio" name="payment" id="cash" value="cash" required readonly>
                <label class="cash-label" for="cash">Barzahlung bei Lieferung</label>
            </div>
        </div>
        

        
    </form>
</div>