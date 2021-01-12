
    <div class="logsing-body">
        <div class="error">
            <!-- Hier PHP fuer ErrorMessage inefuegen -->
        </div>
        <div class="logsign-boxes">
            <div class="login-box">
                <h2>LogIn</h2>
                <form action="LogInSignIn.html" method="POST">

                    <label for="email">E-Mail</label>
                    <br>
                    <input type="email" name="loginEmail" id="email" placeholder="meine@email.de">
                    <br>
                    <label for="password">Passwort</label>
                    
                    <br>
                    <input type="password" name="loginPassword" id="password" placeholder="Geheimes Passwort">
                    <br>
                    <input type="submit" name="login" value="LogIn">
                    <!-- PHP
                        if(isset($_POST['login']))...doStuff -->
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
