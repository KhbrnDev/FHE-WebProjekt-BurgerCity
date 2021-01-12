<?php



namespace dwp\model;
use \dwp\core\Model as M;

class Address extends \dwp\core\Model
{
    const TABLENAME = 'Address';

    protected $schema = [
        'AddressId' => [ 'type' => M::TYPE_INTEGER ],
        'createdAt' => [ 'type' => M::TYPE_STRING],
        'updatedAt' => [ 'type' => M::TYPE_STRING],
        'zipCode' => [ 'type' => M::TYPE_STRING, 'max' => 12 ],
        'city' => [ 'type' => M::TYPE_STRING, 'max' => 60 ],
        'street' => [ 'type' => M::TYPE_STRING, 'max' => 200 ],
        'number' => [ 'type' => M::TYPE_STRING, 'max' => 10],

    ];
}