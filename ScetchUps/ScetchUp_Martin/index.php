<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
<?php
    include 'views/headfoot/header1.php'
?>

    
    <div class="body-content">
        <?php
            for($Index = 0; $Index < 12; $Index++)
            {
            ?>
                <div class="square">
                    <img class="square-picture" src="assets/images/burger1.png" alt="">
                    
                    <div class="square-lower">
                        <div class="square-lower-elements square-lower-elements-description">
                            <p style="margin: 0;">Super Mega Vegan Beff-Bacon Burger</p>
                        </div>
                        <div class="square-lower-elemets">
                            3,99 €
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
    
<?php
    include'views/headfoot/footer.php';
?>
</body>
</html>