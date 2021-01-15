<?php

namespace dwp\controller;

class AccountController extends \dwp\core\Controller
{
    public function actionAccount()
	{


		if($this->loggedIn())
		{
			// TODO: Retrieve account which is logged in
			
			// TODO: Set the correct name of the current user here
			$this->setParam('name', 'unkown');

			// TODO: retrieve and set the marks of the current user
			$this->setParam('marks', []);

		}
		else
		{
			header('Location: index.php?c=account&a=LogInSignIn');
		}

    }
    
    public function actionLogInSignIn()
    {
        $errors = [];
        $success['success'] = false;

        // oh my good, we get data
        
        if(isset($_POST['signin']))
        {
            $firstname = ($_POST['firstname']) ? $_POST['firstname']: null;
            $lastname = ($_POST['lastname']) ? $_POST['lastname']: null;
            $birthday = ($_POST['birthday']) ? $_POST['birthday']: null;
            $phonenumber = ($_POST['phonenumber']) ? $_POST['phonenumber']: null;
            $email = ($_POST['email']) ? $_POST['email']: null;
            $password = ($_POST['password']) ? $_POST['password']: null;

            // Validate Firstname
            if($firstname === null || strlen($firstname) < 2)
            {
                $errors[] = 'Vorname fehlt.';
            }

            if(strlen($firstname) < 2)
            {
                $errors[] = 'Vorname mindestens 2 Zeichen haben.';
            }

            if(!preg_match("/^[a-zA-Z-' 'ä'ü'ö'ß'Ä'Ü'Ö]*$/", $firstname))
            {
                $errors[] = 'Vornamen bitte mit Buchstaben a-z, ä, ü, ö in groß und kleinschreibung sowie ß, - ,  Leerzeichen angeben.';
            }

            // Validate Lastname
            if($lastname === null)
            {
                $errors[] = 'Nachname fehlt.';
            }

            if(strlen($lastname) < 2)
            {
                $errors[] = 'Nachname mindestens 2 Zeichen haben.';
            }

            if(!preg_match("/^[a-zA-Z-' 'ä'ü'ö'ß'Ä'Ü'Ö]*$/", $lastname))
            {
                $errors[] = 'Nachnamen bitte mit Buchstaben a-z, ä, ü, ö in groß und kleinschreibung sowie ß, - ,  Leerzeichen angeben.';
            }

            // Validate Birthday
            if($birthday === null)
            {
               
                $errors[] = 'Geburtsdatum fehlt.';
            }

            // Validate PhoneNumber
            if($phonenumber === null)
            {
                $errors[] = 'Telefonnummer fehlt.';
            }

            if(!preg_match("/^[0-9]*$/", $phonenumber))
            {
                $errors[] = 'Telefonnummer bitte nur mit Zahlen angeben';
            }

            // Validate EMail
            if($email === null)
            {
                $errors[] = 'Email fehlt.';
            }

            if(!filter_var($email, FILTER_VALIDATE_EMAIL))
            {
                $errors[] = 'EMail nicht valide.';
            }
            
            /**
             * TODO : if EMail exists mit findOne
             */



            // Validate Password
            if($password === null)
            {
                $errors[] = 'Kein Passwort angegeben';
            }
            
            if(!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/", $password))
            {
                $errors[] = 'Password enthält nicht mindestens 1 Großbuchstaben, 1 Kleinbuchstaben und 1 Zahl oder hat weniger als 8 Zeichen.';
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

        // push to view ;)
        $this->setParam('errors', $errors);
        $this->setParam('success', $success);
        //header("index.php?c=account&a=LogInSignIn");

    }
}