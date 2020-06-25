<?php

namespace App\Console\Commands\QAndA;

use App\Console\Concerns\CancelConfirmations;
use App\Console\Contracts\CancellableCommand;
use App\Console\RepeatableCommand;
use App\Data\Collections\QuestionCollection;
use App\Data\Models\Question;
use App\Data\Repositories\Contracts\QuestionRepositoryContract;

class ViewQuestionsCommand extends RepeatableCommand implements CancellableCommand
{
    use CancelConfirmations;

    protected $signature = 'qanda:view-questions';
    protected $description = 'View previously added questions.';

    private $questionRepository;

    public function __construct(QuestionRepositoryContract $questionRepository)
    {
        parent::__construct();
        $this->questionRepository = $questionRepository;
    }

    public function render(): bool
    {
        $questions = $this
            ->questionRepository
            ->getAll();

        if ($questions->isEmpty()) {
            $this->warn(__('qanda.overview_no_progress'));
            return false;
        }

        $this->table(
            [__('qanda.practice_question'), __('qanda.practice_answered_before_title')],
            $this->getRowsForTable($questions)
        );

        $choice = $this->askWithCompletionAndCancel(
            __('qanda.practice_choose_one'),
            $questions->pluck('title')->toArray()
        );
        if (!$choice) {
            return false;
        }

        $questionId = $this->parseChoice($choice, $questions);
        if (!$questionId) {
            $this->warn(__('qanda.practice_question_not_found'));
            return true;
        }

        $this->call('qanda:practice', [
            'question' => $questionId,
        ]);

        return true;
    }

    private function getRowsForTable(QuestionCollection $questions): array
    {
        return $questions
            ->map(function (Question $q) {
                return [
                    $q->title,
                    $q->answered_correctly ?
                        __('qanda.practice_answered_before') : __('qanda.practice_not_answered_before')
                ];
            })
            ->toArray();
    }

    private function parseChoice(string $choice, QuestionCollection $questions): ?int
    {
        return optional(
            $questions
                ->where('title', $choice)
                ->first()
        )->id;
    }
}
