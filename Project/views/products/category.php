<!-- GET chosen Category (MainDish, Sides, Drinks or Desserts from $_SESSION['category'])
        and display all corresponding Items -->

        
<div class="products-body">

    <div class="products-header">
        <div class="products-subheader">
            <h1><?=$preloadHeader['title']?></h1>
            <p><?=$preloadHeader['description']?>
            <!--<?=print_r($products)?>-->
            </p>
        </div>

        <label class="toggleProductFilter" for="toggleProductFilter">Burger filtern</label>
        <input type="checkbox" id="toggleProductFilter">

        <div class="product-filter">
            <form method="GET">
                <input type="hidden" name="c" value="products">
                <input type="hidden" name="a" value="category">

                <div class="tabs">
                    <div class="tab">
                        <input class="tabControl" type="radio" id="tab-1" name="tab-group-1" checked>
                        <label for="tab-1">Foot Type</label>

                        <div class="filter-content">
                            <input type="radio" name="foodtype" id="vegan" value="vegan"
                                <?=isset($preloadFilter['foodtype']) && $preloadFilter['foodtype']==="vegan"  ? 'checked' : ""?>>
                            <label for="vegan">Vegan</label>
                            <br>
                            <input type="radio" name="foodtype" id="veggie" value="veggie"
                                <?=isset($preloadFilter['foodtype']) && $preloadFilter['foodtype']==="veggie"  ? 'checked' : ""?>>
                            <label for="veggie">Vegetarisch</label>
                            <br>
                            <input type="radio" name="foodtype" id="omni" value="omni"
                                <?=!isset($preloadFilter['foodtype']) ? 'checked' : ""?>>
                            <label for="omni">Omnivore</label>

                        </div>
                    </div>

                    <div class="tab">
                        <input class="tabControl" type="radio" id="tab-2" name="tab-group-1">
                        <label for="tab-2">Kategorie</label>

                        <div class="filter-content">

                            <input type="checkbox" name="f[]" id="burger" value="burger"
                                <?=isset($preloadFilter['category']) && in_array("burger", $preloadFilter['category']) ? 'checked' : ""?>>
                            <label for="burger">Burger</label>

                            <input type="checkbox" name="f[]" id="snacks" value="snacks"
                                <?=isset($preloadFilter['category']) && in_array("snacks", $preloadFilter['category'])  ? 'checked' : ""?>>
                            <label for="snacks">Snacks</label>

                            <input type="checkbox" name="f[]" id="drinks" value="drinks"
                                <?=isset($preloadFilter['category']) && in_array("drinks", $preloadFilter['category'])  ? 'checked' : ""?>>
                            <label for="drinks">Getränke</label>

                            <input type="checkbox" name="f[]" id="desserts" value="desserts"
                                <?=isset($preloadFilter['category']) && in_array("desserts", $preloadFilter['category'])  ? 'checked' : ""?>>
                            <label for="desserts">Desserts</label>

                        </div>
                    </div>

                    <div class="tab">
                        <input class="tabControl" type="radio" id="tab-3" name="tab-group-1">
                        <label for="tab-3">Zutaten</label>


                        <div class="filter-content">
                            <?php
                            foreach($preloadFilter['ingredients'] as $ingredients):
                            ?>
                                <input type="checkbox" name="ingredients[]" value="<?=htmlspecialchars($ingredients->ingredientsId)?>" id="<?=htmlspecialchars($ingredients->description)?>"
                                    <?php
                                    if(isset($preloadFilter['ingredientsChecked']) && !empty($preloadFilter['ingredientsChecked'])):
                                        foreach($preloadFilter['ingredientsChecked'] as $checkedItem):
                                    ?>    
                                            <?=$checkedItem == $ingredients->ingredientsId ? "checked" : ""?>
                                    <?php
                                        endforeach;
                                    endif;
                                    ?>
                                
                                >
                                <label for="<?=htmlspecialchars($ingredients->description)?>"><?=htmlspecialchars($ingredients->description)?></label>
                                <br>
                            <?php
                            endforeach;
                            ?>
                        </div>
                    </div>

                    <div class="tab">
                        <input class="tabControl" type="radio" id="tab-4" name="tab-group-1">
                        <label for="tab-4">Preis</label>


                        <div class="filter-content">
                            
                            <label for="">Minimalpreis</label>
                            <br>
                            <input type="range" step="1" name="minPrice" value="<?=isset($preloadFilter['minPrice']) ? $preloadFilter['minPrice'] : "0"?>" min="0" max="20" oninput="this.nextElementSibling.value = this.value">
                            <output><?=isset($preloadFilter['minPrice']) ? $preloadFilter['minPrice'] : "0"?></output><label for="">€</label>
                            <br>
                            <label for="">Maximalpreis</label>
                            <br>
                            <input type="range" step="1" name="maxPrice" value="<?=isset($preloadFilter['maxPrice']) ? $preloadFilter['minPrice'] : "0"?>" min="0" max="20" oninput="this.nextElementSibling.value = this.value">
                            <output><?=isset($preloadFilter['maxPrice']) ? $preloadFilter['maxPrice'] : "20"?></output><label for="">€</label>
                        </div>
                    </div>
                    
                </div>

                <input type="submit" name="resetAllFilter"  value="Alle Filter zurücksetzen">
                <input type="submit" name="setFilter"       value="Filter anwenden">
            </form>

          
        </div>
    </div>

    <div class="body-content">

        <?php

        for($index = 0; $index < count($preloadProducts); $index++)
        {
        ?>
        <div class = "square">
        
            <h3 class="square-headline"><?=htmlspecialchars($preloadProducts[$index]->description)?></h3>

            <div class = "picture-square">
                <a href=<?=htmlspecialchars("index.php?c=products&a=product&f=".$preloadProducts[$index]->productsId)?>><img class="square-picture"  src="<?=IMAGESPATH.$preloadProducts[$index]->pictureURL?>" alt="<?=htmlspecialchars($preloadProducts[$index]->altText)?>"></a>
            </div>

            <div class="square-lower">
               
                <div class="square-lower-elemets">
                            <?=htmlspecialchars($preloadProducts[$index]->price)?>
                </div>
                <div class="square-lower-elemets">
                    <form method="POST">
                        <input style="display:none;" type="text" name="productsId" value="<?=htmlspecialchars($preloadProducts[$index]->productsId)?>">
                        <button class="addToCard-Button" type="submit" name="addToCart" value="addToCart">In den<br>Einkaufswagen</button>
                    </form>
                </div>
            </div>

        </div> 
        <?php 
        }
        ?>
    </div>
</div>
