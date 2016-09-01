<?php

namespace App\Cli\Task;


use Carbon\Carbon;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputOption;

use App\Services;

class ClearLogs extends BaseTask {


    public function __construct($dbInstance){

        parent::__construct($dbInstance);
        
    }
    
    protected function configure()
    {
        $dayBefore = 7;

        $this->setName("log:clear")
            ->setDescription("Clear log table X day before (default $dayBefore day ago)")
            ->setDefinition(array(
                new InputOption('dayBefore', 's', InputOption::VALUE_OPTIONAL, 'Default delete days before', $dayBefore),
            ));
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $uid = uniqid();
        $error = "";
        $this->log->addCli($uid,$input->getOptions(),0);
        $dayBefore = intval($input->getOption('dayBefore'));

         try{
             $queryBuilder = $this->db->createQueryBuilder();
             $queryBuilder->delete('logs')
                 ->where('created_at < ' . $queryBuilder->createNamedParameter(Carbon::now()->subDays($dayBefore)))
                 ->execute();
                 ;
         }
         catch (\Exception $e)
         {
             $error = $e->getMessage();
         }
        $this->log->addCli($uid,$input->getOptions(),1, $error);
        //$output->writeln($dayBefore);
    }
}