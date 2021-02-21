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
		$preloadHeader = [];
		

		

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
		
		// FILTERS
		// we always filter

		$preloadProducts = \dwp\model\Products::find();
		if(isset($_GET['resetAllFilter']))
		{
			header("Location: index.php?c=products&a=category");
		}

		if(isset($_GET['f'])) // DONE
		{
			$products = [];

			$categoryArray = is_array($_GET['f']) ? $_GET['f'] : [$_GET['f']];
			foreach($categoryArray as $category)
			{
				switch($category)
				{
					case 'burger':
					case 'snacks':
					case 'drinks':
					case 'desserts':
						for($int = 0; $int < count($preloadProducts); $int++)
						{
							if($preloadProducts[$int]->category === $category)
							{
								$products [] = $preloadProducts[$int];
							}
						}
						$preloadFilter['category'] [] = $category;
						break;
					default;
						break;
				}
			}
			$preloadProducts = $products;
				
		}
		
		if(isset($_GET['foodtype'])) // DONE
		{
			$productsHelper = \dwp\model\ProductHelper::find();
			$ingredients = \dwp\model\Ingredients::find();
			
			switch($_GET['foodtype'])
			{
				case 'veggie':
				case 'vegan':
					$preloadFilter['foodtype'] = $_GET['foodtype'];
					$products = [];
					for($int = 0; $int < count($preloadProducts); $int++)
					{
						$isVegan = true;
						foreach($productsHelper as $helper)
						{
							if($helper->Products_productsId == $preloadProducts[$int]->productsId)
							{
								foreach($ingredients as $ingredient)
								{
									if($ingredient->ingredientsId == $helper->Ingredients_ingredientsId
									&& $helper->Products_productsId == $preloadProducts[$int]->productsId
									&& $ingredient->foodtype != 'vegan')
									{
										if($_GET['foodtype'] == 'vegan')
										{
											$isVegan = false;
										}
										elseif($_GET['foodtype'] == 'veggie' && $ingredient->foodtype == 'omnivore')
										{
											$isVegan = false;
										}
									}
								}
								
							}
						}
						if($isVegan)
						{
							$products [] = $preloadProducts[$int];
						}
					}
					$preloadProducts = $products;
					break;
				default:
					break;
			}
		}

		if(isset($_GET['minPrice'])) // DONE
		{
			if(!empty($_GET['minPrice']))
			{
				
				$preloadFilter['minPrice'] = $_GET['minPrice'];
				$products = [];
				for($int = 0; $int < count($preloadProducts); $int++)
				{
					if($preloadProducts[$int]->price > $_GET['minPrice'])
					{
						$products [] = $preloadProducts[$int];
					}
				}
				$preloadProducts = $products;
			}
		}

		if(isset($_GET['maxPrice'])) // DONE
		{
			if(!empty($_GET['maxPrice']))
			{
				$preloadFilter['maxPrice'] = $_GET['maxPrice'];
				$products = [];
				for($int = 0; $int < count($preloadProducts); $int++)
				{
					if($preloadProducts[$int]->price < $_GET['maxPrice'])
					{
						$products [] = $preloadProducts[$int];
					}
				}
				$preloadProducts = $products;
			}
		}

		if(isset($_GET['ingredients'])) // DONE
		{
			if(!empty($_GET['ingredients']))
			{
				$products = [];
				$productsHelper = \dwp\model\ProductHelper::find();
				foreach($preloadProducts as $product)
				{
					$isItem = 0;
					foreach($productsHelper as $helper)
					{
						if($helper->Products_productsId == $product->productsId)
						{
							foreach($_GET['ingredients'] as $ingredientId)
							{
								if($ingredientId == $helper->Ingredients_ingredientsId)
								{
									$isItem += 1;
								}
							}
						}
					}	
					if($isItem == count($_GET['ingredients']))
					{
						$products [] = $product;
					}
				}
				$preloadProducts = $products;
			}
		}

		// PRELOAD DATA
		// preload page header
		$category = (isset($_GET['f']) && is_array($_GET['f']) && count($_GET['f']) === 1) ? $_GET['f'][0] : null;
		getCategoryInformation($preloadHeader['title'], $preloadHeader['description'], $category);

		//preload Ingredients
		$preloadFilter['ingredients'] = \dwp\model\Ingredients::find();
		$preloadFilter['ingredientsChecked'] = isset($_GET['ingredients']) ? $_GET['ingredients'] : "";

		// push to view
		$this->setParam('preloadFilter', $preloadFilter);
		$this->setParam('preloadHeader', $preloadHeader);
		$this->setParam('preloadProducts', $preloadProducts);
	
	}

	public function actionMenue()
	{
		if(isset($_POST['more']))
		{
			$category = isset($_POST['category']) ? $_POST['category'] : null; 
			if($category !== null)
			{
				header("Location: index.php?c=products&a=category&f=".$category);
			}
		}

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
