<?php

/**
 * @author Kristof Friess <kristof.friess@fh-erfurt.de>
 * @copyright Since 2018 by Kristof Friess
 * @version 1.0.0
 */




namespace dwp\controller;


class PagesController extends \dwp\core\Controller
{

	public function actionIndex()
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
			header('Location: index.php?c=pages&a=login');
			exit(0);
		}

	}

	public function actionLogin()
	{
		// store error message
		$errMsg = null;

		// retrieve inputs 
		$username = isset($_POST['username']) ? $_POST['username'] : '';
		$password = isset($_POST['password']) ? $_POST['password'] : '';

		// check user send login field
		if(isset($_POST['submit']))
		{

			// TODO: Validate input first
			// TODO: Check login values with database accounts

			$params = [
				'email' => $username,
				'password' => $password
			];
			$newStudent = new \Student($params);

			$result = $GLOBALS['db']->query("SELECT * FROM `student`")->fetchAll();
			echo $result[0]['password'];

			$sql = "SELECT * FROM `student` where `email` = " . $GLOBALS['db']->quote($params['email']);
			$resultArray = $GLOBALS['db']->query($sql)->fetchAll();
			foreach($resultArray as $key)
			{
				if($params['password'] === $key['password'])
				{
					$_SESSION['loggenIn'] = true;
					$_SESSION['user']	  = $params['email'];
					break;
				}
			}

			//TestSQL Database
			/*
			$username = 'martin@1.de';
			// Funktioniert
			$sql0 = $GLOBALS['db']->prepare('SELECT `password` FROM `student` WHERE email = :email;');
			$sql0->bindValue(':email', $username);
			echo "password: " . $sql0->execute(); //true == 1

			//// Funktioniert nicht
			//$sql1 = $GLOBALS['db']->prepare('SELECT `password` FROM `student` WHERE email = `martin@1.de`;');
			//echo "password: " . $sql1->execute();

			// Funktioniert nicht
			$escapedUserName = $GLOBALS['db']->quote($username);
			$sql2  = "SELECT `password` FROM `student` where `email` = " . $escapedUserName;
			//$sql2 = " SELECT `password` FROM `student` where `email` = 'martin@1.de';";
			$resultArray = $GLOBALS['db']->query($sql2)->fetchAll();
			foreach ($resultArray as $key) 
			{
				echo $key['password'];
			}
			*/


			// Funktioniert ohne student Model
			/*
			$sql = $GLOBALS['db']->prepare("SELECT * FROM student where email = :email and password = :password;");
			$sql->bindValue(':email', $_POST['username']);
			$sql->bindValue(':password', $_POST['password']);

			if(!empty($sql->execute()))
			{
				$_SESSION['username'] = $username;
				$_SESSION['password'] = $password;
				$_SESSION['loggedIn'] = true;
				header('Location: index.php?c=pages&a=exams');
			}
			*/

			// TODO: Store useful variables into the session like account and also set loggedIn = true
			
			//

			/**
			 * Testing Model Methods
			 */

			$newStudent = new \Student(null);
			$escapedUserName = $GLOBALS['db']->quote('martin_kuehlborn@2.de');
			 $result =  $newStudent->findOne(" `email` = " . $escapedUserName);
			 /* for findOne
			foreach ($result as $key) 
			{
				echo $key . " \r\n";
			}
			*/

			/* for find
			foreach ($result as $key) 
			{
				foreach ($key as $value) 
				{
					echo $value;
				}
				
			}
			*/

			 $otherStudent = new \Student($result);
			 $otherStudent->destroy();






































			// if there is no error reset mail
			if($errMsg === null)
			{
				$username = '';
			}

		}

		// set param email to prefill login input field
		$this->setParam('username', $username);
		$this->setParam('errMsg', $errMsg);
	}

	public function actionSignup()
	{
		// store error message
		$errMsg = null;

		// TODO: Handle Inputfields for account
		// TODOSTART
		$email = isset($_POST['email']) ? $_POST['email'] : '';
		$password = isset($_POST['password']) ? $_POST['password'] : '';
		// TODOEND

		// check user send login field
		if(isset($_POST['submit']))
		{

			// TODO: Validate and create account in database if possible
			// TODOSTART

			// Validate


			// Safe to Database
			$params = [
				'email' => $email,
				'password' => $password
			];
			$newUser = new \Student($params);
			$newUser->insert($errMsg);
			
			// Funktioniert
			/*
			$sql = $GLOBALS['db']->prepare("INSERT INTO student (email, password) VALUES (:email, :password); ");
			$sql->bindValue(':email', $email);
			$sql->bindValue(':password', $password);
			$sql->execute();
			*/
			//TODOEND

			// if there is no error reset mail
			if($errMsg === null)
			{
				// TODO: Redirect to login
				// TODOSTART
				header('Location: index.php?c=pages&a=login');
				// TODOEND
			}

		}

		$this->setParam('errMsg', $errMsg);

		// TODO: Set params for account
		
	}

	public function actionExams()
	{
		// TODO: Check user is logged in
		
		// store error message
		$errMsg = null;

		// TODO: Handle Inputfields

		// check form sent
		if(isset($_POST['submit']))
		{

			// TODO: Validate input
			

			// if there is no error reset mail
			if($errMsg === null)
			{
				// TODO: reset input
			}

		}

		$this->setParam('errMsg', $errMsg);

		// TODO: Set params needed params like all exams with result
		$this->setParam('exams', []);
	}

	public function actionLogout()
	{
		session_destroy();
		header('Location: index.php?c=pages&a=login');
	}
}