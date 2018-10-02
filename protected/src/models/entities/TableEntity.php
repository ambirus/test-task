<?php

namespace src\models\entities;

use lib\db\Database;
use Exception;

abstract class TableEntity
{
	protected $db;
	protected $tableName;

	public function __construct()
	{
	    if ($this->tableName === null)
	        throw new Exception('Table name is required!');

		$this->db = Database::getInstance();
	}

	public function create(array $data) : int
    {
        $keys = $aliases = $values = [];

        foreach ($data as $k => $v) {
            $keys[] = $k;
            $aliases[] = ':' . $k;
            $values[':' . $k] = $v;
        }

        $sql = "INSERT INTO `" . $this->tableName . "` (" . implode(", ", $keys) . ") VALUES (" . implode(", ", $aliases) . ")";

        $query = $this->db->prepare($sql);
        $query->execute($values);

        return $this->db->lastInsertId();
    }

    public function read(int $id = null) : array
    {
        if ($id !== null) {
            $sql = $sql = 'SELECT * FROM `' . $this->tableName . '` WHERE ID = :id';
            $query = $this->db->prepare($sql);
            $query->execute([':id' => $id]);
            $res = $query->fetch();
        } else {
            $sql = 'SELECT * FROM `' . $this->tableName . '`';
            $query = $this->db->prepare($sql);
            $query->execute();

            while ($answer = $query->fetch()) {
                $res[] = $answer;
            }
        }

        return (!isset($res) || $res === false) ? [] : $res;
    }

    public function update(array $data, int $id) : bool
    {
        $aliases = $values = [];

        foreach ($data as $k => $v) {
            $aliases[] = $k .'=' . ':' . $k;
            $values[':' . $k] = $v;
        }

        $values[':id'] = $id;
        $sql = "UPDATE `" . $this->tableName . "` SET " . implode(", ", $aliases) . "  WHERE id = :id";
        $query = $this->db->prepare($sql);

        return $query->execute($values);

    }
}