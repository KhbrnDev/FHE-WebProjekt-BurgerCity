<?php



namespace dwp\model;
use \dwp\core\Model as M;

class CategoryHelper extends \dwp\core\Model
{
    const TABLENAME = 'CategoryHelper';

    protected $schema = [
        'CategoryHelperId' => [ 'type' => M::TYPE_INTEGER ],
        'createdAt' => [ 'type' => M::TYPE_STRING],
        'updatedAt' => [ 'type' => M::TYPE_STRING],
        'Category_categoryId' => [ 'type' => M::TYPE_INTEGER ],
        'Products_productsId' => [ 'type' => M::TYPE_INTEGER ],
                
            ],
        ],
    ];
}