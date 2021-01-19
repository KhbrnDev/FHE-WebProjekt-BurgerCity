<?php



namespace dwp\model;
use \dwp\core\Model as M;

class Adress extends \dwp\core\Model
{
    const TABLENAME = 'Adress';

    protected $schema = [
        'adressId' => [ 'type' => M::TYPE_INTEGER ],
        'createdAt' => [ 'type' => M::TYPE_STRING],
        'updatedAt' => [ 'type' => M::TYPE_STRING],
        'zipCode' => [ 'type' => M::TYPE_STRING, 'max' => 12 ],
        'city' => [ 'type' => M::TYPE_STRING, 'max' => 60 ],
        'street' => [ 'type' => M::TYPE_STRING, 'max' => 200 ],
        'number' => [ 'type' => M::TYPE_STRING, 'max' => 10],

    ];

    public static function validateStreet($street, &$errors = [])
    {

    }

    public static function validateNumber($number, &$errors = [])
    {

    }

    public static function validateZipCode($zipCode, &$errors = [])
    {

    }

    public static function validateCity($city, &$errors = [])
    {

    }

    public static function findAdress($adressData)
    {
        return findOne("'street' = " . $adressData['street'] .
                " AND 'city' = " . $adressData['city'] .
                " AND 'number' = " . $adressData['number'] .
                " AND 'zipCode' = " . $adressData['zipCode']);
    }
}