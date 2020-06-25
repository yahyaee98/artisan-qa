<?php

namespace App\Console\Commands\QAndA;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ResetCommand extends Command
{
    protected $signature = 'qanda:reset';
    protected $description = 'Resets progress.';

    public function handle()
    {
        if ($this->confirm(__('qanda.reset_are_you_sure'))) {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            DB::table('practices')->truncate();
            DB::table('answers')->truncate();
            DB::table('questions')->truncate();
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');

            $this->info(__('qanda.database_cleared'));
        }
    }
}
