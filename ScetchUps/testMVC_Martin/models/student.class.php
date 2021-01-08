<?php

class Student extends \dwp\core\Model
{
    const TABLENAME = '`student`';

    protected $schema = [
        'id'            => [ 'type' => \dwp\core\Model::TYPE_INTEGER],
        'createdAt'     => [ 'type' => \dwp\core\Model::TYPE_STRING],
        'updatedAt'     => [ 'type' => \dwp\core\Model::TYPE_STRING],
        'email'         => [ 'type' => \dwp\core\Model::TYPE_STRING, 'max' => 320],
        'password'      => [ 'type' => \dwp\core\Model::TYPE_STRING, 'max' => 60]
    ];

    public function doStuff()
    {
        $this->data['password'] = '123456789012345678901234567890123456789012345678901234567890123456789014234640648406516514684694651604640651406514065840665846804658406540684';
    }

}