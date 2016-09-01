<?php

namespace App\Cli\Task;


use Symfony\Component\Console\Command\Command;
use App\Services;

class BaseTask extends Command {

    protected $log;
    
    public function __construct($dbInstance){

        parent::__construct();
        $this->db = $dbInstance;
        $this->log = new \App\Services\LogService($dbInstance);
    }

}