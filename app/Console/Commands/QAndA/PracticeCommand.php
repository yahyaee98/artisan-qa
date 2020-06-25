<?php

namespace App\Console\Commands\QAndA;

use App\Console\Concerns\CancelConfirmations;
use App\Console\Contracts\CancellableCommand;
use App\Console\InputSuite;
use App\Data\Models\Practice;
use App\Data\Repositories\Contracts\QuestionRepositoryContract;
use Illuminate\Console\Command;

class PracticeCommand extends Command implements CancellableCommand
{
    use CancelConfirmations;

    protected $signature = 'qanda:practice {question : Question ID}';
    protected $description = 'Practice a question.';

    private $questionRepository;

    public function __construct(QuestionRepositoryContract $questionRepository)
    {
        parent::__construct();
        $this->questionRepository = $questionRepository;
    }

    public function handle()
    {
        $question = $this
            ->questionRepository
            ->getById($this->argument('question'));

        $inputSuite = new InputSuite([
            'answer' => __('qanda.practice_answer_following_question', ['q' => $question->title]),
        ]);

        $inputs = $inputSuite->run($this);

        if (!$inputs) {
            return;
        }

        $practice = new Practice([
            'question_id' => $question->id,
        ]);

        if ($inputs['answer'] === $question->answer->title) {
            $practice->was_correct = true;
            $this->info(__('qanda.practice_correct_answer'));
        } else {
            $practice->was_correct = false;
            $this->warn(__('qanda.practice_wrong_answer'));
        }

        $practice->save();
    }
}
