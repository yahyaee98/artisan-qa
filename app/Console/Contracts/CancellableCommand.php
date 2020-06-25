<?php

namespace App\Console\Contracts;

interface CancellableCommand
{
    public function askWithCancel(string $question): ?string;
}
