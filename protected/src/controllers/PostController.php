<?php

namespace src\controllers;

use lib\Controller;

class PostController extends Controller
{
    public function init()
    {
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            throw new \Exception('Post request required!');
        }
    }
}