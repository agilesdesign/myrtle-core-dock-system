<?php

namespace Myrtle\Core\System\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class InstallMyrtleCommand extends Command
{
    protected $db;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'myrtle:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install Myrtle WMS';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->databasePrompt();
        $this->databaseTestConnection();
        $this->databaseExists();


        // if not reprompt for credentials

        Artisan::call('session:table');
        Artisan::call('migrate');
        // publich docks config file
    }

    /**
     * @param $db
     */
    protected function databasePrompt()
    {
        $this->db['driver'] = $this->choice('Driver', ['mysql']);
        $this->db['host'] = $this->ask('Host:');
        $this->db['user'] = $this->ask('User:');
        $this->db['password'] = $this->secret('Password:');
        $this->db['database'] = $this->secret('Database:');
    }

    protected function databaseTestConnection()
    {
        if(! $connected = false)
        {
            $this->databasePrompt();
        }
    }

    protected function databaseConnectFailed()
    {
        $this->handle();
    }

    protected function databaseExists()
    {
        if($database = true == true)
        {
            // display message that database exists
            return;
        }
        if($canCreate = true == true)
        {
            // display message database can be created
            $this->createDatabase();
            return;
        }
        $this->handle();
    }

    protected function createDatabase()
    {
        
    }
}
