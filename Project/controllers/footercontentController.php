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
        $preloadAdmins = [];
        $preloadProducts = [];
        $success['success'] = false;
        $preloadCustomers = [];

        // GENERAL PAGEMANAGEMANT
        if(!$this->loggedIn())
        {
            $_SESSION['nextPage'] = 'index.php?c=footercontent&a=administration';
            header("Location: index.php?c=account&a=LogInSignIn");
        }

        if(isset($_POST['logout']))
        {   
            $_SESSION = [];
            header("Location: index.php?c=account&a=LogInSignIn");
        }

        if(isset($_SESSION['isAdmin']))
        {   
            if($_SESSION['isAdmin'] !== true)
            {
                header("Location: index.php?c=account&a=LogInSignin");
            }
        }

        if(isset($_POST['deleteAdmin']))
        {
            
        }
        
        if(isset($_POST['makeAdmin']))
        {

        }

        if(isset($_POST['changeFavorite']))
        {

        }

        // DO STUFF HERe
        $preloadAdmins = \dwp\model\Account::find("isAdmin = 1");
        $preloadCustomers = \dwp\model\Account::find("isAdmin = 0 ORDER BY `account`.`email`");
        $preloadProducts = \dwp\model\Products::find("1 ORDER BY  `products`.`category`");
        

        // PRELOAD DATA


        // push to view
        $this->setParam('preloadAdmins', $preloadAdmins);
        $this->setParam('preloadProducts', $preloadProducts);
        $this->setParam('errros', $errors);
        $this->setParam('success', $success);
        $this->setParam('preloadCustomers', $preloadCustomers);

        
        

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