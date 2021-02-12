<?php



namespace dwp\model;
use \dwp\core\Model as M;

class Ingredients extends \dwp\core\Model
{
    const TABLENAME = 'Ingredients';

    protected $schema = [
        'ingredientsId' => [ 'type' => M::TYPE_INTEGER ],
        'createdAt' => [ 'type' => M::TYPE_STRING],
        'updatedAt' => [ 'type' => M::TYPE_STRING],
        'description' => [ 'type' => M::TYPE_STRING, 'max' => 255 ],
        'foodtype' => [ 'type' => M::TYPE_STRING ],
        
    ];
}