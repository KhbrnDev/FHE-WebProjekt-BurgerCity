<?php


namespace dwp\controller;


class PagesController extends \dwp\core\Controller
{
	public function actionStart()
	{
		$burger = \dwp\model\Products::find("category = " . $GLOBALS['db']->quote("burger"));
		$this->setParam('burger', $burger);
		
	}

	public function actionCart()
	{
		// INITIALIZE VIEW->PARAMS 
        $errors = [];
        $preloadOrders = [];
		$preloadGesamtSumme = 0;
        $success['success'] = false;

		if(isset($_POST['goToCartReview']))
		{
			$lieferhinweise = $_POST['lieferhinweise'] ? $_POST['lieferhinweise'] : null;

			if($lieferhinweise !== null)
			{
				$_SESSION['lieferhinweise'] = $lieferhinweise;
			}

			header("Location: index.php?c=pages&a=checkout");
		}
		if(isset($_POST['deleteItem'])) 
		{
			$productsId = $_POST['productsId'] ? $_POST['productsId'] : null;

			if($productsId !== null)
			{
				for($int = 0; $int < count($_SESSION['cart']); $int++)
				{
					if($_SESSION['cart'][$int]['productsId'] === $productsId)
					{
						array_splice($_SESSION['cart'], $int, 1);
					}	
				}
			}
		}
		if (isset($_POST['saveItemCount']))
		{
			$productsId = $_POST['productsId'] ? $_POST['productsId'] : null;
			$numberOfItems = $_POST['numberOfItems'] ? $_POST['numberOfItems'] : null;

			if($productsId !== null)
			{
				for($int = 0; $int < count($_SESSION['cart']); $int++)
				{
					if($_SESSION['cart'][$int]['productsId'] === $productsId)
					{
						if($numberOfItems <= 0)
						{
							array_splice($_SESSION['cart'], $int, 1);
						}
						else
						{
							$_SESSION['cart'][$int]['quantity'] = $numberOfItems;
						}
					}
				}
			}
		}

		// PRELOAD DATA
		$preloadGesamtSumme = 
			[
				'gesamtSumme' => 0,
				'gesamtAnzahl' => 0
			];
		
		if(isset($_SESSION['cart']))
		{
			foreach($_SESSION['cart'] as $orderItem)
			{
				$product = \dwp\model\Products::findOne("productsId = " . $orderItem['productsId']);
				$preloadOrders [] = 
					[
						'product' => $product,
						'quantity' => $orderItem['quantity']
					];
				$preloadGesamtSumme['gesamtSumme'] += $product->price * $orderItem['quantity'];
				$preloadGesamtSumme['gesamtAnzahl'] += $orderItem['quantity'];
			}
		}
		
		
		$this->setParam('preloadOrders', $preloadOrders);
		$this->setParam('preloadGesamtSumme', $preloadGesamtSumme);
		

	}

	public function actionCheckout()
	{
		$errors = [];
		$success = [];
		$preloadAdresses = [];

		if(!$this->loggedIn())
		{
			$_SESSION['nextPage'] = 'index.php?c=pages&a=cart';
			header("Location: index.php?c=account&a=LogInSignIn");
		}

		if(isset($_POST['nextStep']))
		{
			if(isset($_POST['adressId']) && isset($_POST['payment']))
			{
				$adressId = $_POST['adressId'];
				$adress = \dwp\model\Adress::findOne("adressId = " . $adressId);
				
				if($adress !== null)
				{
					$_SESSION['cartHelper']['adressId'] = $adressId;
					
					$payment = $_POST['payment'];
					switch ($payment) 
					{
						case 'card':
							$accountHolder = !empty($_POST['accountHolder']) ? $_POST['accountHolder'] : null;
							$iban = !empty($_POST['iban']) ? $_POST['iban'] : null;
							
							if($accountHolder !== null && $iban !== null)
							{
								$ibanRegEx = "/\b[A-Z]{2}[0-9]{2}(?:[ ]?[0-9]{4}){4}(?!(?:[ ]?[0-9]){3})(?:[ ]?[0-9]{1,2})?\b/";
								if(preg_match($ibanRegEx, $iban))
								{
									$_SESSION['cartHelper']['payment'] = 
										[
											'method' 		=> 'Kartenzahlung',
											'accountHolder' => $accountHolder,
											'iban' 			=> $iban
										];
								}
								else
								{
									$success = false;
									$errors['title'] = 'Das Format Ihrer IBAN entspricht nicht der vorgabe';
								}
							}
							else
							{
								$success = false;
								$errors['title'] = 'Bei Kartenzahlen bitte die Kartendetails eingeben';
							}
							break;
						case 'paypal':
							$emailPaypal = !empty($_POST['emailPaypal']) ? $_POST['emailPaypal'] : null;
							
							if($emailPaypal !== null)
							{
								if(\dwp\model\Account::validateEmail($emailPaypal))
								{
									$_SESSION['cartHelper']['payment'] = 
										[
											'method' => 'PayPal',
											'emailPaypal' => $emailPaypal
										];
								}
								else
								{
									$success = false;
									$errors['title'] = 'Die eingegebene EMail ist ungültig';
								}
							}
							else
							{
								$success = false;
								$errors['title'] = 'Bei Paypalzahlung bitte die Paypayl-Email angeben';
							}
							break;
						case 'cash':
							$_SESSION['cartHelper']['payment'] = 
								[
									'method' => 'Barzahlung bei Lieferung'
								];
							break;
						default:
							$success = false;
							$errors [] = 'Prepare for the Wurscht.';
							$errors['title'] = 'This sould never be reached!';
							break;
					}
				}
				else
				{
					// sould normally not be reached
					$success = false;
					$errors['title'] = 'Bitte nicht an der Lieferadresse rumspielen';
				}
			}
			else
			{
				$success = false;
				$errors['title'] = "Bitte Lieferadresse und Zahlungsmethode auswählen.";
			}

			if(count($errors) === 0)
			{
				header("Location: index.php?c=pages&a=checkoutReview");
			}

		}
						
		// PRELOAD DATA
		// Preload Adresses
		
		$adressHelper = \dwp\model\AdressHelper::find("Account_accountId = " . $_SESSION['userID']);
		foreach($adressHelper as $adress)
		{
			$adress = \dwp\model\Adress::findOne("adressId = " . $adress->Adress_adressId);
			if($adress !== null)
			{
				$preloadAdresses [] = $adress;
			}
		}
		
		$this->setParam('preloadAdresses', $preloadAdresses);
		$this->setParam('errors', $errors);
		$this->setParam('success', $success);
		
	}
	
	public function actionCheckoutReview()
	{
		// PRELOAD DECLARATION
		$preloadGesamtSumme = 0;
		$preloadCartHelper = [];
		$preloadOrders = [];
		$errors = [];

		if(!$this->loggedIn() || !isset($_SESSION['cart']) || empty($_SESSION['cart']) || !isset($_SESSION['cart']) || !isset($_SESSION['cartHelper']) ||
			 !isset($_SESSION['cartHelper']) || empty($_SESSION['cartHelper']))
		{
			header("Location: index.php?c=pages&a=cart");
		}
		if(isset($_POST['nextStep']))
		{
			$date = getdate();
			$orderDate = $date['year'] . '-' . $date['mon'] . '-' . $date['mday'];
			$orderParams = 
				[
					'orderDate' 		=> $orderDate,
					'Account_accountId' => $_SESSION['userID'],
					'Adress_adressId'	=> $_SESSION['cartHelper']['adressId']
				];
			if(isset($_SESSION['lieferhinweise']) && !empty($_SESSION['lieferhinweise']))
			{
				$orderParams['deliveryInformation'] = $_SESSION['lieferhinweise'];
			}
			
			$order = new \dwp\model\Orders($orderParams);
			$order->insert($errors);
			
			if(count($errors) === 0)
			{

				$test;
				foreach($_SESSION['cart'] as $orderItem)
				{
					$orderItemParams = 
					[
						'quantity' => $orderItem['quantity'],
						'Orders_orderId' => $order->orderId,
						'Products_productsId' => $orderItem['productsId']
					];
					$newOrderItem = new \dwp\model\OrderItems($orderItemParams);
					$newOrderItem->insert($errors);

					$test [] = $newOrderItem;
				}
			}

			if(count($errors) === 0)
			{
				$_SESSION['lieferhinweise'] = null;
				$_SESSION['cart'] = [];
				$_SESSION['cartHelper'] = [];

				header("Location: index.php?c=pages&a=checkoutSuccess");
			}
		
		}



		// PRELOAD DATA

		$preloadGesamtSumme = 
			[
				'gesamtSumme' => 0,
				'gesamtAnzahl' => 0
			];
		
		if(isset($_SESSION['cart']))
		{
			foreach($_SESSION['cart'] as $orderItem)
			{
				$product = \dwp\model\Products::findOne("productsId = " . $orderItem['productsId']);
				$preloadOrders [] = 
					[
						'product' => $product,
						'quantity' => $orderItem['quantity']
					];
				$preloadGesamtSumme['gesamtSumme'] += $product->price * $orderItem['quantity'];
				$preloadGesamtSumme['gesamtAnzahl'] += $orderItem['quantity'];
			}
		}

		// Make this better
		$preloadCartHelper['adress'] = \dwp\model\Adress::findOne("adressId = " . $_SESSION['cartHelper']['adressId']);
		$preloadCartHelper['payment'] = $_SESSION['cartHelper']['payment'];
		// push to view
		$this->setParam('errors', $errors);
		$this->setParam('preloadGesamtSumme', $preloadGesamtSumme);
		$this->setParam('preloadCartHelper', $preloadCartHelper);
		$this->setParam('preloadOrders', $preloadOrders);
		
	}
	
	public function actionCheckoutSuccess()
	{
		
	}
	
}