<?php

function labelClicked($name){
    echo('Ich bin der Anfang der Funktion');
    header('Location: index.php?c=pages&a='.$name);
    echo('Ich stehe nach der Umleitung');

    exit(0);
}


// TODO: Add useful helper functions here

/**
 * Used to clean and tidy up 'Einkaufswagen', merge double inputs
 * should be called after every addition to 'Einkaufswagen'
 *  
 */
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









function getprice($price){
    strval($price);
    $price = str_replace(".", ",", $price);
    $price .= "€";


    return $price;
}




