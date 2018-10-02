<?php

namespace src\models\entities;

use Exception;

class AllowedTable extends TableEntity
{
    protected $tableName = 'allowedtables';

    public function readByTableName(array $params) : array
    {
        if (!isset($params['table']))
            throw new Exception('Missing required parameter `table`!');

            $sql = 'SELECT id FROM `' . $this->tableName . '` WHERE TableName = :tableName';
            $query = $this->db->prepare($sql);
            $query->execute([':tableName' => $params['table']]);
            $res = $query->fetch();

            return ($res === false) ? [] : $res;
    }
}