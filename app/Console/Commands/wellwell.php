<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class wellwell extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'wellwell';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Hii ishhhhhhhhh.');

        $this->fail('Something went wrong.');
    }
}
