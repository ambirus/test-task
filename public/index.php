<?php

include __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'protected' . DIRECTORY_SEPARATOR . 'bootstrap.php';

use lib\App;
use src\notifiers\JsonNotifier;

try {
    $app = new App();
    $app->run();
} catch (Exception $e) {
    (new JsonNotifier())->fail('Application error: ' . $e->getMessage());
}