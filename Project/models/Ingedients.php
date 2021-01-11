<?php



namespace dwp\model;
use \dwp\core\Model as M;

class ProductHelper extends \dwp\core\Model
{
    const TABLENAME = 'ProductHelper';

    protected $schema = [
        'ingedientsId' => [ 'type' => M::TYPE_INTEGER ],
        'createdAt' => [ 'type' => M::TYPE_STRING],
        'updatedAt' => [ 'type' => M::TYPE_STRING],
        'description' => [ 'type' => M::TYPE_STRING 'max' => 255 ],
        'numberOfStock' => [ 'type' => M::TYPE_INTEGER ],
        
        
            ],
        ],
    ];
}