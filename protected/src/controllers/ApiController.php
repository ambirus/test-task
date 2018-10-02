<?php

namespace src\controllers;

use src\handlers\AllowedTableHandler;
use src\handlers\SessionHandler;
use src\handlers\SessionSubscriberHandler;
use src\handlers\UserHandler;

class ApiController extends PostController
{
    public function actionTable(array $params)
    {
        (new AllowedTableHandler())->handle($params);
    }

    public function actionSessionSubscribe(array $params)
    {
        (new UserHandler())->handle($params);
        $sessionCapacity = (new SessionHandler())->handle($params);
        (new SessionSubscriberHandler())->handle($params, $sessionCapacity);
    }
}