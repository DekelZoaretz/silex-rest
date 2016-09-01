<?php

namespace App\Controllers\Base;

use Silex\Application;

class BaseController
{

    /**
     * App instance
     * @var Application
     */
    protected $app;

    /**
     * Base construct for all application
     * BaseController constructor.
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }




}
