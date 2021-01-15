<?php

function labelClicked($name){
    echo('Ich bin der Anfang der Funktion');
    header('Location: index.php?c=pages&a='.$name);
    echo('Ich stehe nach der Umleitung');

    exit(0);
}


// TODO: Add useful helper functions here