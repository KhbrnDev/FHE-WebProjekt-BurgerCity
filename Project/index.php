<?php


// load needed variables/defines/configs
require_once 'config/init.php';
require_once 'config/database.php';

// load core stuff
require_once COREPATH.'functions.php';
require_once COREPATH.'controller.class.php';
require_once COREPATH.'model.class.php';


// TODO: load all created models
require_once MODELSPATH.'Account.php';
require_once MODELSPATH.'Address.php';
require_once MODELSPATH.'AddressHelper.php';
require_once MODELSPATH.'Category.php';
require_once MODELSPATH.'Ingredients.php';
require_once MODELSPATH.'OrderItems.php';
require_once MODELSPATH.'Orders.php';
require_once MODELSPATH.'ProductHelper.php';
require_once MODELSPATH.'Products.php';


// start session to handle login
session_start();

// check which controller should be loaded
$controllerName = 'pages'; // default controller if noting is set
$actionName = 'start'; // default action if nothing is set

// check if a controller is given
if(isset($_GET['c']))
{
    $controllerName = $_GET['c'];
}

// check if an action is given
if(isset($_GET['a']))
{
    $actionName = $_GET['a'];
}

// check  if controller/class and method exists
if(file_exists(CONTROLLERSPATH.$controllerName.'Controller.php'))
{
    // include the controller file
    require_once CONTROLLERSPATH.$controllerName.'Controller.php';

    // generate the class name of the controller using the name extended by Controller
    // also add the namespace in front
    $className = '\\dwp\\controller\\'.ucfirst($controllerName).'Controller';

    // generate an instace of the controller using the name, stored in $className
    $controller = new $className($controllerName, $actionName);

    // checking the method is available in the controller class
    $actionMethod = 'action'.ucfirst($actionName);
    if(!method_exists($controller, $actionMethod))
    {
        // redirect to error page 404 because not found
        header('Location: index.php?c=errors&a=error404&error=nomethod');
        exit(0);
    }
    else
    {
        // call the action method to do the job
        // so the action cann fill the params for the view which will be used 
        // in the render process later
        $controller->{$actionMethod}();
    }
}
else
{
    // redirect to error page 404 because not found
    header('Location: index.php?c=errors&a=error404&error=nocontroller');
    exit(0);
}


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/styles/style.css">
    <title>Burger City</title>
</head>
<body>
    <?php

        include FILESPATH.'header.php';

        // this method will render the view of the called action
        // for this the the file in the views directory will be included
        $controller->render();

    ?>
</body>
</html>