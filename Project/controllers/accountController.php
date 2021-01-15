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

    }
}