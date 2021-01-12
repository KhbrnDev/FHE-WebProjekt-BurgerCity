<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href= <?php STYLESPATH.'styles.css'?>>
    <link rel="stylesheet" href= <?php STYLESPATH.'footheadstyles.css'?>>
</head>
<body>
<?php
    include FILESPATH.'header.php';
?>


    
    <div class="body-content">
        <?php
            for($Index = 0; $Index < 15; $Index++)
            {
            ?>
                <div class="square">
                    
                    <img <?php class="square-picture" src= IMAGESPATH.'burger1.png' alt=""?> >
                    
                    <hr>
                    <div class="square-lower">
                        <div class="square-lower-elements square-lower-elements-description">
                            <p style="margin: 0;">Super Mega Vegan Beff-Bacon Burger</p>
                        </div>
                        <div class="square-lower-elemets">
                            3,99€
                        </div>
                        <div class="square-lower-elemets">
                            <button class="addToCard-Button">In den<br>Einkaufswagen</button>
                        </div>
                    </div>

                </div>
        <?php  
            }
        ?>


    </div>
</body>
</html>