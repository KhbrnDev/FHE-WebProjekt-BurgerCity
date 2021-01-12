<?php



namespace dwp\model;
use \dwp\core\Model as M;

class ProductHelper extends \dwp\core\Model
{
    const TABLENAME = 'ProductHelper';

    protected $schema = [
        'productHelperId' => [ 'type' => M::TYPE_INTEGER ],
        'createdAt' => [ 'type' => M::TYPE_STRING],
        'updatedAt' => [ 'type' => M::TYPE_STRING],
        'productId' => [ 'type' => M::TYPE_INTEGER ],
        'ingredientsId' => [ 'type' => M::TYPE_INTEGER ],

    ];
}