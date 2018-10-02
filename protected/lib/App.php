<?php

namespace lib;

use lib\routers\WebRouter;

class App
{
    public function run()
    {
        (new WebRouter())->execute();
    }

}