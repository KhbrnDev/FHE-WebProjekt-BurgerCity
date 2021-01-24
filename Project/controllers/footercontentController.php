<?php

namespace dwp\controller;

class footercontentController extends \dwp\core\Controller
{
    public function actionAdministration()
	{
        //TODO check if admin is logged in and has right to access administration
        // else do... nothing? Error page?


        // INITIALIZE VIEW->PARAMS 
        $errors = [];
        $preload = [];
        $success['success'] = false;

        // GENERAL PAGEMANAGEMANT
        if(!$this->loggedIn())
        {
            header("Location: index.php?c=account&a=LogInSignIn");
        }

        if(isset($_POST['logout']))
        {   
            $_SESSION['loggedIn'] = false;
            header("Location: index.php?c=account&a=LogInSignIn");
        }

        if(isset($_SESSION['isAdmin']))
        {   
            if($_SESSION['isAdmin'] !== true)
            {
                header("Location: index.php?c=account&a=LogInSignin");
            }
        }

        // DO STUFF HERe




        // PRELOAD DATA

    }

    public function actionContact()
	{
        if(isset($_POST['send'])){
            // GET ALL INPUT
            $name = ($_POST['name']) ? $_POST['name']: null;
            $email = ($_POST['email']) ? $_POST['email']: null;
            $subject = ($_POST['subject']) ? $_POST['subject']: null; 
            $message = ($_POST['message']) ? $_POST['message']: null; 

            // imagine sending an email here...

            $success['success'] = true; 
            
            header("Location: index.php?c=footercontent&a=mailSend");
        }
    }

    public function actionMailSend()
    {

    }

    public function actionImpressum()
	{

    }

    public function actionDocumentation()
	{

    }


}