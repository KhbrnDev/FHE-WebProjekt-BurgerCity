<?php

namespace dwp\controller;

class AccountController extends \dwp\core\Controller
{
    public function actionAccount()
	{
        // INITIALIZE VIEW->PARAMS 
        $errors = [];
        $preloadUser = [];
        $preloadAdress = [];
        $preloadOrders = [];
        $success['success'] = false;

        if(!$this->loggedIn())
        {
            header("Location: index.php?c=account&a=LogInSignIn");
        }

        if(isset($_POST['logout']))
        {   
            $_SESSION['loggedIn'] = false;
            header("Location: index.php?c=account&a=LogInSignIn");
        }

        

        if(isset($_POST['changeAccount']))
        {
            // GET DATA
            $firstname = ($_POST['firstname']) ? $_POST['firstname']: null;
            $lastname = ($_POST['lastname']) ? $_POST['lastname']: null;
            $birthday = ($_POST['birthday']) ? $_POST['birthday']: null;
            $email = ($_POST['email']) ? $_POST['email']: null;
            $phonenumber = ($_POST['phoneNumber']) ? $_POST['phoneNumber']: null;

            // VALIDATE INPUT
            \dwp\model\Account::validateFirstName($firstname, $errors);
            \dwp\model\Account::validateLastName($lastname, $errors);
            \dwp\model\Account::validateBirthday($birthday, $errors);
            \dwp\model\Account::validateEmail($email, $errors);
            \dwp\model\Account::validatePhoneNumber($phonenumber, $errors);

            $user = \dwp\model\Account::findOne('accountId = ' . $_SESSION['userID']);

            if (   $firstname === $user->firstName
                && $lastname === $user->lastName
                && $birthday === $user->bithday
                && $email === $user->email
                && $phonenumber === $user->phoneNumber)
            {
                $success['success'] = false;
                $errors [] = 'Keine Accountänderung';
            }

            // check errors?
            if(count($errors) === 0)
            {
                $db = $GLOBALS['db']; 
                
                $user->firstName = $firstname;
                $user->lastName = $lastname;
                $user->email = $email;
                $user->phoneNumber = $phonenumber;
                $user->bithday = $birthday;

                $user->update($errors);

                if(count($errors) === 0)
                {
                    //SUCCESS
                    $success['success'] = true;
                    $success['message'] = 'Accountänderung erfolgreich';
                }
                else
                {
                    // FAILURE
                $success['success'] = false;
                $errors['title'] = 'Accountänderung fehlgeschlagen';
                }
              
            }
            else
            {
                // FAILURE
                $success['success'] = false;
                $errors['title'] = 'Accountänderung fehlgeschlagen';

            }

            // why do I exist?
            if(count($errors) === 0)
            {

            }

        }
        elseif (isset($_POST['changePassword'])) 
        {
            
            // GET DATA
            $curentPassword = ($_POST['currentPassword']) ? $_POST['currentPassword']: null;
            $newPassword    = ($_POST['newPassword']) ? $_POST['newPassword']: null;
            

            // VALIDATE INPUT
            \dwp\model\Account::validatePassword($newPassword, $errors);

            $user = \dwp\model\Account::findOne('accountId = ' . $_SESSION['userID']);
            if(!password_verify($curentPassword, $user->passwordHash) || $curentPassword !== $newPassword)
            {
                $errors [] = 'Aktuelles Passwort ist nicht korrekt oder ist das gleiche wie das neue.';
            }
            

            // check errors?
            if(count($errors) === 0)
            {
                $db = $GLOBALS['db'];
                $passwordHash = password_hash($newPassword, PASSWORD_DEFAULT);

                $user->passwordHash = $passwordHash;
                $user->save($errors);
                if(count($errors) === 0)
                {
                    //SUCCESS
                    $success['success'] = true;
                    $success['message'] = 'Passwortänderung erfolgreich';
                }
                else
                {
                    // FAILURE
                $success['success'] = false;
                $errors['title'] = 'Passwortänderung fehlgeschlagen';
                }
              
            }
            else
            {
                // FAILURE
                $success['success'] = false;
                $errors['title'] = 'Passwortänderung fehlgeschlagen';

            }

        }
        elseif (isset($_POST['saveAdress']))
        {
            echo "saveAdress";

        }
        elseif (isset($_POST['deleteAdress']))
        {
            echo "deleteAdress";
        }
        elseif (isset($_POST['repeatOrder']))
        {
            echo "repeatOrder";
        }
        

        // PRELOAD DATA
        // Preload User->Account
        $user = \dwp\model\Account::findOne("`accountId` = " . $_SESSION['userID']);
        $preloadUser['firstname'] = $user->firstName;
        $preloadUser['lastname'] = $user->lastName;
        $preloadUser['birthday'] = $user->bithday;
        $preloadUser['email'] = $user->email;
        $preloadUser['phoneNumber'] = $user->phoneNumber;


        // Preload User->Adress
        /**
          Do Stuff here
          
         */


        // Preload User->Orders
        /**
          Do Stuff here
          
         */


        // PUSH TO VIEW
        $this->setParam('errors', $errors);
        $this->setParam('preloadUser', $preloadUser);
        $this->setParam('preloadAdress', $preloadAdress);
        $this->setParam('preloadOrders', $preloadOrders);
        $this->setParam('success', $success);

    }
    
    public function actionLogInSignIn()
    {
        $preload = [];
        $errors = [];
        $success['success'] = false;


        if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === true)
        {
            header("Location: index.php?c=account&a=account");
        }
        else
        {

            if(isset($_POST['signin']))
            {
                // GET ALL INPUT
                $firstname = ($_POST['firstname']) ? $_POST['firstname']: null;
                $lastname = ($_POST['lastname']) ? $_POST['lastname']: null;
                $birthday = ($_POST['birthday']) ? $_POST['birthday']: null;
                $phonenumber = ($_POST['phonenumber']) ? $_POST['phonenumber']: null;
                $email = ($_POST['email']) ? $_POST['email']: null;
                $password = ($_POST['password']) ? $_POST['password']: null;
                
                // VALIDATE INPUT
                \dwp\model\Account::validateFirstName($firstname, $errors);
                \dwp\model\Account::validateLastName($lastname, $errors);
                \dwp\model\Account::validatePhoneNumber($phonenumber, $errors);
                \dwp\model\Account::validateEmail($email, $errors);
                \dwp\model\Account::validatePassword($password, $errors);
                \dwp\model\Account::validateBirthday($birthday, $errors);
                
                // check if email already has an account
                $existingEmail = \dwp\model\Account::find("`email` = " . $GLOBALS['db']->quote($email));
                if(count($existingEmail) !== 0)
                {
                    $errors [] = 'Ein Account mit dieser EMail existiert bereits.';
                }
            

                // check errors?
                if(count($errors) === 0)
                {
                    $db = $GLOBALS['db']; 
                    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

                    $paramsAccount = [
                        'email' => $email,
                        'passwordHash' => $passwordHash,
                        'firstName' => $firstname,
                        'lastName' => $lastname,
                        'bithday' => $birthday,
                        'phoneNumber' => $phonenumber,
                        'isAdmin' => 0
                    ];

                    $newAccount = new \dwp\model\Account($paramsAccount);
                    $newAccount->insert($errors);
                    if(count($errors) === 0)
                    {
                        //SUCCESS
                        $preload['logEmail'] = $email;
                        $success['success'] = true;
                        $success['message'] = 'Registrierung erfolgreich. Sie können sich jetzt anmelden.';
                    }
                    else
                    {
                        // FAILURE
                    $success['success'] = false;
                    $errors['title'] = 'SignIn Fehlgeschlagen';

                    $preload['firstname'] = $firstname;
                    $preload['lastname'] = $lastname;
                    $preload['birthday'] = $birthday;
                    $preload['phoneNumber'] = $phonenumber;
                    $preload['email'] = $email;
                    }
                  
                }
                else
                {
                    // FAILURE
                    $success['success'] = false;
                    $errors['title'] = 'SignIn Fehlgeschlagen';

                    $preload['firstname'] = $firstname;
                    $preload['lastname'] = $lastname;
                    $preload['birthday'] = $birthday;
                    $preload['phoneNumber'] = $phonenumber;
                    $preload['email'] = $email;

                }
            

            }
            elseif (isset($_POST['login'])) 
            {
                // RETRIEVE DATA
                $email = ($_POST['email']) ? $_POST['email']: null;
                $password = ($_POST['password']) ? $_POST['password'] : null;

                // VALIDATE EMAIL AND PASSWORD
                if(!empty($email) && !empty($password))
                {
                    $emailQuote = $GLOBALS['db']->quote($email);
                    $Account = \dwp\model\Account::findOne("email = " . $emailQuote);

                    if($Account !== null)
                    {
                        if(password_verify($password, $Account->passwordHash))
                        {
                            // EMail und Passwort stimmen
                            $_SESSION['loggedIn'] = true;
                            $_SESSION['userMail'] = $Account->email;
                            $_SESSION['userID'] = $Account->accountId;
                            header("Location: index.php?c=account&a=account");
                        }
                        else
                        {
                            
                            $errors['title'] = 'LogIn Fehlgeschlagen';
                            $errors [] = 'EMail und Passwort passen nicht zueinander.';
                            $preload['logEmail'] = $email;
                        }
                    }
                    else
                    {   
                        $errors['title'] = 'LogIn Fehlgeschlagen';
                        $errors [] = 'EMail und Passwort passen nicht zueinander.';
                        $preload['logEmail'] = $email;
                    }
                }
                else
                {   
                    $errors['title'] = 'LogIn Fehlgeschlagen';
                    $errors [] = 'Bitte valide Email und Passwort eingeben.';
                    $preload['logEmail'] = $email;
                }

            } 
        }

            // push to view ;)
            $this->setParam('preload', $preload);
            $this->setParam('errors', $errors);
            $this->setParam('success', $success);
    }
}