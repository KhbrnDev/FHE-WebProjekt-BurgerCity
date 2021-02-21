
<div class="account-body">
    <div class="h1-ausloggen">
        <form method="post">
            <input type="submit" name="logout" value="Logout">
        </form>
        <h1>Willkommen,<br><?=$preloadUser['firstname'] . " " . $preloadUser['lastname']?></h1>
        
    </div>
    <!-- <div class="error"> -->
            <!-- Hier PHP fuer ErrorMessage inefuegen -->
            <?php   if($success['success'] === true)
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
    <!-- </div> -->
    <h2>Accountinformationen</h2>
    <div class="account-properties">
        <div class="account-form">
            <form action="" method="post">
                <div class="account-form-object">
                    <label for="firstname">Vorname</label>
                    <br>
                    <input type="text" id="firstname" name="firstname" value="<?=(isset($preloadUser['firstname'])) ? htmlspecialchars($preloadUser['firstname']) : ""?>" required>
                </div>
                
                <div class="account-form-object">
                    <label for="lastname">Nachname</label>
                    <br>
                    <input type="text" id="lastname" name="lastname" value="<?=(isset($preloadUser['lastname'])) ? htmlspecialchars($preloadUser['lastname']) : ""?>" required>
                </div>

                <div class="account-form-object">
                    <label for="birthday">Geburtsdatum</label>
                    <br>
                    <input type="date" id="birthday" name="birthday" value="<?=(isset($preloadUser['birthday'])) ? htmlspecialchars($preloadUser['birthday']) : ""?>" required>
                </div>

                <div class="account-form-object">
                    <label for="email">E-Mail</label>
                    <br>
                    <input type="email" id="email" name="email" value="<?=(isset($preloadUser['email'])) ? htmlspecialchars($preloadUser['email']) : ""?>" required>
                </div>

                <div class="account-form-object">
                    <label for="phoneNumber">Telefonnummer</label>
                    <br>
                    <input type="tel" id="phoneNumber" name="phoneNumber" value="<?=(isset($preloadUser['phoneNumber'])) ? htmlspecialchars($preloadUser['phoneNumber']) : ""?>" required>
                </div>
                <div class="account-form-object">
                    <br>
                    <input type="submit" name="changeAccount" id="submit" value="Account ändern">
                </div>  
            </form>
        </div>
    </div>

    <h2>Passwort ändern</h2>
    <div class="account-properties">
        <div class="account-form">
        <form method="post">

            <div class="account-form-object">
                <label for="currentPassword">Aktuelles Passwort</label>
                <br>
                <input type="password" id="currentPassword" name="currentPassword" placeholder="G3H31Mn1sS" required>
            </div>

            <div class="account-form-object">
                <label for="newPassword">Neues Passwort</label>
                <br>
                <input type="password" id="newPassword" name="newPassword" required>
            </div>
            <div class="account-form-object">
                <br>
                <input type="submit" name="changePassword" id="submit" value="Account ändern">

            </div> 
        </form>
        </div>
    </div>

    
    <h2>Adressen</h2>
    <div class="account-adresses">
        <?php if(count($preloadAdress) > 0 ):?> 
            <?php
                for($Index = 0; $Index < count($preloadAdress); $Index++)
                {
                    ?>
                        <form class="account-adress-form" action="" method="post">
                            
                            <div  class="account-adress-form-object" style="display: none;">
                                <label for="adressId">adressId:</label>
                                <br>
                                <input type="number" name="adressId" id="adressId" value="<?=$preloadAdress[$Index]->adressId?>" required>
                            </div>

                            <div  class="account-adress-form-object">
                                <label for="street">Strase:</label>
                                <br>
                                <input type="text" name="street" id="street" value="<?=htmlspecialchars($preloadAdress[$Index]->street)?>" required>
                            </div>

                            <div class="account-adress-form-object">
                                <label for="number">Hausnummer:</label>
                                <br>
                                <input type="text" name="number" id="number" value="<?=htmlspecialchars($preloadAdress[$Index]->number)?>" required>
                            </div>
                            
                            <div class="account-adress-form-object">
                                <label for="city">Stadt:</label>
                                <br>
                                <input type="text" name="city" id="city" value="<?=htmlspecialchars($preloadAdress[$Index]->city)?>" required>
                            </div>

                            <div class="account-adress-form-object">
                                <label for="zipcode">Postleitzahl:</label>
                                <br>
                                <input type="text" name="zipCode" id="zipcode" value="<?=htmlspecialchars($preloadAdress[$Index]->zipCode)?>" required>
                            </div>
                        
                            <div class="account-adress-form-object">
                                <br>
                                <input type="submit" name="deleteAdress" value="Adresse löschen">
                            </div>

                            <div class="account-adress-form-object">
                                <br>
                                <input type="submit" name="saveAdress" value="Änderung Speichern">
                            </div>
                        </form>

                    <?php
                }
            ?>
        <?php endif;?>
        <form class="account-adress-form" method="post">
            
            <div class="account-adress-form-object" style="width: 12rem;">
                <h4>
                    Neue <br> Adresse <br> anlegen
                </h4>
            </div>

            <div  class="account-adress-form-object">
                <label for="street">Strase:</label>
                <br>
                <input type="text" name="street" id="street" placeholder="Musterstrasse" required>
            </div>

            <div class="account-adress-form-object">
                <label for="number">Hausnummer:</label>
                <br>
                <input type="text" name="number" id="number" placeholder="0" required>
            </div>

            <div class="account-adress-form-object">
                <label for="city">Stadt:</label>
                <br>
                <input type="text" name="city" id="city" placeholder="Musterstadt" required>
            </div>
            
            <div class="account-adress-form-object">
                <label for="zipCode">Postleitzahl:</label>
                <br>
                <input type="text" name="zipCode" id="zipCode" placeholder="12345" required>
            </div>
            
            <div class="account-adress-form-object">
                <br>
                <input type="submit" name="saveAdress" value="Neue Adresse anlegen">
            </div>

        </form>


    </div>


<h2>Bestellungen</h2>

<?php
    foreach ($preloadOrders as $order)
    {
        ?>
            <!-- BestellungStart -->
                <form class="account-orderlist-body" method="post">
                    <div class="account-orderlist-order">
                        <!-- TODO: schlechten Stil bei Datum (input) ändern -->
                        Bestellnummer <?=htmlspecialchars($order['orderId'])?> vom <input style="border: none; font-family: sans-serif; font-size: 1rem;" type="date" value="<?=htmlspecialchars($order['orderDate'])?>" readonly> 
                        <div class="account-order-box">
                            <div class="account-order-subbox">
                                <p>Lieferadresse: <p>
                                <p class = "text"><?=htmlspecialchars($order['adress']->street) . " " . htmlspecialchars($order['adress']->number)?></p>
                                <p class = "text"><?=htmlspecialchars($order['adress']->zipCode) . " " . htmlspecialchars($order['adress']->city)?></p>
                            </div>
                            <div class="account-order-subbox">
                                <!-- TODO: bessere ausrichtung (CSS) TODO nicht Tabelle, sondern Flexbox -->
                                <h4>Bestellte Produkte</h4>
                                <?php
                                foreach ($order['orderItems'] as $product) 
                                {
                                ?>
                                <div class = "order-element">
                                    <a class = "left"><?=htmlspecialchars($product['quantity'])?>  <?=htmlspecialchars($product['products']->description)?></a>
                                    <a class = "right"><?=htmlspecialchars($product['products']->price * $product['quantity'])?> €</a>
                                </div>
                                <?php 
                                 }
                                ?>
                        </div>
                            
                            <div class="account-order-subbox">
                                <input style="display:none;" type="text" name="orderId" value="<?=htmlspecialchars($order['orderId'])?>" readonly required>
                                <br>
                                <a class = "left">Gesamtpreis</a>
                                <a class= "right"><?=$order['totalPrice']?> €</a>
                                <br>
                                <input type="submit" name="repeatOrder" value="Erneut Bestellen">
                            </div>
                        </div>
                    </div>
                </form>
            <!-- BestellungEnde -->
        <?php
    }
?>

</div> 
