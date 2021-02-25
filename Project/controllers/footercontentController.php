<?php

namespace dwp\controller;

class footercontentController extends \dwp\core\Controller
{
    public function actionAdministration()
	{
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

        // button handling
        if(isset($_POST['deleteAdmin']))
        {
            $accountId = isset($_POST['accountId']) ? $_POST['accountId'] : null;

            if($accountId !== null)
            {   
                $account = \dwp\model\Account::findOne("`accountId` = " . $accountId);

                if($account !== null)
                {
                    if(count(\dwp\model\Account::find("`isAdmin` = 1")) > 1)
                    {
                        $account->isAdmin = 0;
                        $account->update($errors);
                    }
                    else
                    {
                        $errors [] = "Um den von ihnen gewählten Admin zu entfernen müssen zu erst einen anderen hinzufügen";
                        $errors['title'] = "Es muss mindestens 1 Admin verbleiben.";
                    }
                }
                else
                {
                    $errors['title'] = "Bitte nicht an den ID's herumspielen";
                }

            }
            else
            {
                $errors['title'] = "Bitte nicht an den ID's herumspielen";
            }
        }
        
        if(isset($_POST['makeAdmin']))
        {
            $accountId = isset($_POST['accountId']) ? $_POST['accountId'] : null;

            if($accountId !== null)
            {
                $account = \dwp\model\Account::findOne("`accountId` = " . $accountId);

                if($account !== null)
                {
                    $account->isAdmin = 1;
                    $account->update($errors);
                    
                    if(count($errors) === 0)
                    {
                        $success['success'] = $account->firstName . " " . $account->lastName . " erfolgreich geändert";
                    }
                }
                else
                {
                $errors['title'] = "Bitte nicht an den ID's herumspielen";
                }
                
            }
            else
            {
                $errors['title'] = "Bitte nicht an den ID's herumspielen";
            }
        }

        // not fully implemented yet
        if(isset($_POST['changeFavorite']))
        {
            $productsId = isset($_POST['productsId']) ? $_POST['productsId'] : null;

            if($productsId !== null)
            {
                $product = \dwp\model\Products::findOne("`productsId` = " . $productsId);

                if($productsId !== null)
                {
                    $product->favorites = ($product->favorites == 1) ? 0 : 1;
                    $product->update($errors);
                    if(count($errors) === 0)
                    {
                        $success['success'] = $product->description . " erfolgfreich geändert";
                    }
                }
                else
                {
                    $errors['title'] = "Bitte nicht an den ID's herumspielen";
                }
            }
            else
            {
                $errors['title'] = "Bitte nicht an den ID's herumspielen";
            }
        }

        // DO STUFF HERe
        $preloadAdmins = \dwp\model\Account::find("isAdmin = 1");
        $preloadCustomers = \dwp\model\Account::find("isAdmin = 0 ORDER BY `account`.`email`");
        $preloadProducts = \dwp\model\Products::find("1 ORDER BY  `products`.`category`"); // not needed beacuase not fully implemented but still loaded
        

        // PRELOAD DATA


        // push to view
        $this->setParam('preloadAdmins', $preloadAdmins);
        $this->setParam('preloadProducts', $preloadProducts);
        $this->setParam('errors', $errors);
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