<?php

namespace dwp\controller;
use \dwp\model as M;
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

        if(isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] === true)
        {   
            header("Location: index.php?c=footercontent&a=administration");
        }
        
        // CHANGE ACCOUNT RELATED DATA
        if(isset($_POST['changeAccount'])) // DONE ?
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
                && $birthday === $user->birthday
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
                $user->birthday = $birthday;

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
        elseif (isset($_POST['changePassword'])) // DONE
        {
            
            // GET DATA
            $curentPassword = ($_POST['currentPassword']) ? $_POST['currentPassword']: null;
            $newPassword    = ($_POST['newPassword']) ? $_POST['newPassword']: null;
            

            // VALIDATE INPUT
            \dwp\model\Account::validatePassword($newPassword, $errors);

            $user = \dwp\model\Account::findOne('accountId = ' . $_SESSION['userID']);
            if(!password_verify($curentPassword, $user->passwordHash) || $curentPassword === $newPassword)
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
        elseif (isset($_POST['saveAdress'])) // DONE ?
        {
            // GET DATA
            $street = ($_POST['street']) ? $_POST['street']: null;
            $number = ($_POST['number']) ? $_POST['number']: null;
            $zipCode = ($_POST['zipCode']) ? $_POST['zipCode']: null;
            $city = ($_POST['city']) ? $_POST['city']: null;

            // VALIDATE DATA
            \dwp\model\Adress::validateStreet($street, $errors);
            \dwp\model\Adress::validateNumber($number, $errors);
            \dwp\model\Adress::validateZipCode($zipCode, $errors);
            \dwp\model\Adress::validateCity($city, $errors);
            
            // updating existing adress
            if(array_key_exists('adressId', $_POST))
            {
                $adressId = ($_POST['adressId']) ? $_POST['adressId'] : null;
                if($adressId !== null)
                {
                    $existingAdress = \dwp\model\AdressHelper::findOne("Account_accountId = " .$_SESSION['userID'] . " and Adress_adressId  = " . $adressId);
                    if($existingAdress === null)
                    { 
                        $success['success'] = false;
                        $errors [] = 'Es gab einen Fehler beim updaten der Adresse';
                    }
            
                }
                else
                {
                    // sollte durch HTML adressId->required eigentlich nicht vorkommen
                    // only visible when HTML Files have been altered manually
                    $success['success'] = false;
                    $errors [] = 'Es gab einen Fehler beim updaten der Adresse';
                    $errors [] = 'adressId ist nicht gegeben'; 
                }
            }

            if (count($errors) === 0)
            {
                $db = $GLOBALS['db'];
                
                $adressData = [
                    'street' => $street,
                    'city' => $city,
                    'zipCode' => $zipCode,
                    'number' => $number                    
                ];

                $adress = \dwp\model\Adress::findAdress($adressData);
                
                if($adress === null)
                {
                    // create Adress and add to AdressHelper
                    $adress = new \dwp\model\Adress($adressData);
                    if($adress->validate($errors))
                    {
                        $adress->save($errors);
                    }
                    else
                    {
                        $success['success'] = false;
                        $errors [] = 'Adresseingabe ist nicht valide';
                    }
                
                    if(count($errors) === 0)
                    {
                        // Adress->save was successfull
                        $adressId = $adress->adressId;
                        $adressHelper = \dwp\model\AdressHelper::findOne("'adressId' = " . $adressId . " AND 'accountId' = " . $_SESSION['userID']);
                        echo "adressID" . $adressId; 

                        if($adressHelper === null)
                        {
                            // insert Adresshelper into Database
                            $adressHelper = new \dwp\model\AdressHelper(null);
                            $adressHelper->Adress_adressId = $adressId;
                            $adressHelper->Account_accountId = $_SESSION['userID'];
                            $adressHelper->save($errors);

                            if(count($errors) === 0)
                            {
                                $success['success'] = true;
                                $success['message'] = 'Adresse erfolgreich gespeichert';
                            }
                        }
                        else
                        {
                            // THIS SHOULD NEVER BE REACHED if Adress didnt exist but AddressHelper did!
                            // Adresshelper already exists
                            $success['success'] = true;
                            $success['message'] = 'Adresse erfolgreich gespeichert';

                        }
                    }
                }
                else
                {
                    // Adress exists, save it to Adresshelper
                    $adressHelper = \dwp\model\AdressHelper::findOne("Adress_adressId = " . $adress->adressId . " and Account_accountId = " . $_SESSION['userID']);

                    if($adressHelper === null)
                    {
                        $adressHelper = new \dwp\model\AdressHelper(null);
                        $adressHelper->Adress_adressId = $adress->adressId;
                        $adressHelper->Account_accountId = $_SESSION['userID'];
                        $adressHelper->save($errors);

                        if(count($errors) === 0)
                        {
                            $success['success'] = true;
                            $success['message'] = 'Adresse erfolgreich gespeichert';
                        }
                    }
                    else
                    {
                        $success['success'] = false;
                        $errors[] = 'Adresse ist bereits gespeichert';
                    }

                    
                }
            }

            // hier alte adressHelper->destroy
            if(array_key_exists('adressId', $_POST))
            {
                $adressId = ($_POST['adressId']) ? $_POST['adressId'] : null;
                if($adressId !== null)
                {
                    $existingAdress = \dwp\model\AdressHelper::findOne("Account_accountId = " .$_SESSION['userID'] . " AND Adress_adressId  = " . $adressId);
                    if(count($errors) === 0)
                    {
                        $existingAdress->destroy($errors);
                        if(count($errors) !== 0)
                        {
                            $success['success'] = true;
                            $success['message'] = 'Adresse erfolgreich gespeichert\nIhre alte Adresse muss manuell gelöscht werden';
                        }
                    }
                }
            }
            // has there been errors?
            if(count($errors) !== 0)
            {
                $success['success'] = false;
                $errors['title'] = 'Adressspeicherung fehlgeschlagen';
            }

        }
        elseif (isset($_POST['deleteAdress'])) // DONE
        {
            // GET DATA
            $adressId = ($_POST['adressId']) ? $_POST['adressId'] : null;
            $street = ($_POST['street']) ? $_POST['street']: null;
            $number = ($_POST['number']) ? $_POST['number']: null;
            $zipCode = ($_POST['zipCode']) ? $_POST['zipCode']: null;
            $city = ($_POST['city']) ? $_POST['city']: null;

            
            if($adressId !== null)
            {
                $userAdressHelper = \dwp\model\AdressHelper::findOne("Account_accountId = " . $_SESSION['userID'] . " AND  Adress_adressId = " . $adressId);
                if($userAdressHelper !== null)
                {
                    $userAdressHelper->destroy($errors);
                    if(count($errors) === 0)
                    {
                        $success['success'] = true;
                        $success['message'] = 'Adresse erfolgreich gelöscht';
                    }
    
                }
                else
                {
                    // this should only be reached if someone tinkered with HTML
                    $success['success'] = false;
                    $errors[] = 'Bitte nicht die HTML Dateien ändern ;)';
                }
            }
            else
            {
                // $adressId should never be null because HTML->required
                // this should only be reached if someone tinkered with HTML
                $success['success'] = false;
                $errors[] = 'Bitte nicht die HTML Dateien ändern ;)';
            }

            if(count($errors) !== 0)
            {
                $success['success'] = false;
                $errors['title'] = 'Adresslöschung fehlgeschlagen';
            }
            
        }
        elseif (isset($_POST['repeatOrder']))
        {
            
            // GET DATA
            $orderId = ($_POST['orderId']) ? $_POST['orderId'] : null;

            if($orderId !== null)
            {
                $orderItems = \dwp\model\OrderItems::find("Orders_orderId = " . $orderId);

                $_SESSION['cart'] = []; // for reapeatOrder the old 'Einkaufswagen' will be deleted
                foreach ($orderItems as $item) 
                {
                    $_SESSION['cart'] [] = 
                        [
                            'productsId' => $item->Products_productsId,
                            'quantity' => $item->quantity      
                        ];
                }
                            
                header("Location: index.php?c=pages&a=cart");
            }
        }



        // PRELOAD DATA
        // Preload User->Account
        $user = \dwp\model\Account::findOne("`accountId` = " . $_SESSION['userID']);
        $preloadUser['firstname'] = $user->firstName;
        $preloadUser['lastname'] = $user->lastName;
        $preloadUser['birthday'] = $user->birthday;
        $preloadUser['email'] = $user->email;
        $preloadUser['phoneNumber'] = $user->phoneNumber;

        // Preload User->Adress
        $userAdressHelper = \dwp\model\AdressHelper::find("Account_accountId = " . $_SESSION['userID']);
        
        if(count($userAdressHelper) > 0)
        {   $sqlWhere = '';
            foreach ($userAdressHelper as$value) 
            {
                $sqlWhere .= ' adressId = ' .$value->Adress_adressId . ' OR';
                // TODO could be displayed in order
                // \dwp\model\Adress::find ---  "ORDER BY city desc, street desc, number desc"
                //$preloadAdress [] = \dwp\model\Adress::findOne("adressId = " . $value->Adress_adressId);
            }
            $lastSpacePosition = strrpos($sqlWhere, ' ');
            $sqlWhere = substr($sqlWhere, 0, $lastSpacePosition);
            $preloadAdress = \dwp\model\Adress::find($sqlWhere . " order by zipCode asc, city asc, street asc, number asc");
        }


        // Preload User->Orders
        
        $userOrders = \dwp\model\Orders::find("Account_accountId = " . $_SESSION['userID']);
        
        foreach ($userOrders as $order) 
        {   
            $orderItems = \dwp\model\OrderItems::find("Orders_orderId = " . $order->orderId);
            $products = [];
            foreach ($orderItems as $item) 
            {
                $products [] = 
                    [
                        'products' => \dwp\model\Products::findOne("productsId = " . $item->Products_productsId),
                        'quantity' => $item->quantity      
                    ];
            }

            $totalPrice = 0;
            foreach ($products  as $product) 
            {
                $totalPrice += $product['products']->price * $product['quantity'];
            }
            $preloadOrders [] = 
                [
                    'orderId'   => $order->orderId,
                    'orderDate' => $order->orderDate,
                    'adress'    => \dwp\model\Adress::findOne("adressId = " . $order->Adress_adressId),
                    'orderItems'=> $products,
                    'totalPrice'=> $totalPrice
                ];

        }
        

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
            if(isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] !== true)
            {
                header("Location: index.php?c=account&a=account");
            }
            elseif(isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] === true)
            {
                header("Location: index.php?c=footercontent&a=administration");
            }
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
                        'birthday' => $birthday,
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
                            
                            if($Account->isAdmin == 1)
                            {
                                $_SESSION['isAdmin'] = true;
                                header("Location: index.php?c=footercontent&a=administration");
                            }
                            else
                            {
                                $_SESSION['isAdmin'] = false;
                                header("Location: index.php?c=account&a=account");
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