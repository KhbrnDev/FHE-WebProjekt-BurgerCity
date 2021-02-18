<!-- GET chosen Category (MainDish, Sides, Drinks or Desserts from $_SESSION['category'])
        and display all corresponding Items -->

        
<div class="products-body">

    <div class="products-header">
        <div class="products-subheader">
            <h1><?=$title?></h1>
            <p><?=$description?>
            <!--<?=print_r($products)?>-->
            </p>
        </div>

        <label class="toggleProductFilter" for="toggleProductFilter">Burger filtern</label>
        <input type="checkbox" id="toggleProductFilter">

        <div class="product-filter">
            <form method="GET">
                <input type="hidden" name="c" value="products">
                <input type="hidden" name="a" value="category">
                <input type="hidden" name="f" value="<?=$preloadFilter['category']?>">

                <div class="tabs">
                    <div class="tab">
                        <input class="tabControl" type="radio" id="tab-1" name="tab-group-1" checked>
                        <label for="tab-1">Foot Type</label>

                        <div class="filter-content">
                            <input type="radio" name="foodType" id="vegan" value="vegan">
                            <label for="vegan">Vegan</label>
                            <br>
                            <input type="radio" name="foodType" id="veggie" value="veggie">
                            <label for="veggie">Vegetarisch</label>
                            <br>
                            <input type="radio" name="foodType" id="omni" value="omni">
                            <label for="omni">omnivore</label>

                        </div>
                    </div>

                    <div class="tab">
                        <input class="tabControl" type="radio" id="tab-2" name="tab-group-1">
                        <label for="tab-2">Kategorie</label>

                        <div class="filter-content">

                            <input type="checkbox" name="category" id="burger" value="burger">
                            <label for="burger">Burger</label>

                            <input type="checkbox" name="category" id="snacks" value="snacks">
                            <label for="snacks">Snacks</label>

                            <input type="checkbox" name="category" id="drinks" value="drinks">
                            <label for="drinks">Getränke</label>

                            <input type="checkbox" name="category" id="dessert" value="dessert">
                            <label for="dessert">Desserts</label>

                        </div>
                    </div>

                    <div class="tab">
                        <input class="tabControl" type="radio" id="tab-3" name="tab-group-1">
                        <label for="tab-3">Zutaten</label>


                        <div class="filter-content">
                            
                        </div>
                    </div>

                    <div class="tab">
                        <input class="tabControl" type="radio" id="tab-4" name="tab-group-1">
                        <label for="tab-4">Preis</label>


                        <div class="filter-content">
                            <input type="range">
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
        
            <h3 class="square-headline"><?=$preloadProducts[$index]['description']?></h3>

            <div class = "picture-square">
                <a href=<?="index.php?c=products&a=product&f=".$preloadProducts[$index]['productsId']?>><img class="square-picture"  src="<?=IMAGESPATH.$preloadProducts[$index]['pictureURL']?>" alt="<?=$preloadProducts[$index]['altText']?>"></a>
            </div>

            <div class="square-lower">
               
                <div class="square-lower-elemets">
                            <?=$preloadProducts[$index]['price']?>
                </div>
                <div class="square-lower-elemets">
                    <form method="POST">
                        <input style="display:none;" type="text" name="productsId" value="<?=$preloadProducts[$index]['productsId']?>">
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
