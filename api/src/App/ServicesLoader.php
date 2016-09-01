<?php

namespace App;

use Silex\Application;

class ServicesLoader
{
    protected $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * Inject classes to services
     */
    public function bindServicesIntoContainer()
    {
        $this->app['users.service'] = $this->app->share(function () {

            return new Services\UsersService($this->app["db"],$this->app["log"],array_get($this->app,"requestUserID",0 ), array_get($this->app,'token',null));
        });

        //Here you can add more sevice instantiations like the user.service above

    }
}

