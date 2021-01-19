<?php



namespace dwp\model;
use \dwp\core\Model as M;

class Category extends \dwp\core\Model
{
    const TABLENAME = 'Category';

    protected $schema = [
        'categoryId' => [ 'type' => M::TYPE_INTEGER ],
        'createdAt' => [ 'type' => M::TYPE_STRING],
        'updatedAt' => [ 'type' => M::TYPE_STRING],
        'categoryName' => [ 'type' => M::TYPE_STRING, 'max' => 255 ],
        'description' => [ 'type' => M::TYPE_STRING, 'max' => 45 ],

    ];
}