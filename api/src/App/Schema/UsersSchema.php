<?php

namespace App\Schema;

use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;


class UsersSchema extends BaseSchema
{
    public function __construct()
    {
        parent::__construct();

    }

    public function all($users)
    {

        $resource = new Collection($users, function (array $user) {
            return [
                'id' => (int)$user['id'],
                'name' => $user['name'],
            ];
        });
        return $this->fractal->createData($resource)->toJson();
    }
}
