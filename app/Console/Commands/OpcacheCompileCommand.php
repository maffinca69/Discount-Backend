<?php


namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Finder\Finder;

class OpcacheCompileCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'opcache:compile';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'OPcache compile files';

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
        if (function_exists('opcache_compile_file')) {

            $files = collect(
                Finder::create()->in(config('opcache.directories'))
                    ->name('*.php')
                    ->ignoreUnreadableDirs()
                    ->notContains('#!/usr/bin/env php')
                    ->exclude(config('opcache.exclude'))
                    ->files()
                    ->followLinks()
            );

            $progressBar = $this->output->createProgressBar(count($files));

            // optimized files
            $files->each(function ($file) use (&$compiled, $progressBar) {
                    if (!opcache_is_script_cached($file)) {
                        opcache_compile_file($file);
                        $progressBar->advance();
                    }
                }
            );
            $progressBar->finish();
            $this->line(PHP_EOL . 'All files is compiled!');
        } else {
            $this->error('Function opcache_compile_file not exists. OPcache is not configured');
        }
    }
}
