<?php

namespace dwp\controller;

class footercontentController extends \dwp\core\Controller
{
    public function actionAdministration()
	{
        //TODO check if admin is logged in and has right to access administration
        // else do... nothing? Error page?
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