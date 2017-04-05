<?php

namespace Myrtle\Core\System\Console\Commands;

use Illuminate\Console\Command;

class UpdateMyrtleCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:name';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        // todo: develop composer plugin that checks config() for update = true, so that we can leverage composer but composer can't be directly run from the command line?
        // todo: how will this affect developers?
        // set can run composer value in Config to true
    }
}
