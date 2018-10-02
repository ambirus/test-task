<?php

namespace src\models\entities;

use Exception;

class Participant extends TableEntity
{
    protected $tableName = 'participant';

    public function readByEmail(array $params) : array
    {
        if (!isset($params['userEmail']))
            throw new Exception('Missing required parameter `userEmail`!');

        $sql = $sql = 'SELECT * FROM `' . $this->tableName . '` WHERE Email = :email';
        $query = $this->db->prepare($sql);
        $query->execute([':email' => $params['userEmail']]);
        $res = $query->fetch();

        return ($res === false) ? [] : $res;
    }
}