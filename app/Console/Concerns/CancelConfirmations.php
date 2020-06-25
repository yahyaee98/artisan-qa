<?php

namespace App\Console\Concerns;

trait CancelConfirmations
{
    /**
     * Ask user the question and confirm exit if he/she responded with blank.
     */
    public function askWithCancel(string $question): ?string
    {
        do {
            $answer = $this->ask($question . __('qanda.can_cancel_title'));
        } while (!$answer && !$this->confirmsCancel());

        return $answer;
    }

    public function askWithCompletionAndCancel($question, array $choices)
    {
        do {
            $answer = $this->askWithCompletion($question . __('qanda.can_cancel_title'), $choices);
        } while (!$answer && !$this->confirmsCancel());

        return $answer;
    }

    protected function confirmsCancel(): bool
    {
        return $this->confirm(
            __('qanda.confirm_cancel')
        );
    }
}