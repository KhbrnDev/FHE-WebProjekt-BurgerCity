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
		$category = isset($_GET['f']) ? $_GET['f'] : null ;

		if($category !== null)
		{
			getCategoryInformation($title, $description, $category);
		}
		// FILTERS
		// we always filter

		$preloadProducts = \dwp\model\Products::find();

		if(isset($_GET['f']))
		{
			
			switch($_GET['f'])
			{
				case 'burger':
				case 'snacks':
				case 'drinks':
				case 'desserts':
					$products = [];
					for($int = 0; $int < count($preloadProducts); $int++)
					{
						if($preloadProducts[$int]->category === $_GET['f'])
						{
							$products [] = $preloadProducts[$int];
						}
					}
					$preloadProducts = $products;
					$preloadFilter['category'] = $_GET['f'];
					break;
				default;
					break;
			}
		}
		
		if(isset($_GET['foodType']))
		{
					$productsHelper = \dwp\model\ProductHelper::find();
					$ingredients = \dwp\model\Ingredients::find();
					$products = [];
					if($_GET['foodType'] == 'vegan')
					{
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
											echo $ingredient->foodtype ."<br>";
											$isVegan = false;
										}
									}
									
								}
							}
							if($isVegan)
									{
										echo $preloadProducts[$int]->description;
										$products [] = $preloadProducts[$int];
									}
						}
						
					}
					$preloadProducts = $products;




					/*
					foreach($productsHelper as $helper)
					{
						foreach($ingredients as $ingredient)
						{
							if($helper->Ingredients_ingedientsId == $ingredient->ingedientsid)
							{
								switch($_GET['foodType'])
								{
									case 'vegan':
										if($ingredient->foodtype == 'veggie' || $ingredient->foodtype == 'omnivore')
										{
											//echo "food";
											$products = $preloadProducts;
											for($int = 0; $int < count($preloadProducts); $int++)
											{
												if($preloadProducts[$int]->productsId == $helper->Products_productsId)
												{
													echo "<pre>";
													print_r( $products[$int]);
													echo "</pre>";
													echo $preloadProducts[$int]->productsId;
													echo 
													array_splice($products,$int,1);
												}
											}
											$preloadProducts = $products;
										}
										break;
									case 'veggie':
										if($ingredient->foodtype == 'omnivore')
										{
											//echo "food";
											$products = $preloadProducts;
											for($int = 0; $int < count($preloadProducts); $int++)
											{
												if($preloadProducts[$int]->productsId == $helper->Products_productsId)
												{
													array_splice($products,$int,1);
												}
											}
											$preloadProducts = $products;
										}
										break;
									case 'omni':
										break;
								}
							}
						}
					}
					*/
					

		}
		


		
		
		// PRELOAD DATA
		// preload $preloadFilter
		$preloadFilter['maxPrice'] = isset($preloadProducts[0]) ? $preloadProducts[0]->price : ""; 
		foreach($preloadProducts as $product)
		{
			if($preloadFilter['maxPrice'] < $product->price)
			{
				$preloadFilter['maxPrice'] = $product->price;
			}
		}
		
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