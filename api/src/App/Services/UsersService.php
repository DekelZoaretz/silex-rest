<?php

namespace App\Services;


class UsersService extends BaseService
{

    /**
     * User caller
     *
     * @var
     */
    protected $userId;

    /**
     * Log instance
     *
     * @var
     */
    protected $log;

    /**
     * User token generated
     * @var
     */
    protected $token;

    public function __construct($db, $logInstance, $userId = false, $token = "")
    {
        parent::__construct($db);
        $this->token = $token;
        $this->userId = $userId;
        $this->log = $logInstance;
    }

}
