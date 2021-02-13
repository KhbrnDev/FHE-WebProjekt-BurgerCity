<?php


namespace dwp\controller;


class ProductsController extends \dwp\core\Controller
{
	public function actionCategory()
	{
		//we need to find out what category has been chosen.
		if(isset($_GET['f']))
		{
			$category = $_GET['f'];
			$title = null; 
			$description = null; 
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
					echo "something went wrong";
			}

			$products = \dwp\model\Products::find("category = " . $GLOBALS['db']->quote($category));
			
			$this->setParam('title', $title);
			$this->setParam('description', $description);
			$this->setParam('products', $products);
		}
		else
		{
			//insert error handling
		}
		/*$_SESSION['cart'] = [
			'productId => $id,
			'anzahl'   => $anzahl
		]
			*/

		

		//then we load all Products of that Category


	}

	public function actionMenue()
	{
		
	}

	public function actionProduct()
	{
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