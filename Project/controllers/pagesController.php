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
			echo "Q1";
		}
		if(isset($_POST['deleteItem'])) 
		{
			echo "TEST";
		}
		if (isset($_POST['saveItemCount']))
		{
			echo "TEST!";
		}

		// PRELOAD DATA


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