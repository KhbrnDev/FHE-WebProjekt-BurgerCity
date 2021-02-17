<?php



namespace dwp\model;
use \dwp\core\Model as M;

class Products extends \dwp\core\Model
{
    const TABLENAME = 'Products';

    protected $schema = [
        'productsId' => [ 'type' => M::TYPE_INTEGER ],
        'createdAt' => [ 'type' => M::TYPE_STRING],
        'updatedAt' => [ 'type' => M::TYPE_STRING],
        'description' => [ 'type' => M::TYPE_STRING, 'max' => 255],
        'pictureURL' => [ 'type' => M::TYPE_STRING, 'max' => 255],
        'altText' => [ 'type' => M::TYPE_STRING, 'max' => 255],
        'favorites' => [ 'type' => M::TYPE_BOOLEAN ],
        'price' => [ 'type' => M::TYPE_FLOAT ],
        'category' => [ 'type' => M::TYPE_STRING, 'max' => 45]

    ];
}