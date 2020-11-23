<?php


namespace App\Console\Commands;


use Illuminate\Console\Command;

class OpcacheClearCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'opcache:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Opcache reset';

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
     */
    public function handle()
    {
        if (function_exists('opcache_reset')) {
            opcache_reset();
            $this->line('OPcache reset!');
            return;
        }

        $this->error('OPcache is not configured');
    }
}
