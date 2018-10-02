<?php

namespace lib;

class Config
{
    public static function get($file = null)
    {
        $configPath = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR;

        if ($file === null) {

            $configFiles = glob($configPath . '*.{php}', GLOB_BRACE);

            if (sizeof($configFiles) > 0) {

                foreach ($configFiles as $configFile) {
                    $key = str_replace([$configPath, '.php'], '', $configFile);
                    $configArr[$key] = include $configFile;
                }

                return $configArr;

            } else throw new \Exception("No configs files found!");

        } else {

           if (file_exists($configPath . $file . '.php')) {

               return include $configPath . $file . '.php';

           } else throw new \Exception("Config file `" . $file . "` is not found!");

        }
    }
}