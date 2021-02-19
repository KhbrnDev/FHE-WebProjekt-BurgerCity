<div class="menu-body">
    
    <!--  -->
    <h1>Speisekarte</h1>
    <p>Entecke unsere neuartigen, innovativen Produkte. Hier ist für alle was dabei!</p>

    <h2>Burger</h2>
    <span>
        <p class="category-description">Wir haben so tolle Burger. Jeder Burger wird mit Liebe und 100% natürlichen Zutaten zubereitet.
					Das Beef kommt von Bio-Kücken aus der Region.</p>
    </span>
    <div class="body-content">
        <?php
            for($index = 0; $index < 3; $index++)
            {
                ?>
                <div class="square">

                    <h3 class="square-headline"><?=$burger[$index]->description?></h3>

                    <img class="square-picture" src="<?=IMAGESPATH.$burger[$index]->pictureURL?>" alt="<?=$burger[$index]->altText?>">

                    <div class="square-lower">
                        <div class="square-lower-elemets">
                            <?=$burger[$index]->price?>
                        </div>
                        <div class="square-lower-elemets">
                            <button class="addToCard-Button">In den<br>Einkaufswagen</button>
                        </div>
                    </div>
                </div>
                <?php  
            }
            ?>
            <!--<div class="square">
                <img class="speisekarte-arrow" src="../assets/images/speisekarte-arrow.svg" alt="">
                <p class="speisekarte-arrow-p">Hier geht es zu weiteren leckeren Burgern</p>
                Hier geht es zu weiteren leckeren Burgern
                <br>
                <a href="index.php?c=products&a=category&f=burger"> <button type="submit">Mehr Burger</button> </a>

                
            </div> -->
    </div>

    <form method="POST">
        <input style="display:none;" type="text" name="category" value="burger">
        <button class="more-Button" type="submit" name="more" value="more">Alle Burger</button>
    </form>

    <br>

    <h2>Snacks</h2>
    <span>
        <p class="category-description">Snacks sind lecker, weil man sie so gut snacken kann. Bestelle auch du dir jetzt deine snackbaren Snacks.</p>
    </span>
    <div class="body-content">
        <?php
            for($index = 0; $index < 3; $index++)
            {
                ?>
                <div class="square">

                    <h3 class="square-headline"><?=$snacks[$index]->description?></h3>

                    <img class="square-picture" src="<?=IMAGESPATH.$snacks[$index]->pictureURL?>" alt="<?=$snacks[$index]->altText?>">

                    <div class="square-lower">
                        <div class="square-lower-elemets">
                            <?=$burger[$index]->price?> 
                        </div>
                        <div class="square-lower-elemets">
                            <button class="addToCard-Button">In den<br>Einkaufswagen</button>
                        </div>
                    </div>
                </div>
                <?php  
            }
            ?>
            <!--<div class="square">
                <img class="speisekarte-arrow" src="../assets/images/speisekarte-arrow.svg" alt="">
                <p class="speisekarte-arrow-p" href="index.php?c=products&a=category&f=snacks">Hier geht es zu weiteren leckeren Snacks</p>
            </div>-->
    </div>

    <form method="POST">
        <input style="display:none;" type="text" name="category" value="snacks">
        <button class="more-Button" type="submit" name="more" value="more">Alle Snacks</button>
    </form>

    <br>

    <h2>Getränke</h2>
    <span>
        <p class="category-description">"Der Mensch braucht Wasser. Am besten mit viel Zucker und Farbstoffen drin. Und damit es auch nach was schmeckt, haben wir unseren Getränken exklusive Geschmackstoffe zugesetzt. Natürlich 100% vegan, weil 100% synthetisch. Das Getränk von Morgen erwartet dich."</p>
        
    </span>
    <div class="body-content">
        <?php
            for($index = 0; $index < 3; $index++)
            {
                ?>
                <div class="square">
                    <h3 class="square-headline"><?=$drinks[$index]->description?></h3>

                    <img class="square-picture" src="<?=IMAGESPATH.$drinks[$index]->pictureURL?>" alt="<?=$drinks[$index]->altText?>">

                    <div class="square-lower">
                        <div class="square-lower-elemets">
                            <?=$burger[$index]->price?> 
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

    <form method="POST">
        <input style="display:none;" type="text" name="category" value="drinks">
        <button class="more-Button" type="submit" name="more" value="more">Alle Getränke</button>
    </form>

    <br>

    <h2>Desserts</h2>
    <span>
        <p class="category-description">"Sei kein Wüstenschiff. Kaufe unsere süßen, leckeren Bio-Desserts. Honig statt Zucker und natürlich alles Vollkorn."</p>
    </span>
    
    
    <div class="body-content">
        <?php
            for($index = 0; $index < 3; $index++)
            {
                if($desserts[$index] != null){
                    ?>
                    <div class="square">

                        <h3 class="square-headline"><?=$desserts[$index]->description?></h3>

                        <img class="square-picture" src="<?=IMAGESPATH.$desserts[$index]->pictureURL?>" alt="<?=$desserts[$index]->altText?>">

                        <div class="square-lower">
                    
                            <div class="square-lower-elemets">
                                <?=$desserts[$index]->price?> 
                            </div>
                            <div class="square-lower-elemets">
                                <button class="addToCard-Button">In den<br>Einkaufswagen</button>
                            </div>
                        </div>
                    
                    </div>
                <?php  
                }
                
            }
            ?>
    </div>

    <form method="POST">
        <input style="display:none;" type="text" name="category" value="desserts">
        <button class="more-Button" type="submit" name="more" value="more">Alle Desserts</button>
    </form>
    <br>
</div>
</body>
</html>