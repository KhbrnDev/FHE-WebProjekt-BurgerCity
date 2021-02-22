
<div class="administration-body">
        <form method="post">
            <input class="submit" type="submit" name="logout" value="Logout">
        </form>
    <div class="administration-header">
        <h1>Administrations Panel</h1>
        <h3>Diese Seite ist nicht für mobile Geräte ausgelegt. 
            <br>
            Bitte verwenden Sie für die Administration immer ein Desktop Gerät.
        </h3>
    </div>
    <!-- <div class="error"> -->
            <!-- Hier PHP fuer ErrorMessage inefuegen -->
            <?php   if($success['success'] === true): ?>
                        <div class="logsing-success-message">
                            <?=$success['message']?>
                        </div>
            <?php elseif(isset($errors) && count($errors) > 0): ?>

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
            <?php endif; ?>

    <div class="administration-admins">
        <h2><label for="remove-admin">Administratoren bearbeiten</label></h2>
        
        <input class="make-admin-checkbox" id="remove-admin" type="checkbox">
        <table>
            <thead>
                <tr>
                    <td>Vorname</td>
                    <td>Nachname</td>
                    <td>EMail</td>
                    <td>Geburtsdatum</td>
                    <td>Telefonnummer</td>
                    <td>Administratives</td>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach($preloadAdmins as $admins)
                    {
                        ?>
                            <tr>
                                <td><?=htmlspecialchars($admins->firstName)?></td>
                                <td><?=htmlspecialchars($admins->lastName)?></td>
                                <td><?=htmlspecialchars($admins->email)?></td>
                                <td><?=htmlspecialchars(getGermanDate($admins->birthday))?></td>
                                <td><?=htmlspecialchars($admins->phoneNumber)?></td>
                                <td>
                                    <form method="POST">
                                        <input class="admins-id" type="text" name="accountId" value="<?=$admins->accountId?>">
                                        <input type="submit" name="deleteAdmin" value="Admin entfernen">
                                    </form>
                                </td>
                            </tr>
                        <?php
                    }
                    ?> 
            </tbody>
        </table>
        
        
            
    </div>

    <div class="make-admin">
        <h2><label for="make-admin">Kunden zu Administratoren machen</label></h2>
        <input class="make-admin-checkbox" id="make-admin" type="checkbox">
        <table>
            <thead>
                <tr>
                    <td>Vorname</td>
                    <td>Nachname</td>
                    <td>EMail</td>
                    <td>Geburtsdatum</td>
                    <td>Telefonnummer</td>
                    <td>Administratives</td>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach($preloadCustomers as $admins)
                    {
                        ?>
                            <tr>
                                <td class="admins-id"><?=$admins->accountId?></td>
                                <td><?=htmlspecialchars($admins->firstName)?></td>
                                <td><?=htmlspecialchars($admins->lastName)?></td>
                                <td><?=htmlspecialchars($admins->email)?></td>
                                <td><?=htmlspecialchars(getGermanDate($admins->birthday))?></td>
                                <td><?=htmlspecialchars($admins->phoneNumber)?></td>
                                <td>
                                    <form method="POST">
                                        <input class="admins-id" type="text" name="accountId" value="<?=$admins->accountId?>">
                                        <input type="submit" name="makeAdmin" value="zu Admin machen">
                                    </form>
                                </td>
                            </tr>
                        <?php
                    }
                    ?> 
            </tbody>
        </table>
    
    </div>

    <div class="edit-products">
        <h2><label for="edit-products">Produkte bearbeiten</label></h2>
        <input type="checkbox" class="make-admin-checkbox" id="edit-products">
        
        <table>
            <thead>
                <td>Kategory</td>
                <td>Produktname</td>
                <td>Bild-URL</td>
                <td>AlternativText</td>
                <td>Preis</td>
                <td>Administratives</td>
            </thead>
            
            <tbody>
                <?php
                foreach($preloadProducts as $product):
                ?>
                    <tr>
                        <td><?=htmlspecialchars($product->category)?></td>
                        <td><?=htmlspecialchars($product->description)?></td>
                        <td><?=htmlspecialchars($product->pictureURL)?></td>
                        <td><?=htmlspecialchars($product->altText)?></td>
                        <td><?=htmlspecialchars($product->price)?></td>
                        <td>
                            <form method="POST">
                                
                                <input class="admins-id" type="text" name="productsId" value="<?=$products->productsId?>">
                                <input type="submit" name="changeFavorite" value="<?=($product->favorites == 0) ? 'Favorisieren' : 'ent Favorisieren' ?>">
                            </form>
                        </td>
                    </tr>
                <?php
                endforeach;
                ?>
            </tbody>
        </table>
    </div>
        
</div>
    
    
