<?php

namespace App;

use Silex\Application;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;


class RoutesLoader
{
    private $app;

    /**
     *
     * RoutesLoader constructor.
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->instantiateControllers();

        /**
         * Token validation
         */
        $this->app['security.client.validateToken'] = $app->protect(function () {


            $request = Request::createFromGlobals();
            if (!$this->app['token']->isClientValidToken()) {
                $this->app['log']->error("Token is invalid user id - {$request->headers->get('user-id')}, token - {$request->headers->get('token')}");
                $errorSchema = new \App\Schema\ErrorSchema();
                return new JsonResponse($errorSchema->notAuthorized(), 401);
            }

            $this->app['requestUserID'] = $request->headers->get('user-id');
            $this->app['requestDeviceID'] = $request->headers->get('device-id');

        });


    }


    /**
     * Routing files deceleration
     */
    private function instantiateControllers()
    {
        $this->app['authentication.controller'] = $this->app->share(function () {
            return new Controllers\Client\AuthenticationController($this->app, $this->app['users.service']);
        });

        $this->app['users.controller'] = $this->app->share(function () {
            return new Controllers\Client\UsersController($this->app, $this->app['users.service']);
        });

    }

    /**
     * All routs in application
     */
    public function bindRoutesToControllers()
    {

        /**
         * All url`s that we need to check token validation
         */
        $registerUser = $this->app["controllers_factory"];

        /**
         * Free api call`s (without token validation)
         */
        $unRegisterUser = $this->app["controllers_factory"];

        /**
         * login
         */
        $unRegisterUser->post('/signin', "authentication.controller:sign_in");
        $registerUser->post('/signout', "authentication.controller:sign_out");


        /**
         * Profile
         */
        $registerUser->post('/profile/like/add/{user_id}', "users.controller:addLike");
        $registerUser->post('/profile/update', "users.controller:update");
        $registerUser->get('/profile/search', "users.controller:getSearchPerson");
        $registerUser->get('/profile/', "users.controller:getAll");
        $registerUser->get('/profile/get/{user_id}', "users.controller:get");
        $registerUser->get('/profile/users/likes/{user_id}', "users.controller:getLikes");


        /**
         * Adding before function to all routes that need token validation
         */
        $registerUser->before($this->app['security.client.validateToken']);

        $this->app->mount($this->app["api.endpoint"], $registerUser);


    }
}

