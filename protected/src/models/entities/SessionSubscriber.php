<?php

namespace src\models\entities;

use Exception;

class SessionSubscriber extends TableEntity
{
    protected $tableName = 'sessionsubscribers';

    public function create(array $data): int
    {
        if (!isset($data['userEmail']))
            throw new Exception('Missing required parameter `userEmail`!');

        if (!isset($data['sessionId']))
            throw new Exception('Missing required parameter `sessionId`!');

        return parent::create($data); // TODO: Change the autogenerated stub
    }
}