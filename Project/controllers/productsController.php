<?php


namespace dwp\controller;


class ProductsController extends \dwp\core\Controller
{
	public function actionCategory()
	{
		$db = $GLOBALS['db'];
		// DECLARE PRELOADING
		$errors = [];
		$preloadFilter = [];
		$preloadProducts = [];

		// ADD TO CART
		// TODO ? eine Anzahl über Einkaufswagen in den Header machen, die dynmisch erhöht wird?
		if(isset($_POST['addToCart']))
		{
			$productsId = isset($_POST['productsId']) ? $_POST['productsId'] : null;

			if($productsId !== null)
			{
				if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0)
				{
					$itemExists = false;
					for($int = 0; $int < count($_SESSION['cart']); $int++)
					{
						if($_SESSION['cart'][$int]['productsId'] === $productsId)
						{
							$_SESSION['cart'][$int]['quantity'] += 1;
							$itemExists = true;
						}
					}

					if(!$itemExists)
					{
						$_SESSION['cart'] [] = 
							[
								'productsId' => $productsId,
								'quantity'   => 1
							];
					}
				}
				else
				{
					$_SESSION['cart'] = [];

					$_SESSION['cart'] [] = 
					[
						'productsId' => $productsId,
						'quantity'   => 1    
					];
				}
			}	
			else
			{
				$errors ['title'] = "Bitte nicht an den ID's herumspielen";
			}

			cleanEinkaufswagen();
		}
		// Get Title and Description -> could be moved to functions.php (might be needed in menue.php and start.php [no dublicated content])
		$title = null; 
		$description = null;
		$category = $_GET['f'];
		switch($category)
		{
			case "burger":
				$title = "Burger";
				$description = "Wir haben so tolle Burger. Jeder Burger wird mit Liebe und 100% natürlichen Zutaten zubereitet.
				Das Beef kommt von Bio-Kücken aus der Region.";
				break;
			case "snacks":
				$title = "Snacks";
				$description = "Snacks sind lecker, weil man sie so gut snacken kann. Bestelle auch du dir jetzt deine snackbaren Snacks.";
				break;
			case "drinks":
				$title = "Drinks";
				$description = "Der Mensch braucht Wasser. Am besten mit viel Zucker und Farbstoffen drin. Und damit es auch nach was schmeckt, haben wir unseren Getränken exklusive Geschmackstoffe zugesetzt. Natürlich 100% vegan, weil 100% synthetisch. Das Getränk von Morgen erwartet dich.";
				break;
			case "desserts":
				$title = "Desserts";
				$description = "Sei kein Wüstenschiff. Kaufe unsere süßen, leckeren Bio-Desserts. Honig statt Zucker und natürlich alles Vollkorn.";
				break;
			default:
				$title = "Produkte";
				$description = "Wir haben super Produkte. Kaufe jetzt Produkte und du bekommst Produkte.";
				break;
		}
		$category = $_GET['f'];
		// FILTERS
		// we always filter
		$sql = "SELECT DISTINCT p.productsId, p.description, p.pictureURL, p.altText, p.favorites, p.price, p.category
				FROM `ingredients` i
		 		join `producthelper` ph on i.ingredientsId = ph.Ingredients_ingredientsId
				right join `products` p on p.productsId = ph.Products_productsId where ";
		$whereClause = "";

		if(isset($_GET['foodType']))
		{
			// TODO schöne SQL abfragen machen oder Objekt erstellen
			switch($_GET['foodType'])
			{
				case 'vegan':
				case 'veggie':
				case 'omni':
					$whereClause .= "foodType = " . $db->quote($_GET['foodType']) . " and ";
					break;
				default:
					// !?!?!!1
					break;
			}
		}
		// muss als letztes stehen, da abschließende Klausel wegen dem 'and'
		if(isset($_GET['category']))
		{
			switch($_GET['category'])
			{
				case 'burger':
				case 'snacks':
				case 'drinks':
				case 'desserts':
					$whereClause .= "  category = " . $db->quote($_GET['f']) . "and ";
					break;
				default;
					break;
			}
		}
		else
		{
			$whereClause .= " 1 and ";
		}

		if(!empty($whereClause))
		{
			$whereClause = trim($whereClause, 'and ');
		}
		else
		{
			$sql = trim($sql, 'where ');
		}
		
		$sql .= $whereClause;
		echo $sql;
		$preloadProducts = $db->query($sql)->fetchAll();
		
		
		
		$preloadFilter['category'] = $category;
		// PRELOAD DATA
		
		$this->setParam('preloadFilter', $preloadFilter);
		$this->setParam('title', $title);
		$this->setParam('description', $description);
		$this->setParam('preloadProducts', $preloadProducts);
	
	}

	public function actionMenue()
	{
		$burger = \dwp\model\Products::find("category = " . $GLOBALS['db']->quote("burger"));
		$snacks = \dwp\model\Products::find("category = " . $GLOBALS['db']->quote("snacks"));
		$drinks = \dwp\model\Products::find("category = " . $GLOBALS['db']->quote("drinks"));
		$desserts = \dwp\model\Products::find("category = " . $GLOBALS['db']->quote("desserts"));

		$this->setParam('burger', $burger);
		$this->setParam('snacks', $snacks);
		$this->setParam('drinks', $drinks);
		$this->setParam('desserts', $desserts);

	}

	public function actionProduct()
	{
		if(isset($_POST['addToWarenkorb'])){
			
		}
		$id = $_GET['f'];
		$product = \dwp\model\Products::findOne("productsId = " . $GLOBALS['db']->quote($id));
		$ingredientsIDs = \dwp\model\ProductHelper::find("Products_productsId = " . $GLOBALS['db']->quote($id));
		$ingredients = array();
		foreach ($ingredientsIDs as $idValue) {
			$ingredient = \dwp\model\Ingredients::findOne("ingredientsId = " . $GLOBALS['db']->quote($idValue->Ingredients_ingredientsId));
			$ingredients[]= $ingredient;
		}
		$this->setParam('product', $product);
		$this->setParam('ingredients', $ingredients);
	}

}