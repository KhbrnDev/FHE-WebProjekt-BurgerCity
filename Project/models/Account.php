<?php



namespace dwp\model;
use \dwp\core\Model as M;

class Account extends \dwp\core\Model
{
    const TABLENAME = 'Account';

    protected $schema = [
        'accountId' => [ 'type' => M::TYPE_INTEGER ],
        'createdAt' => [ 'type' => M::TYPE_STRING],
        'updatedAt' => [ 'type' => M::TYPE_STRING],
        'email' => [ 'type' => M::TYPE_STRING 'max' => 320 ],
        'passwordHash' => [ 'type' => M::TYPE_STRING 'max' => 255 ],
        'birthday' => [ 'type' => M::TYPE_DATE ],
        'firstName' => [ 'type' => M::TYPE_STRING ],
        'lastName' => [ 'type' => M::TYPE_STRING ],
        'phoneNumber' => [ 'type' => M::TYPE_STRING ],
        'isAdmin' => [ 'type' => M::TYPE_BOOLEAN ],
        

        
            ],
        ],
    ];
}