<?php

namespace src\handlers;

use src\models\EntityFactory;
use src\notifiers\JsonNotifier;
use src\models\entities\AllowedTable;

class AllowedTableHandler
{
    public function handle(array $params)
    {
        $allowedTables = (new AllowedTable())->readByTableName($params);
        $jsonNotifier = new JsonNotifier();

        if (sizeof($allowedTables) > 0) {
            $tableEntity = (new EntityFactory())->createEntity($params['table']);
            $payload = $tableEntity->read(isset($params['id']) ? $params['id'] : null);

            $jsonNotifier->ok('Данные', $payload);

        } else $jsonNotifier->fail('Нет прав для просмотра этой таблицы!');

        exit;
    }
}