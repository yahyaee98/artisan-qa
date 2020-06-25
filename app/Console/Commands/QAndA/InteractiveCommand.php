<?php

namespace App\Console\Commands\QAndA;

use App\Console\RepeatableCommand;

class InteractiveCommand extends RepeatableCommand
{
    protected $signature = 'qanda:interactive';
    protected $description = 'Runs an interactive command line based Q And A system.';

    private const CHOICE_OVERVIEW = 'overview';
    private const CHOICE_NEW_QUESTION = 'new_question';
    private const CHOICE_PRACTICE = 'practice';
    private const CHOICE_RESET = 'reset';
    private const CHOICE_EXIT = 'exit';

    public function render(): bool
    {
        $choice =
            $this->parseChoice(
                $this->choice(
                    __('qanda.menu_what_to_do'),
                    [
                        __('qanda.menu_overview'),
                        __('qanda.menu_enter_question'),
                        __('qanda.menu_practice'),
                        __('qanda.menu_reset'),
                        __('qanda.menu_exit'),
                    ]
                )
            );

        switch ($choice) {
            case self::CHOICE_OVERVIEW:
                $this->call('qanda:overview');
                break;
            case self::CHOICE_NEW_QUESTION:
                $this->call('qanda:add-question');
                break;
            case self::CHOICE_PRACTICE:
                $this->call('qanda:view-questions');
                break;
            case self::CHOICE_RESET:
                $this->call('qanda:reset');
                break;
        }

        return $choice !== self::CHOICE_EXIT;
    }

    private function parseChoice(string $choice): ?string
    {
        switch ($choice) {
            case __('qanda.menu_overview'):
                return self::CHOICE_OVERVIEW;
            case __('qanda.menu_enter_question'):
                return self::CHOICE_NEW_QUESTION;
            case __('qanda.menu_practice'):
                return self::CHOICE_PRACTICE;
            case __('qanda.menu_reset'):
                return self::CHOICE_RESET;
            case __('qanda.menu_exit'):
                return self::CHOICE_EXIT;
        }

        return null;
    }
}
