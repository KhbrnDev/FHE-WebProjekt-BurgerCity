<?php



namespace dwp\model;
use \dwp\core\Model as M;

class Adress extends \dwp\core\Model
{
    const TABLENAME = 'Adress';

    protected $schema = [
        'AdressId' => [ 'type' => M::TYPE_INTEGER ],
        'createdAt' => [ 'type' => M::TYPE_STRING],
        'updatedAt' => [ 'type' => M::TYPE_STRING],
        'zipCode' => [ 'type' => M::TYPE_STRING, 'max' => 12 ],
        'city' => [ 'type' => M::TYPE_STRING 'max' => 60 ],
        'street' => [ 'type' => M::TYPE_STRING 'max' => 200 ],
        'number' => [ 'type' => M::TYPE_STRING 'max' => 10],
              
        
        
            ],
        ],
    ];
}