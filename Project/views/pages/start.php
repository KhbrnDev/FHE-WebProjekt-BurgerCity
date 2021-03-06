<div class="start-content">




    
    <div class="burgercitycontainer">
        <img class="startpicture" src="<?=IMAGESPATH.'title_picture.png'?>", alt="Dunkler hintergrung mit gewürzen und anderen kochuntensilien , die wie aufkleber an den Seiten wirken">
        <div class="burgercitycentered">
            <h1 class="burgertitle">Burger City</h1>        
            <h3>Dein Burgerrestaurant</h3>
         </div>
    </div>
    <br><br>
    
    <p>Bei BurgerCity servieren wir dir Burger wie sie sein sollen: <br>
    frisch, saftig und cheesy mit handgemachten Zutaten in einem fluffigen Bun,<br>
     ohne viel TamTam! Unsere Motivation ist bis heute eine große Leidenschaft für qualitativ hochwertiges, schnelles Essen, serviert in einer warmen, gemütlichen Atmosphäre.<br>
      Diese Liebe und Überzeugung zu unseren Produkten lässt sie uns mit einem großen Lächeln servieren.&#9786;<br><br></p>






      <div class="burgertext">
        
        <p class="info"><br><br>Jeder Burger wird im leckeren Weizen- oder Vollkornbrötchen,<br>
     mit knackigem Salat, frischen Zwiebeln, sonnengereiften Tomaten <br>
     und unserer hausgemachten Hamburgersauce zubereitet.<br><br><br>
    </p>
        

<img class="startpicture" src="<?=IMAGESPATH.'burger_start.png'?>" alt="Burger mit gegrillten Paprika, Spief in der mitte und Bacon an der Seite">
 </div>


<div>
    <br><br><br><br>
<h2>Empfehlung des Hauses</h2>
    <h4>Die beliebtesten Burger dieser Woche</h4>
    <div class="body-content" class="burgertext">
        <?php
            for($index = 0; $index < 3; $index++)
            {
                ?>
                <div class="square">

                    <h3 class="square-headline"><?=$burger[$index]->description?></h3>

                    <div class = "picture-square">
                            <a href=<?=htmlspecialchars("index.php?c=products&a=product&f=".$burger[$index]->productsId)?>><img class="square-picture"  src="<?=IMAGESPATH.$burger[$index]->pictureURL?>" alt="<?=htmlspecialchars($burger[$index]->altText)?>"></a>
                        </div>

                    <div class="square-lower">
                        <div class="square-lower-elemets">
                            </div>
                        <div class="square-lower-elemets">
                            
                        </div>
                    </div>
                </div>
                <?php  
            }
            ?>
            
    </div>
        </div>


    	<div>
    <h2>Hier sind wir für dich da</h2>
            <div class="container">
            <img class="startpicture" src="<?=IMAGESPATH.'restaurant_start.png'?>" alt="Burgerladen mit blauen Stühlen und altem Ambiente">
    <div class="centered">
        <br>     
    <table class="tableopenings">
                <tr>
                    <td>Montag:<br><br></td>
                    <td>Ruhetag<br><br>         
                    </td>
                </tr>
                <tr>
                    <td>Dienstag:<br><br></td>
                    <td>12.00-22.00 Uhr<br><br></td>
                </tr>
                <tr>
                    <td>Mittwoch:<br><br></td>
                    <td>12.00-22.00 Uhr<br><br></td>
                </tr>
                <tr>
                    <td>Donnerstag:<br><br></td>
                    <td>12.00-22.00 Uhr<br><br></td>
                </tr>
                <tr>
                    <td>Freitag:<br><br></td>
                    <td>13.00-2.00 Uhr<br><br></td>
                </tr>
                <tr>
                     <td>Samstag:<br><br></td>
                    <td>10.00-2.00 Uhr<br><br></td>
                </tr>
                <tr>
                    <td>Sonntag:<br><br></td>
                    <td>12.00-22.00 Uhr<br><br></td>
                </tr>
                <tr>
                <td><b></b>
                </td></tr>
            </table>
            <p><b>*Aufgrund der aktuellen Lage sind nur Bestellungen möglich</b></p>
        </div>
        </div>

           
           
                
        </div>
               
            
   
</div>