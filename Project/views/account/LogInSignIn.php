<?php if($success === true) : ?>
    <div class="success-message">
        Vielen Dank, für dein Konto! Sie werden automatisch auf die Login-Seite weitergeleitet.
        <meta http-equiv="refresh" content="5; URL=index.php?c=account&a=LogInSignIn">
    </div>

<?php else : ?>
    <div class="form-wrapper">
        <?php if(isset($errors) && count($errors) > 0) : ?>
            <div class="error-message" style="border: 1px dotted red; padding: 15px;">
                <ul>
                    <?php foreach($errors as $key => $value) : ?>
                        <li><?=$value?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; // errors show ?>

    <div class="logsing-body">
        
        <!-- <div class="error"> -->
            <!-- Hier PHP fuer ErrorMessage inefuegen -->
        <!-- </div> -->
        <div class="logsign-boxes">
            <div class="login-box">
                <h2>LogIn</h2>
                <form  action="LogInSignIn.html" method="POST">

                    <label for="email">E-Mail</label>
                    <br>
                    <input type="email" name="loginEmail" id="email" placeholder="meine@email.de">
                   
                    <br>
                    <label for="password">Passwort</label>
                    <br>
                    <input type="password" name="loginPassword" id="password" placeholder="Geheimes Passwort">
                    
                    <br>
                    <input type="submit" name="login" value="LogIn">

                </form>
            </div> 

            <div class="signin-box">
                <h2>SignIn</h2>
                <form method="POST">
                    
                    <label for="firstname">Vorname</label>
                    <br>
                    <input type="text" name="firstname" id="firstname" placeholder="Rainer">
                    <br>

                    <label for="lastname">Nachname</label>
                    <br>
                    <input type="text" name="lastname" id="lastname" placeholder="Zufall">
                    <br>

                    <label for="birthday">Geburtsdatum</label>
                    <br>
                    <input type="date" name="birthday" id="birthday">
                    <br>

                    <label for="phonenumber">Telefon</label>
                    <br>
                    <input type="tel" name="phonenumber" id="phonenumber">
                    <br>

                    <label for="email">E-Mail</label>
                    <br>
                    <input type="email" name="email" id="email" placeholder="r.zufall@mail.de">
                    <br>

                    <label for="password">Passwort</label>
                    <br>
                    <input type="password" name="password" id="password">
                    <br>
                    
                    <input type="submit" name="signin" value="SignIn" >

                    <!-- PHP
                        if(isset($_POST['signin']))...doStuff -->
                </form>
            </div>
        </div>
    </div>
    </div>
<?php endif; ?>
