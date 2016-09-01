<?php

namespace App\Controllers\Base;

use Silex\Application;

class BaseUsersController extends BaseController
{

    protected $service;
    protected $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }




}
