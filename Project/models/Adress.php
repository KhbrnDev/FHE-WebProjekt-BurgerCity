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
        // to be added later
    }

    public static function validateNumber($number, &$errors = [])
    {
        // to be added later
    }

    public static function validateZipCode($zipCode, &$errors = [])
    {
        // to be added later
    }

    public static function validateCity($city, &$errors = [])
    {
        // to be added later
    }

    public static function findAdress($adressData)
    {
        return parent::findOne("street = " . $GLOBALS['db']->quote($adressData['street']) .
                " AND city = " . $GLOBALS['db']->quote($adressData['city']) .
                " AND number = " . $GLOBALS['db']->quote($adressData['number']) .
                " AND zipCode = " . $GLOBALS['db']->quote($adressData['zipCode']));
    }
}