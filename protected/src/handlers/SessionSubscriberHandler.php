<?php

namespace src\handlers;

use src\models\entities\SessionSubscriber;
use src\models\entities\Session;
use src\notifiers\JsonNotifier;

class SessionSubscriberHandler
{
    public function handle(array $params, int $oldCapacity)
    {
        $res = (new SessionSubscriber())->create($params);
        $jsonNotifier = new JsonNotifier();

        if ($res > 0) {
            $res = (new Session())->update([
                'Capacity' => $oldCapacity - 1
            ], $params['sessionId']);
            if ($res) {
                $jsonNotifier->ok('Спасибо, вы успешно записаны!');
            } else $jsonNotifier->fail('Ошибка обновления сессии!');

        } else $jsonNotifier->fail('Ошибка добавления подписчика!');

        exit;
    }
}