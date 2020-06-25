<?php

namespace App\Console;

use Illuminate\Console\Command;

/**
 * a Repeatable command is a command where it can be run indefinitely until the command terminates the loop.
 */
abstract class RepeatableCommand extends Command
{
    public function handle()
    {
        do {
            $shouldContinue = $this->render();
        } while ($shouldContinue);
    }

    abstract public function render(): bool;
}
