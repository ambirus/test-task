<?php

namespace lib\routers;

use Exception;
use lib\Config;

class WebRouter
{
    public function execute()
    {
        $controllerName = 'Index';
        $actionName = 'Index';
        $actionParams = [];                
        $routeParts = explode('/', $_SERVER['REQUEST_URI']);

        if (!empty($routeParts[1])) {
            $controllerName = ucfirst($routeParts[1]);
        }

        if (!empty($routeParts[2]))	{
            $actionName = $routeParts[2];

            if ($pos = strpos($routeParts[2], '?')) {
                $actionName = substr($routeParts[2], 0, $pos);
                $queryParams = substr($routeParts[2], $pos + 1);
            }

            $actionName = ucfirst($actionName);
        }

        if (!empty($queryParams)) {
            $params = explode('&', $queryParams);

            foreach ($params as $param) {
                $tmp = explode('=', $param);
                $actionParams[$tmp[0]] = isset($tmp[1]) ? $tmp[1] : null;
            }            
        }

        $controllerName = $controllerName . 'Controller';
        $actionName = 'action' . $actionName;
        $namespaceController = 'src\\controllers\\' . $controllerName;

        if (class_exists($namespaceController)) {
            $controller = new $namespaceController;
        } else throw new Exception(__CLASS__ .': ' . 'No such class &laquo;' . $namespaceController . '&raquo;');
            
        if (method_exists($controller, $actionName)) {
            $controller->$actionName($actionParams);
        } else throw new Exception(__CLASS__ .': ' . 'No such controller action &laquo;' . $actionName . '&raquo;');
    }
}
