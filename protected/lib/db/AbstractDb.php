<?php

namespace lib\db;

abstract class AbstractDb
{
    protected $pdo;

    public function get()
    {
        return $this->pdo;
    }
}