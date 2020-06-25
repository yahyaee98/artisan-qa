<?php

namespace App\Console;

use App\Console\Contracts\CancellableCommand;

/**
 * InputSuite can be used to ease the process of asking multiple questions in a row while it takes care of
 * cancellation when the user enters a blank value.
 */
class InputSuite
{
    private $questions;

    public function __construct(array $questions)
    {
        $this->questions = $questions;
    }

    public function run(CancellableCommand $command): ?array
    {
        $result = [];

        foreach ($this->questions as $name => $title) {
            $answer = $command->askWithCancel($title);
            if (!$answer) {
                return null;
            }
            $result[$name] = $answer;
        }

        return $result;
    }
}
