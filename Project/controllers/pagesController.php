<?php


namespace dwp\controller;


class PagesController extends \dwp\core\Controller
{
	public function actionStart()
	{
		
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
				
				header("Location: index.php?c=pages&a=checkout");
			}
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
		foreach($_SESSION['cart'] as $orderItem) // foreach wird nur ausgeführt, wenn count($element > 0) :) -> kein if nötig
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
		
		
		$this->setParam('preloadOrders', $preloadOrders);
		$this->setParam('preloadGesamtSumme', $preloadGesamtSumme);
		

	}

	public function actionCheckout()
	{
		
	}

	public function actionCheckoutReview()
	{
		
	}

	public function actionCheckoutSuccess()
	{
		
	}

}