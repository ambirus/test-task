<?php

namespace src\handlers;

use src\models\entities\Participant;
use src\notifiers\JsonNotifier;

class UserHandler
{
    public function handle(array $params)
    {
        $userData = (new Participant())->readByEmail($params);

        if (sizeof($userData) == 0) {
            (new JsonNotifier())->fail('Пользователь не найден!');
            exit;
        }
    }
}