<?php

namespace App\Controllers\Client;

use App\Controllers\Base\BaseUsersController;
use Silex\Application;
use App\Schema\UsersSchema;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;


class UsersController extends BaseUsersController
{

    protected $userSchema;

    public function __construct(Application $app, $service)
    {
        parent::__construct($app);
        $this->service = $service;
        $this->userSchema = new UsersSchema();

    }

    public function getAll()
    {

        //return new JsonResponse($this->usersService->getAll());
        return $this->userSchema->all($this->service->getAll());
    }

    /**
     * GET /profile/get/{user_id}
     *
     * Return user by id
     *
     */
    public function get(Request $request, $user_id)
    {
        
        return $this->userSchema->user($userData);
    }

    /**
     * Updating user profile
     *
     * @param Request $request
     * @return json
     */
    public function update(Request $request)
    {

        $updateStatus = false;


        //Assertion example
        $validateSchema = new Assert\Collection(array(
            'fields' => array(
                'email'                 => new Assert\Email()
                'external_web_site'     => array(new Assert\Type('string'), new Assert\Url),
            ),
            'allowMissingFields' => true,
        ));

        $validate = $this->app['validator']->validate($request->request->all(), $validateSchema);

        /**
         * Validate post params
         */
        if ($validate->count() > 0) {

            $this->app['log']->warning($validate);
            return $this->userSchema->invalidParams();
        }


        return $this->userSchema->update($updateStatus);
    }

    /**
     * adding a like to a user
     *
     * @param $user_id - this the user_id of the person that checked like
     * @return JSON
     */

    public function addLike($user_id){

        return $this->userSchema->update($result);
    }

    /**
     * GET /profile/search
     *
     * Searches for a person
     *
     * @param $request
     *
     * @return JSON
     */
    public function getSearchPerson(Request $request) {

        $queryParams = $request->query->all();


        return $this->userSchema->userSearch($result);
    }

    /**
     * GET /profile/users/likes/{user_id}
     *
     * @param Request $request
     * @param $user_id
     *
     * @return array
     */
    public function getLikes(Request $request, $user_id){


        return $this->userSchema->likes($likesData);
    }
}
