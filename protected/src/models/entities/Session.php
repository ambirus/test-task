<?php

namespace src\models\entities;

use Exception;

class Session extends TableEntity
{
    protected $tableName = 'session';

    public function readBySessionId(array $params) : array
    {
        if (!isset($params['sessionId']))
            throw new Exception('Missing required parameter `sessionId`!');

        $sql = $sql = 'SELECT * FROM `' . $this->tableName . '` WHERE ID = :sessionId FOR UPDATE';
        $query = $this->db->prepare($sql);
        $query->execute([':sessionId' => $params['sessionId']]);
        $res = $query->fetch();

        return ($res === false) ? [] : $res;
    }
}