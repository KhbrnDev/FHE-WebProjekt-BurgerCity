<?php

// depricadet
function labelClicked($name)
{
    echo('Ich bin der Anfang der Funktion');
    header('Location: index.php?c=pages&a='.$name);
    echo('Ich stehe nach der Umleitung');

    exit(0);
}

/**
 * Used to clean and tidy up 'Einkaufswagen', merge double inputs
 * should be called after every addition to 'Einkaufswagen'
 *  
 */
// possible improvement: make better, should clean the complete Einkaufswagen and merge double input
function cleanEinkaufswagen()
{
    for($int = 0; $int < count($_SESSION['cart']) -1 ; $int++)
    {   
        $count = count($_SESSION['cart']) - 1;
        if($_SESSION['cart'][$int]['productsId'] === $_SESSION['cart'][$count]['productsId'])
        {
            $_SESSION['cart'][$int]['quantity'] += $_SESSION['cart'][$count]['quantity'];
            array_pop($_SESSION['cart']);
            break;
        }
    }
    
}

function getGermanDate($date){
    strval($date);
    $german_date = explode( "-" ,$date);

    return sprintf("%02d.%02d.%04d",$german_date[2], $german_date[1], $german_date[0]);

}

// change Dateformat from DB to German
function getGermanNumber($price)
{
    //if acivated International Extention
    //$fmt = numfmt_create( 'de_DE', NumberFormatter::CURRENCY );
    //return numfmt_format_currency($fmt, $price, "EUR"); 
    
    //if not activated 
    return number_format($price,2,',',' ')." €";
}

// depricadet
function getprice($price)
{
    strval($price);
    $price = str_replace(".", ",", $price);
    $price .= "€";


    return $price;
}

// retrive category information for menue.php and category.php
function getCategoryInformation(&$title, &$description, $category)
{
    switch($category)
    {
        case "burger":
            $title = "Burger";
            $description = "Wir haben so tolle Burger. Jeder Burger wird mit Liebe und 100% natürlichen Zutaten zubereitet.
            Das Beef kommt von Bio-Kücken aus der Region.";
            break;
        case "snacks":
            $title = "Snacks";
            $description = "Snacks sind lecker, weil man sie so gut snacken kann. Bestelle auch du dir jetzt deine snackbaren Snacks.";
            break;
        case "drinks":
            $title = "Drinks";
            $description = "Der Mensch braucht Wasser. Am besten mit viel Zucker und Farbstoffen drin. Und damit es auch nach was schmeckt, haben wir unseren Getränken exklusive Geschmackstoffe zugesetzt. Natürlich 100% vegan, weil 100% synthetisch. Das Getränk von Morgen erwartet dich.";
            break;
        case "desserts":
            $title = "Desserts";
            $description = "Sei kein Wüstenschiff. Kaufe unsere süßen, leckeren Bio-Desserts. Honig statt Zucker und natürlich alles Vollkorn.";
            break;
        default:
            $title = "Produkte";
            $description = "Wir haben super Produkte. Kaufe jetzt Produkte und du bekommst Produkte.";
            break;
    }
}

// adding an item to cart 
function addToCart($productsId, &$errors = [])
{
    if($productsId !== null)
    {   
        $product = \dwp\model\Products::findOne("productsId = " . $productsId);
        if($product !== null)
        {
        
            if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0)
            {
                $itemExists = false;
                for($int = 0; $int < count($_SESSION['cart']); $int++)
                {
                    if($_SESSION['cart'][$int]['productsId'] === $productsId)
                    {
                        $_SESSION['cart'][$int]['quantity'] += 1;
                        $itemExists = true;
                        break;
                    }
                }

                if(!$itemExists)
                {
                    $_SESSION['cart'] [] = 
                        [
                            'productsId' => $productsId,
                            'quantity'   => 1
                        ];
                }
            }
            else
            {
                $_SESSION['cart'] = [];

                $_SESSION['cart'] [] = 
                [
                    'productsId' => $productsId,
                    'quantity'   => 1    
                ];
            }
        }
    }	


    cleanEinkaufswagen();

    return true;
}