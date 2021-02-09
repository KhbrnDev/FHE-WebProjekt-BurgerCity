<?php



namespace dwp\model;
use \dwp\core\Model as M;

class OrderItems extends \dwp\core\Model
{
    const TABLENAME = 'OrderItems';

    protected $schema = [
        'ordersItemsId' => [ 'type' => M::TYPE_INTEGER ],
        'createdAt' => [ 'type' => M::TYPE_STRING],
        'updatedAt' => [ 'type' => M::TYPE_STRING],
        'quantity' => [ 'type' => M::TYPE_INTEGER ],
        'Products_productsId' => [ 'type' => M::TYPE_INTEGER ],
        'Orders_orderId' => [ 'type' => M::TYPE_INTEGER ],

    ];
}