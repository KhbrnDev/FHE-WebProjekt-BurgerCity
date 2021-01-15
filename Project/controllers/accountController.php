<?php

namespace dwp\controller;

class AccountController extends \dwp\core\Controller
{
    public function actionAccount()
	{
        if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] !== true)
        {
            header("Location: index.php?c=account&a=LogInSignIn");
        }

        if(isset($_POST['logout']))
        {   
            echo"tes";
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
        $errors = [];
        $success['success'] = false;

        // oh my good, we get data
        
        //$_SESSION['loggedIn'] = false; //Test,LÖSCH MICH PLEASE <3

        if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === true)
        {
            header("Location: index.php?c=account&a=account");
        }
        else
        {

            if(isset($_POST['signin']))
            {
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

                // Validate Birthday
                if($birthday === null)
                {
                
                    $errors[] = 'Geburtsdatum fehlt.';
                }

                // check errors?
                if(count($errors) === 0)
                {
                    $db = $GLOBALS['db']; 
                    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                    
                    //$email = $db->quote($email);
                    $passwordHash = $db->quote($passwordHash);
                    $firstname = $db->quote($firstname);
                    $lastname = $db->quote($lastname);
                    $birthday = $db->quote($birthday);
                    $phonenumber = $db->quote($phonenumber);

                    $paramsAccount = [
                        'email' => $db->quote($email),
                        'passwordHash' => $passwordHash,
                        'firstName' => $firstname,
                        'lastName' => $lastname,
                        'birthday' => $birthday,
                        'phoneNumber' => $phonenumber
                    ];

                    $newAccount = new \dwp\model\Account($paramsAccount);
                    $newAccount->save();

                    // TODO: save to database
                    if( true ) // fake true because no db connected yet
                    {
                        $success['email'] = $email;
                        $success['success'] = true;
                    }
                }
            

            }
            elseif (isset($_POST['login'])) 
            {
                $email = ($_POST['email']) ? $_POST['email']: null;
                $password = ($_POST['password']) ? $_POST['password'] : null;
                
                $emailQuote = $GLOBALS['db']->quote($email);
                $Account = \dwp\model\Account::findOne("´email´ = " . $emailQuote);
                //Test -> PLEASE DELETE ME <3
                    $Account['email'] = $email;
                    $Account['passwordHash'] = password_hash($password, PASSWORD_DEFAULT);
                	$Account['accountId'] = 'test';
                // ENDE
                if(!empty($email) && !empty($password))
                {

                    if(!empty($Account['email']))
                    {
                        if(password_verify($password, $Account['passwordHash']))
                        {
                            // EMail und Passwort stimmen
                            $_SESSION['loggedIn'] = true;
                            // WILL MAN WISSSEN WER EINGELOGGT IST?
                            //$_SESSION['userMail'] = $Account['email'];
                            //$_SESSION['userID'] = $Account['accountId'];
                            header("Location: index.php?c=account&a=account");
                        }
                        else
                        {
                            $errors [] = 'EMail und Passwort passen nicht zueinander.';
                        }
                    }
                    else
                    {
                        $errors [] = 'EMail und Passwort passen nicht zueinander.';
                    }
                }
                else
                {
                    $errors [] = 'Bitte valide Email und Passwort eingeben.';
                }

            } 
        }
            // push to view ;)
            $this->setParam('errors', $errors);
            $this->setParam('success', $success);
            //header("index.php?c=account&a=LogInSignIn");
    }
}