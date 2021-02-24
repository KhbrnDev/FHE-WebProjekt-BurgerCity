
<div class="logsing-body">
            <?php   if($success['success'] === true): ?>
                        <div class="logsing-success-message">
                            <?=$success['message']?>
                        </div>
                        <?php elseif(isset($errors) && count($errors) > 0): ?>

                        <div id="errors" class="logsing-error-message">
                            <h4 id="errorTitle"><?=$errors['title']?></h4>
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

    <!-- Needed for JS -->
    <div style="display:none;" class="logsing-success-message" id="js-success">
        <h4 id="js-success-head">
        
        </h4>
    </div>
    <div style="display:none;" class="logsing-error-message" id="js-errors">
        <h4 id="js-errors-head">
            
        </h4>
        <ul id="js-errors-ul">
            
        </ul>
    </div>    

    <!-- End Needed for JS -->
    <div class="logsign-boxes">
        <div class="login-box">
            <h2>LogIn</h2>
            <form method="POST">

                <label for="login-email">E-Mail</label>
                <br>
                <input type="email" name="email" id="login-email" placeholder="meine@email.de" value="<?=isset($preload['logEmail']) ? htmlspecialchars($preload['logEmail']) : ""?>">
                
                <br>
                <label for="login-password">Passwort</label>
                <br>
                <input type="password" name="password" id="login-password" placeholder="Geheimes Passwort">
                
                <br>
                <input class="submit" type="submit" id="login" name="login" value="LogIn">

            </form>
        </div> 

        <div class="signin-box">
            <h2>SignIn</h2>
            <form method="POST" id="signinForm">
                
                <p style="display:none" id="wrongFirstName"></p>
                <label for="firstname">Vorname</label>
                <br>
                <input type="text" name="firstname" id="firstname" placeholder="Rainer" value="<?=isset($preload['firstname']) ? htmlspecialchars($preload['firstname']) : "" ?>">
                <br>

                <p style="display:none"  id="wrongLastName"></p>
                <label for="lastname">Nachname</label>
                <br>
                <input type="text" name="lastname" id="lastname" placeholder="Zufall" value="<?=isset($preload['lastname']) ? htmlspecialchars($preload['lastname']) : "" ?>">
                <br>

                <p style="display:none"  id="wrongBirthday"></p>
                <label for="birthday">Geburtsdatum</label>
                <br>
                <input type="date" name="birthday" id="birthday"  value="<?=isset($preload['birthday']) ? htmlspecialchars($preload['birthday']) : "" ?>">
                <br>

                <p style="display:none"  id="wrongPhoneNumber"></p>
                <label for="phonenumber">Telefon</label>
                <br>
                <input type="tel" name="phonenumber" id="phonenumber" value="<?=isset($preload['phoneNumber']) ? htmlspecialchars($preload['phoneNumber']) : "" ?>">
                <br>

                <p style="display:none"  id="wrongEMail"></p>
                <label for="email">E-Mail</label>
                <br>
                <input type="email" name="email" id="email" placeholder="r.zufall@mail.de" value="<?=isset($preload['email']) ? htmlspecialchars($preload['email']) : "" ?>">
                <br>

                <p  style="display:none" id="wrongPassword"></p>
                <label for="password">Passwort</label>
                <br>
                <input type="password" name="password" id="password">
                <br>
                
                <input class="submit" type="submit" name="signin" id="signin" value="SignIn" >


            </form>
        </div>
    </div>
</div>
<script src="<?=JAVASCRIPTPATH."signin.js"?>"></script>
<script src="<?=JAVASCRIPTPATH."login.js"?>"></script>
<script src="<?=JAVASCRIPTPATH."register.js"?>"></script>
