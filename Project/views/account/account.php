
<div class="account-body">
    <div class="h1-ausloggen">
        <h2><form method="post">
            <input type="submit" name="logout" value="Logout">
        </form></h2>
        <h1>Willkommen <br><?=$preloadUser['firstname'] . " " . $preloadUser['lastname']?></h1>
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
                    <input type="text" id="firstname" name="firstname" value="<?=(isset($preloadUser['firstname'])) ? $preloadUser['firstname'] : ""?>" required>
                </div>
                
                <div class="account-form-object">
                    <label for="lastname">Nachname</label>
                    <br>
                    <input type="text" id="lastname" name="lastname" value="<?=(isset($preloadUser['lastname'])) ? $preloadUser['lastname'] : ""?>" required>
                </div>

                <div class="account-form-object">
                    <label for="birthday">Geburtsdatum</label>
                    <br>
                    <input type="date" id="birthday" name="birthday" value="<?=(isset($preloadUser['birthday'])) ? $preloadUser['birthday'] : ""?>" required>
                </div>

                <div class="account-form-object">
                    <label for="email">E-Mail</label>
                    <br>
                    <input type="email" id="email" name="email" value="<?=(isset($preloadUser['email'])) ? $preloadUser['email'] : ""?>" required>
                </div>

                <div class="account-form-object">
                    <label for="phoneNumber">Telefonnummer</label>
                    <br>
                    <input type="tel" id="phoneNumber" name="phoneNumber" value="<?=(isset($preloadUser['phoneNumber'])) ? $preloadUser['phoneNumber'] : ""?>" required>
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
                <input type="password" id="currentPassword" name="currentPassword" placeholder="G3H31M" required>
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
                                <input type="text" name="street" id="street" value="<?=$preloadAdress[$Index]->street?>" required>
                            </div>

                            <div class="account-adress-form-object">
                                <label for="number">Hausnummer:</label>
                                <br>
                                <input type="text" name="number" id="number" value="<?=$preloadAdress[$Index]->number?>" required>
                            </div>
                            
                            <div class="account-adress-form-object">
                                <label for="city">Stadt:</label>
                                <br>
                                <input type="text" name="city" id="city" value="<?=$preloadAdress[$Index]->city?>" required>
                            </div>

                            <div class="account-adress-form-object">
                                <label for="zipcode">Postleitzahl:</label>
                                <br>
                                <input type="text" name="zipCode" id="zipcode" value="<?=$preloadAdress[$Index]->zipCode?>" required>
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
    <!-- Für Tabelleneinträge große Kacheln programmieren, 1 pro Reihe anstatt 2 Pro Reihe bei Speisekarte -->
    <!-- <h2>Bestellungen</h2>
    <div class="account-orderlist-body">
        <table class="orderlist-table">
            <thead class="orderlist-thead">
                <td>Bestellnummer</td>
                <td>Bestelldatum</td>
                <td>Lieferadresse</td>
                <td>Produktinformationen</td>
                <td>Gesamtpreis</td>
                <td>Ernuet Wiederholen?</td>
            </thead>
            <tbody class="orderlist-tbody">
            <?php
            for($Index = 0; $Index < 4; $Index++)
            {
                ?>
                    <tr class="orderlist-trow">
                        <td>Nr: 7</td>
                        <td>20.11.2020</td>
                        <td>
                            <table>
                                <tr>Altonaerstrasese 23</tr>
                                <br>
                                <tr>99112 Erfurt</tr>
                            </table>
                        </td>
                        <td>
                            <table class="orderlist-products">
                                <thead>
                                    <td>Produkt</td>
                                    <td>Anzahl</td>
                                    <td>Preis</td>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Chilli Burger</td>
                                        <td>2</td>
                                        <td style="white-space: nowrap;">3.99 €</td>
                                    </tr>
                                    <tr>
                                        <td>ChilliCheese Nuggets</td>
                                        <td>1</td>
                                        <td>7.99 €</td>
                                    </tr>
                                    <tr>
                                        <td>Choco Shake</td>
                                        <td>2</td>
                                        <td>1.99 €</td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                        <td>19.95 €</td>
                        <td><button>Erneut Bestellen</button></td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div> -->


<h2>Bestellungen</h2>

<?php
    for($Index = 0; $Index < 5; $Index++)
    {
        ?>
            <!-- BestellungStart -->
                <div class="account-orderlist-body">
                    <div class="account-orderlist-order">
                        Bestellnummer 7017 vom 03.10.2019
                        <div class="account-order-box">
                            <div class="account-order-subbox">
                                <h4>Lieferadresse</h4>
                                <p>Altonaerstrasse 34</p>
                                <p>99122 Erfurt</p>
                            </div>
                            <div class="account-order-subbox">
                                <h4>Bestellte Produkte</h4>
                                <table class="ordered-products-table">
                                    <thead>
                                        <td>Produkt</td>
                                        <td>Anzahl</td>
                                        <td>Preis</td>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Chilli Burger</td>
                                            <td>2</td>
                                            <td style="white-space: nowrap;">3.99 €</td>
                                        </tr>
                                        <tr>
                                            <td>ChilliCheese Nuggets</td>
                                            <td>1</td>
                                            <td>7.99 €</td>
                                        </tr>
                                        <tr>
                                            <td>Choco Shake</td>
                                            <td>2</td>
                                            <td>1.99 €</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            
                            <div class="account-order-subbox">
                                <h4>Gesamtpreis</h4>
                                <p>17.98 €</p>
                                <input type="submit" name="repeatOrder" value="Erneut Bestellen">
                            </div>
                        </div>
                    </div>
                </div>
            <!-- BestellungEnde -->
        <?php
    }
?>

</div> 
