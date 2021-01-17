
<div class="products-content">

    <h1>Burger</h1>
    <p>Wir haben so tolle Burger. Jeder Burger wird mit Liebe und 100% natürlichen Zutaten zubereitet.
            Das Beef kommt von Bio-Kücken aus der Region. 
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

    <div class="body-content">
        <?php
            for($Index = 0; $Index < 12; $Index++)
            {
            ?>
                <div class="square">
                    <img class="square-picture" src="burger1.png" alt="">
                    
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
</div>  
