<div class="start-content">




    
    <div class="burgercitycontainer">
        <img class="startpicture" src="<?=IMAGESPATH.'title_picture.png'?>", alt="title_picture.png">
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
        

<img class="startpicture" src="<?=IMAGESPATH.'burger_start.png'?>" alt="burgerstart.png">
 </div>


<div>
    <br><br><br><br>
<h4>Empfehlung des Hauses</h4>
    <h3>Die beliebtesten Burger dieser Woche</h3>
    <div class="body-content" class="burgertext">
        <?php
            for($index = 0; $index < 3; $index++)
            {
                ?>
                <div class="square">

                    <h3 class="square-headline"><?=$burger[$index]->description?></h3>

                    <img class="square-picture" src="<?=IMAGESPATH.$burger[$index]->pictureURL?>" alt="<?=$burger[$index]->altText?>">

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
            <img class="startpicture" src="<?=IMAGESPATH.'restaurant_start.png'?>" alt="burgershop.png">
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