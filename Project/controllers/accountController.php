<?php

namespace dwp\controller;

class AccountController extends \dwp\core\Controller
{
    public function actionAccount()
	{
        if(!$this->loggedIn())
        {
            header("Location: index.php?c=account&a=LogInSignIn");
        }

        if(isset($_POST['logout']))
        {   
            $_SESSION['loggedIn'] = false;
            header("Location: index.php?c=account&a=LogInSignIn");
        }

		// if($this->loggedIn())
		// {
		// 	// TODO: Retrieve account which is logged in
			
		// 	// TODO: Set the correct name of the current user here
		// 	$this->setParam('name', 'unkown');

		// 	// TODO: retrieve and set the marks of the current user
		// 	$this->setParam('marks', []);

		// }
		// else
		// {
		// 	header('Location: index.php?c=account&a=LogInSignIn');
		// }

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
                    $newAccount->save($errors);
                    if(count($errors) === 0)
                    {
                        //SUCCESS
                        $preload['logEmail'] = $email;
                        $success['success'] = true;
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