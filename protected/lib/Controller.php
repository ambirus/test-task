<?php

namespace lib;

abstract class Controller
{
    public function __construct()
    {
        if (method_exists($this, 'init'))
            $this->init(); 
    }
}