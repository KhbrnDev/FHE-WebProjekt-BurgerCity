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
            $_SESSION['nextPage'] = 'index.php?c=account&a=account';
            header("Location: index.php?c=account&a=LogInSignIn");
        }

        if(isset($_POST['logout']))
        {  
            $_SESSION = [];
            header("Location: index.php?c=account&a=LogInSignIn");
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
        $userOrders = [];
        $preloadOffset = 3;
        if(isset($_POST['loadMore']))
        {
            $offset = isset($_POST['offset']) ? $_POST['offset'] : null;
            if($offset !== null)
            {
                $preloadOffset = $preloadOffset + $offset;
                $userOrders = \dwp\model\Orders::find("Account_accountId = " . $_SESSION['userID'] . " ORDER BY `orders`.`orderDate` DESC LIMIT " . $preloadOffset);
            }
        }
        elseif(isset($_GET['ajax']) && $_GET['ajax'] == 1) // get from ajax
        {
            $offset = isset($_POST['offset']) ? $_POST['offset'] : null;

            if($offset !== null)
            {
                $userOrders = \dwp\model\Orders::find("Account_accountId = " . $_SESSION['userID'] . " ORDER BY `orders`.`orderDate` DESC LIMIT 3 " . " OFFSET " . $offset);
            }
        }
        else
        {
            $userOrders = \dwp\model\Orders::find("Account_accountId = " . $_SESSION['userID'] . " ORDER BY `orders`.`orderDate` DESC LIMIT " . $preloadOffset);
        }

        // fill $preloadOrders
        foreach ($userOrders as $order) 
        {   
            $orderItems = \dwp\model\OrderItems::find("Orders_orderId = " . $order->orderId);
            $products = [];
            foreach ($orderItems as $item) 
            {
                $helperProduct = \dwp\model\Products::findOne("productsId = " . $item->Products_productsId);
                    
                if(isset($_GET['ajax']))
                {$products [] = 
                        [
                            'product' =>
                                [
                                    'description' => $helperProduct->description,
                                    'price'       => $helperProduct->price
                                ],
                            'quantity' => $item->quantity,
                            'productsPrice' => getGermanNumber($item->quantity * $helperProduct->price)
                        ];


                }
                else
                {
                    $helperProduct = \dwp\model\Products::findOne("productsId = " . $item->Products_productsId);
                    $products [] = 
                    [
                        'products' => $helperProduct,
                        'quantity' => $item->quantity,
                        'productsPrice' => getGermanNumber($item->quantity * $helperProduct->price)
                    ];
            }
                }

                

            $totalPrice = 0;
            foreach ($products  as $product) 
            {
                if(isset($_GET['ajax']))
                {
                    $totalPrice += $product['product']['price'] * $product['quantity'];
                }
                else
                {
                    $totalPrice += $product['products']->price * $product['quantity'];
                }
            }

            if(isset($_GET['ajax']))
            {
                $adress = \dwp\model\Adress::findOne("adressId = " . $order->Adress_adressId);
                $preloadOrders [] = 
                [
                    'orderId'   => $order->orderId,
                    'orderDate' => getGermanDate($order->orderDate),
                    'adress'    => 
                        [
                            'city' => $adress->city,
                            'zipCode' => $adress->zipCode,
                            'street' => $adress->street,
                            'number' => $adress->number
                        ],
                    'orderItems'=> $products,
                    'totalPrice'=> getGermanNumber($totalPrice)
                ];
            }
            else
            {

                $preloadOrders [] = 
                [
                    'orderId'   => $order->orderId,
                    'orderDate' => getGermanDate($order->orderDate),
                    'adress'    => \dwp\model\Adress::findOne("adressId = " . $order->Adress_adressId),
                    'orderItems'=> $products,
                    'totalPrice'=> getGermanNumber($totalPrice)
                ];
            }
                
        }
        
        // send to AJAX
        if(isset($_GET['ajax']) && $_GET['ajax'] == 1)
        {
            
            $preloadOffset = $preloadOffset + $offset;
            if(1)
            {
                echo json_encode(
                    [
                        'preloadOrders' => $preloadOrders,
                        'offset'        => $preloadOffset,
                        'inputOffset' => $offset
                    ], 
                    JSON_UNESCAPED_UNICODE 
                );
            }
            else
            {
                http_response_code(404);
                
            }
            //exit(0);
            
            
            exit(0);

            
        }

        // PUSH TO VIEW
        $this->setParam('errors', $errors);
        $this->setParam('preloadUser', $preloadUser);
        $this->setParam('preloadAdress', $preloadAdress);
        $this->setParam('preloadOrders', $preloadOrders);
        $this->setParam('preloadOffset', $preloadOffset);
        $this->setParam('success', $success);

    }
    
    public function actionLogInSignIn()
    {
        $preload = [];
        $errors = [];
        $success['success'] = false;

        if(isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === true)
        {
            // if(isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] !== true)
            // {
                header("Location: index.php?c=account&a=account");
            // }
            // elseif(isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] === true)
            // {
            //     header("Location: index.php?c=footercontent&a=administration");
            // }
        }
        else
        {
 
            if(isset($_POST['signin']) || (isset($_GET['ajax']) && $_GET['ajax'] == 1))
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
            
                if(isset($_GET['ajax']))
                {  

                    if(isset($errors['title']))
                    {
                        echo json_encode(
                            [
                                'errors' => $errors
                            ], 
                            JSON_UNESCAPED_UNICODE 
                        );
                    }
                    else
                    {
                        echo json_encode(
                            [
                                'success' => $success,
                                'preload' => $preload
                            ], 
                            JSON_UNESCAPED_UNICODE
                        );
                    }
                    exit(0);
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
                            $_SESSION['isAdmin'] = $Account->isAdmin == 1;
                            
                            switch($_SESSION['nextPage']):
                                case 'index.php?c=account&a=account':
                                    unset($_SESSION['nextPage']);
                                    header("Location: index.php?c=account&a=account");
                                    break;
                                case 'index.php?c=footercontent&a=administration':
                                    unset($_SESSION['nextPage']);
                                    header("Location: index.php?" . ($_SESSION['isAdmin'] == 1 ?  "c=footercontent&a=administration" : "c=account&a=account" ));
                                    break;
                                case 'index.php?c=pages&a=checkout':
                                    unset($_SESSION['nextPage']);
                                    header("Location: index.php?c=pages&a=checkout");
                                    break;
                                default:
                                    if(isset($_SESSION['nextPage'])) : ($_SESSION['nextPage']); endif;
                                    header("Location: index.php?c=pages&a=cart");
                                    break;
                                endswitch;
                                    
                            // OBSOLTETE
                            // if($Account->isAdmin == 1)
                            // {
                            //     $_SESSION['isAdmin'] = true;
                            //     header("Location: index.php?c=footercontent&a=administration");
                            // }
                            // else
                            // {
                            //     $_SESSION['isAdmin'] = false;
                            //     header("Location: index.php?c=account&a=account");
                            // }
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