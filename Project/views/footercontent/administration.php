
<div class="administration-body">
    <h1>Administrations Panel</h1>
    <h3>Diese Seite ist nicht für mobile Geräte ausgelegt. 
        Bitte verwenden Sie einen Desktop Gerät.
    </h3>

    <div class="administration-admins">
        <form method="post"><input type="submit" name="logout" value="Logout"></form>
        <h2>Administratoren bearbeiten</h2>
                <!-- Adminstrator bearbeiten
                Administrator löschen
            Administrator als Adminstrator entfernen -->

        <table>
            <thead>
                <tr>
                    <td>Vorname</td>
                    <td>Nachname</td>
                    <td>EMail</td>
                    <td>Geburtsdatum</td>
                    <td>Telefonnummer</td>
                    <td>Adresse</td>
                    <td>Administratives</td>
                </tr>
            </thead>
            <tbody>
                <?php
                    for($Index = 0; $Index <4; $Index++)
                    {
                        ?>
                            <tr>
                                <td>Rainer</td>
                                <td>Zufall</td>
                                <td>r.zufall@burger-city.de</td>
                                <td>01.01.2020</td>
                                <td>03455607080</td>
                                <td>Sundhäuserstrasse 34 55122 Mainz</td>
                                <td>
                                    <input type="submit" name="edit" value="Änderungen speichern">
                                    <input type="submit" name="delete" value="Admin löschen">
                                </td>
                            </tr>
                        <?php
                    }
                    ?> 
            </tbody>
        </table>
        
        <div class="administration-new-admin">
            <div class="new-admin-input-label">

                <label for="firstname">Vorname</label>
                <br>
                <input type="text" name="firstname" id="firstname" placeholder="Vorname" requiered>
            </div>
            
            <div class="new-admin-input-label">

                <label for="lastname">Nachname</label>
                <br>
                <input type="text" name="lastname" id="lastname" placeholder="Nachname" requiered>
            </div>
            
            <div class="new-admin-input-label">

                <label for="email">EMail</label>
                <br>
                <input type="email" name="email" id="email" placeholder="EMail-Adresse" required>
            </div>
            
            
            <div class="new-admin-input-label">

                <label for="birtday">Geburtsdatum</label>
                <br>
                <input type="date" name="birthday" id="birthday" placeholder="2020-01-01" required>
            </div>

            
            <div class="new-admin-input-label">
                <label for="phonenumber">Telefonnummer</label>
                <br>
                <input type="tel" name="phonenumber" id="phonenumber" placeholder="01522203050" required>
            </div>  
            
            
            <div class="new-admin-input-label">
                    <!-- Strasse -->
            </div>

            
            <div class="new-admin-input-label">
                <!-- Hausnuzmmeer -->
            </div>

            
            <div class="new-admin-input-label">
                <!-- PLZ -->
            </div>

            
            <div class="new-admin-input-label">
                <!-- Stadt -->
            </div>
            
            <div class="new-admin-input-label">
                <!-- Passwort -->
            </div>
        </div>
            
    </div>
        
</div>
    
    
