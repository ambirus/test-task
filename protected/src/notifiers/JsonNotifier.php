<?php

namespace src\notifiers;

class JsonNotifier
{
    public function ok(string $message = '', array $payload = [])
    {
        echo json_encode([
            'status' => 'ok',
            'payload' => $payload,
            'message' => $message
        ]);
    }

    public function fail(string $message = '')
    {
        echo json_encode([
            'status' => 'fail',
            'message' => $message
        ]);
    }
}