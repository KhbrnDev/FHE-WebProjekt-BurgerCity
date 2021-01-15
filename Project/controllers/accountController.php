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
	public function actionLogInSignIn(){
        $errors = [];
        $success = false;

        // oh my good, we get data
        
        if(isset($_POST['signin']))
        {
            $firstname = ($_POST['firstname']) ? $_POST['firstname']: null;
            $lastname = ($_POST['lastname']) ? $_POST['lastname']: null;
            $birthday = ($_POST['birthday']) ? $_POST['birthday']: null;
            $phonenumber = ($_POST['phonenumber']) ? $_POST['phonenumber']: null;
            $email = ($_POST['email']) ? $_POST['email']: null;
            $password = ($_POST['password']) ? $_POST['password']: null;

            if($firstname === null)
            {
                $errors['firstname'] = 'Vorname fehlt.';
            }

            if($lastname === null)
            {
                $errors['lastname'] = 'Nachname fehlt.';
            }

            if($birthday === null)
            {
               
                $errors['birthday'] = 'Geburtsdatum fehlt.';
            }

            if($phonenumber === null)
            {
                $errors['phonenumber'] = 'Telefonnummer fehlt.';
            }

            if($email === null)
            {
                //TODO check if email is an email
                $errors['email'] = 'Email fehlt.';
            }
            

            if($password === null || mb_strlen($password) < 8)
            //Regex für Passwortrichtlinien
            {
                $errors['password'] = 'Passwort ist zu kurz, bitte mehr als 8 Zeichen.';
            }

            // check errors?
            if(count($errors) === 0)
            {
                // TODO: save to database
                if( true ) // fake true because no db connected yet
                {
                    $success = true;
                }
            }
        }

        // push to view ;)
        $this->setParam('errors', $errors);
        $this->setParam('success', $success);
        //header("index.php?c=account&a=LogInSignIn");
    }
}