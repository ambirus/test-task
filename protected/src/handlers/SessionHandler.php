<?php

namespace src\handlers;

use src\models\entities\Session;
use src\notifiers\JsonNotifier;

class SessionHandler
{
    public function handle(array $params)
    {
        $sessionData = (new Session())->readBySessionId($params);
        $jsonNotifier = new JsonNotifier();

        if (sizeof($sessionData) > 0) {
            if ($sessionData['Capacity'] > 0) {
                return $sessionData['Capacity'];
            } else $jsonNotifier->ok('Извините, все места заняты!');

        } else $jsonNotifier->fail('Сессия не найдена!');

        exit;
    }
}