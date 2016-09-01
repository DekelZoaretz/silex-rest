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

    /**
     * Default user fields to return
     *
     * @var string
     */
    private $userFields = 'user.id,user.first_name,user.last_name,user.mobile,user.email,user.unit,user.birth_date,user.membership_date,user.fb_profile_id,user.fb_url,user.about_me,user.external_web_site,user.image,user.video';

    public function __construct($db, $logInstance, $userId = false, $token = "")
    {
        parent::__construct($db);
        $this->token = $token;
        $this->userId = $userId;
        $this->log = $logInstance;
    }

}
