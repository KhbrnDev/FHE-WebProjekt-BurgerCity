<div class="menu-body">
    
    <!--  -->
    <h1>Speisekarte</h1>
    <p>Entecke unsere neuartigen, innovativen Produkte. Hier ist für alle was dabei!</p>

    <h2>Burger</h2>
    <span>
        <p>Wir haben so tolle Burger. Jeder Burger wird mit Liebe und 100% natürlichen Zutaten zubereitet.
					Das Beef kommt von Bio-Kücken aus der Region.</p>
        <a href="index.php?c=products&a=category&f=burger">Mehr Burger</a>
    </span>
    <div class="body-content">
        <?php
            for($index = 0; $index < 3; $index++)
            {
                ?>
                <div class="square">
                    <img class="square-picture" src="<?=IMAGESPATH.$burger[$index]->pictureURL?>" alt="<?=$burger[$index]->altText?>">

                    <div class="square-lower">
                        <div class="square-lower-elements square-lower-elements-description">
                            <p style="margin: 0;"><?=$burger[$index]->description?></p>
                        </div>
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
            <div class="square">
                <!-- <img class="speisekarte-arrow" src="../assets/images/speisekarte-arrow.svg" alt=""> -->
                <p class="speisekarte-arrow-p">Hier geht es zu weiteren leckeren Burgern</p>
                Hier geht es zu weiteren leckeren Burgern
                <br>
                <a href="index.php?c=products&a=category&f=burger"> <button type="submit">Mehr Burger</button> </a>

                
            </div>
    </div>


    <h2>Snacks</h2>
    <span>
        <p>Snacks sind lecker, weil man sie so gut snacken kann. Bestelle auch du dir jetzt deine snackbaren Snacks.</p>
        <a href="index.php?c=products&a=category&f=snacks">Mehr Snacks</a>
    </span>
    <div class="body-content">
        <?php
            for($index = 0; $index < 3; $index++)
            {
                ?>
                <div class="square">
                    <img class="square-picture" src="<?=IMAGESPATH.$snacks[$index]->pictureURL?>" alt="<?=$snacks[$index]->altText?>">

                    <div class="square-lower">
                        <div class="square-lower-elements square-lower-elements-description">
                            <p style="margin: 0;"><?=$snacks[$index]->description?></p>
                        </div>
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
            <div class="square">
                <img class="speisekarte-arrow" src="../assets/images/speisekarte-arrow.svg" alt="">
                <p class="speisekarte-arrow-p" href="index.php?c=products&a=category&f=snacks">Hier geht es zu weiteren leckeren Snacks</p>
            </div>
    </div>

    <span>
        <p>"Der Mensch braucht Wasser. Am besten mit viel Zucker und Farbstoffen drin. Und damit es auch nach was schmeckt, haben wir unseren Getränken exklusive Geschmackstoffe zugesetzt. Natürlich 100% vegan, weil 100% synthetisch. Das Getränk von Morgen erwartet dich."</p>
        <a href="index.php?c=products&a=category&f=drinks">Mehr Getränke</a>
    </span>
    <div class="body-content">
        <?php
            for($index = 0; $index < 3; $index++)
            {
                ?>
                <div class="square">
                    <img class="square-picture" src="<?=IMAGESPATH.$drinks[$index]->pictureURL?>" alt="<?=$drinks[$index]->altText?>">

                    <div class="square-lower">
                        <div class="square-lower-elements square-lower-elements-description">
                            <p style="margin: 0;"><?=$drinks[$index]->description?></p>
                        </div>
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
    <span>
        <p>"Sei kein Wüstenschiff. Kaufe unsere süßen, leckeren Bio-Desserts. Honig statt Zucker und natürlich alles Vollkorn."</p>
        <a href="index.php?c=products&a=category&f=desserts">Mehr Desserts</a>
    </span>
    
    
    <div class="body-content">
        <?php
            for($index = 0; $index < 3; $index++)
            {
                if($desserts[$index] != null){
                    ?>
                    <div class="square">
                        <img class="square-picture" src="<?=IMAGESPATH.$desserts[$index]->pictureURL?>" alt="<?=$desserts[$index]->altText?>">

                        <div class="square-lower">
                            <div class="square-lower-elements square-lower-elements-description">
                                <p style="margin: 0;"><?=$desserts[$index]->description?></p>
                            </div>
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
</div>
</body>
</html>