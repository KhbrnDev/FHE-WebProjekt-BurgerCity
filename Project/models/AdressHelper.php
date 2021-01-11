<?php



namespace dwp\model;
use \dwp\core\Model as M;

class AdressHelper extends \dwp\core\Model
{
    const TABLENAME = 'AdressHelper';

    protected $schema = [
        'adressHelperId' => [ 'type' => M::TYPE_INTEGER ],
        'createdAt' => [ 'type' => M::TYPE_STRING],
        'updatedAt' => [ 'type' => M::TYPE_STRING],
        'addressId' => [ 'type' => M::TYPE_INTEGER ],
        'Account_accountId' => [ 'type' => M::TYPE_INTEGER ],
        
              
        
        
            ],
        ],
    ];
}