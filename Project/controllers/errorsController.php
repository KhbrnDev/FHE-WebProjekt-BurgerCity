<?php

namespace dwp\controller;

class ErrorsController extends \dwp\core\Controller
{

	public function actionError404()
	{
        $errorMessage = 'Unknown error, please check your code!';

        if(isset($_GET['error']))
        {
            switch($_GET['error'])
            {
                
                case 'nocontroller':
                    $errorMessage = 'Der Gewählte Controller konnte nicht gefunden werden.';
                    break;
                case 'viewpath':
                    $errorMessage = 'View konnte nicht gefunden werden.';
                    break;
                case 'nomethod':
                    $errorMessage = "Die aufgerufene Methode existiert nicht.";
                    break;
            }
        }

        // though the error message variable to the view, so we can show it to our customers
        $this->setParam('errorMessage', $errorMessage);
	}
}