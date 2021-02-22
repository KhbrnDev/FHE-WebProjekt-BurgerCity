<div class="menu-body">
   
    <h1>Speisekarte</h1>
    <p>Entecke unsere neuartigen, innovativen Produkte. Hier ist für alle was dabei!</p>

    <?php foreach($preloadProducts as $key => $products):?>
    <h2><?=$preloadProductsHelper[$key]['title']?></h2>
        <span>
            <p class="category-description"><?=$preloadProductsHelper[$key]['description']?></p>
        </span>


        <div class="body-content">
            <?php
            $index = 0;
                while($index < count($products) && $index < 3):
                    ?>
                    <div class="square">

                        <h3 class="square-headline"><?=$products[$index]->description?></h3>

                        <img class="square-picture" src="<?=IMAGESPATH.$products[$index]->pictureURL?>" alt="<?=$products[$index]->altText?>">

                        <div class="square-lower">
                            <div class="square-lower-elemets">
                                <?=$products[$index]->price?>
                            </div>
                            <div class="square-lower-elemets">
                                <form method="POST">
                                    <input style="display:none;" type="text" name="productsId" value="<?=htmlspecialchars($products[$index]->productsId)?>">
                                    <button class="addToCard-Button" type="submit" name="addToCart" value="addToCart">In den<br>Einkaufswagen</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php  
                $index++;
                endwhile;
                ?>
        </div>

        <form method="POST">
            <input style="display:none;" type="text" name="category" value="<?=$key?>">
            <button class="more-Button" type="submit" name="more" value="more">Alle <?=ucfirst($key)?></button>
        </form>

        <br>
    <?php endforeach;?>


</div>
