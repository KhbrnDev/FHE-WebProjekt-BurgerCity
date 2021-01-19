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
        'Products_productsId' => [ 'type' => M::TYPE_INTEGER ],
        'Ingedients_ingedientsId' => [ 'type' => M::TYPE_INTEGER ],

    ];
}