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
				case "Burger":
					$title = "Burger";
					$description = "Wir haben so tolle Burger. Jeder Burger wird mit Liebe und 100% natürlichen Zutaten zubereitet.
					Das Beef kommt von Bio-Kücken aus der Region.";
					$id = '1'; 
					break;
				case "Snacks":
					$title = "Snacks";
					$description = "Snacks sind lecker, weil man sie so gut snacken kann. Bestelle auch du dir jetzt deine snackbaren Snacks.";
					$id = '2'; 
					break;
				case "Drinks":
					$title = "Drinks";
					$description = "Der Mensch braucht Wasser. Am besten mit viel Zucker und Farbstoffen drin. Und damit es auch nach was schmeckt, haben wir unseren Getränken exklusive Geschmackstoffe zugesetzt. Natürlich 100% vegan, weil 100% synthetisch. Das Getränk von Morgen erwartet dich.";
					$id = '4'; 
					break;
				case "Desserts":
					$title = "Desserts";
					$description = "Sei kein Wüstenschiff. Kaufe unsere süßen, leckeren Bio-Desserts. Honig statt Zucker und natürlich alles Vollkorn.";
					$id = '3'; 
					break;
				default:
					echo "something went wrong";
			}

			$productIDs = \dwp\model\CategoryHelper::find("Category_categoryId = " . $id);

			$products = array();
		
			foreach ($productIDs as $value) {
				$products[] = \dwp\model\Products::find("productsId = " . $value->Products_productsId);
			}

			$this->setParam('title', $title);
			$this->setParam('description', $description);
			$this->setParam('products', $products);
		}
		else
		{
			//insert error handling
		}



		

		//then we load all Products of that Category


	}

	public function actionMenue()
	{
		
	}

	public function actionProduct()
	{
		
	}

}