<!-- GET chosen Category (MainDish, Sides, Drinks or Desserts from $_SESSION['category'])
        and display all corresponding Items -->

        
<div class="products-body">

    <div class="products-header">
    <h1><?=$title?></h1>
    <p><?=$description?>
    <!-- <?=print_r($products)?> -->
    </p>

    <div class="productFilter">
        <label for="toggleProductFilter">Burger filtern</label>
        <input type="checkbox" id="toggleProductFilter">

        

        <form action="burger.php" method="GET">
            <label for="patty">Patty</label>
            <select id="patty" name="patty">
                <option value="beef">Beef</option>
                <option value="pork">Schwein</option>
                <option value="chicken">Chicken</option>
                <option value="vegitarian">Vegetarisch</option>
                <option value="vegan">Vegan</option>
            </select>
            <label for="alergies">Alergene</label>
            <select name="alergies" id="alergies">
                <option value="mustard">Senf</option>
                <option value="pickels">Gurke</option>
            </select>
            <label for="ingredients">Zutatenauswahl</label>
                <input type="checkbox" id="tomatoes" name="tomatoes">
                <label class="labelIngedients" for="tomatoes">Tomaten</label>
                <input type="checkbox" id="cheese" name="cheese">
                <label class="labelIngedients" for="cheese">Käse</label>
                <input type="checkbox" id="pickels" name="pickels">
                <label class="labelIngedients" for="pickels">Gurken</label>
            <input type="reset" value="Reset">
            <input type="submit" value="Submit">
        </form>
    </div>
    </div>

    <div class="body-content">

    <?php

        for($index = 0; $index < count($products); $index++)
        {
        ?>
        <div class = "square">
        
            <h3 class="square-headline"><?=$products[$index][0]->description?></h3>

            <img class="square-picture" src="<?=IMAGESPATH.$products[$index][0]->pictureURL?>" alt="<?=$products[$index]->altText?>">

            <div class="square-lower">
               
                <div class="square-lower-elemets">
                            <?=$products[$index][0]->price?>
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
