
    <div class="logsing-body">
        
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
        <div class="logsign-boxes">
            <div class="login-box">
                <h2>LogIn</h2>
                <form method="POST">

                    <label for="email">E-Mail</label>
                    <br>
                    <input type="email" name="email" id="email" placeholder="meine@email.de"
                        <?php if(isset($preload['logEmail']))
                        {
                            ?>
                            value="<?=$preload['logEmail']?>"
                            <?php
                        }
                        ?>
                    >
                   
                    <br>
                    <label for="password">Passwort</label>
                    <br>
                    <input type="password" name="password" id="password" placeholder="Geheimes Passwort">
                    
                    <br>
                    <input type="submit" name="login" value="LogIn">

                </form>
            </div> 

            <div class="signin-box">
                <h2>SignIn</h2>
                <form method="POST">
                    
                    <label for="firstname">Vorname</label>
                    <br>
                    <input type="text" name="firstname" id="firstname" placeholder="Rainer"
                        <?php if(isset($preload['firstname'])): ?>
                            value="<?=$preload['firstname']?>"
                        <?php endif; ?>
                    >
                    <br>

                    <label for="lastname">Nachname</label>
                    <br>
                    <input type="text" name="lastname" id="lastname" placeholder="Zufall"
                        <?php if(isset($preload['lastname'])): ?>
                            value="<?=$preload['lastname']?>"
                        <?php endif; ?>
                    >
                    <br>

                    <label for="birthday">Geburtsdatum</label>
                    <br>
                    <input type="date" name="birthday" id="birthday" 
                        <?php if(isset($preload['birthday'])): ?>
                            value="<?=$preload['birthday']?>"
                        <?php endif; ?>
                    >
                    <br>

                    <label for="phonenumber">Telefon</label>
                    <br>
                    <input type="tel" name="phonenumber" id="phonenumber"
                        <?php if(isset($preload['phoneNumber'])): ?>
                            value="<?=$preload['phoneNumber']?>"
                        <?php endif; ?>
                    >
                    <br>

                    <label for="email">E-Mail</label>
                    <br>
                    <input type="email" name="email" id="email" placeholder="r.zufall@mail.de"
                        <?php if(isset($preload['email'])): ?>
                            value="<?=$preload['email']?>"
                        <?php endif; ?>
                    >
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
