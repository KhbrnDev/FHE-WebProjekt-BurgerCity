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
                <button> Mehr Burger</button>
            </div>
    </div>


    <h2>Beilagen</h2>
    <span>
        <p>Unsere Beilagen sind... Lorem ipsum dolor sit amet consectetur adipisicing elit. Illum cupiditate quidem suscipit cum delectus dolorum illo totam rem exercitationem accusantium ut laudantium ipsa dolore, facere accusamus consequuntur odit commodi expedita.</p>
        <a href="#">Mehr Burger</a>
    </span>
    <div class="body-content">
        <?php
            for($Index = 0; $Index < 3; $Index++)
            {
                ?>
                <div class="square">
                    <img class="square-picture" src="<?=IMAGESPATH.'burger1.png'?>" alt="">

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
            <div class="square">
                <img class="speisekarte-arrow" src="../assets/images/speisekarte-arrow.svg" alt="">
                <p class="speisekarte-arrow-p">Hier geht es zu weiteren leckeren Burgern</p>
            </div>
    </div>

    <span>
        <p>Unsere Hausgemachten Getränke sind... Lorem ipsum dolor sit amet consectetur adipisicing elit. Illum cupiditate quidem suscipit cum delectus dolorum illo totam rem exercitationem accusantium ut laudantium ipsa dolore, facere accusamus consequuntur odit commodi expedita.</p>
        <a href="#">Mehr Getränke</a>
    </span>
    <div class="body-content">
        <?php
            for($Index = 0; $Index < 3; $Index++)
            {
                ?>
                <div class="square">
                    <img class="square-picture" src="../assets/images/burger1.png" alt="">

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
    <span>
        <p>Unsere Desserts sind... Lorem ipsum dolor sit amet consectetur adipisicing elit. Illum cupiditate quidem suscipit cum delectus dolorum illo totam rem exercitationem accusantium ut laudantium ipsa dolore, facere accusamus consequuntur odit commodi expedita.</p>
        <a href="#">Mehr Desserts</a>
    </span>
    
    
    <div class="body-content">
        <?php
            for($Index = 0; $Index < 3; $Index++)
            {
                ?>
                <div class="square">
                    <img class="square-picture" src="../assets/images/burger1.png" alt="">

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
</div>
</body>
</html>