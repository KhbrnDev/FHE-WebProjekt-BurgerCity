<div class="cart-body">
    
    <h1>Lieferadresse und Zahlungsmethode wählen</h1>
    
    <a href="index.php?c=account&a=account" >Falls Sie an eine neue Adresse liefern möchten fügen Sie diese bitte hier hinzu.</a>
    
    <div class="checkout-body-left">
        <form method="POST">
            <div class="checkout-body-right">
                <input class="goToCheckout" type="submit" name="nextStep" value="nextStep">
            </div>
            <div class="checkout-adress-box">
                <?php for($int = 0; $int < 4; $int++):?>
                    <input type="radio" name="adress" value="ADRESSID__DASDASDASD" required>
                    <label >Acachen 5</label>
                    <label >Schönstedt</label>
                    <label >99947</label>
                <?php endfor;?>
            
            </div>
            <h3>Zahlungsmethode wählen</h3>
            <div class="choose-payment">

                <input type="radio" name="payment" id="card" value="card">
                <label for="card">EC-Karte</label>
                <div class="payment-card">
                    <label for="accountHolder">Kontoinhaber</label>
                    <input type="text" name="accountHolder" id="accountHoler">

                    <label for="iban">IBAN:</label>
                    <input type="text" name="iban" id="iban">
                </div>
                
                <input type="radio" name="payment" id="paypal" value="paypal">
                <label for="paypal">PayPal</label>
                <div class="payment-Paypal">
                    <label for="emailPaypal">EMail Adresse des PayPal Kontos</label>
                    <input type="text" name="emailPaypal" id="emailPaypal">
                </div>

                <input type="radio" name="payment" id="cash" value="cash">
                <label for="cash">Cash</label>
            </div>

        </form>

    </div>
</div>