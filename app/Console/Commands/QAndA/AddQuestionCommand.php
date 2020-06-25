<?php

namespace App\Console\Commands\QAndA;

use App\Console\Concerns\CancelConfirmations;
use App\Console\Contracts\CancellableCommand;
use App\Console\InputSuite;
use App\Data\Models\Answer;
use App\Data\Models\Question;
use App\Data\Repositories\Contracts\QuestionRepositoryContract;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class AddQuestionCommand extends Command implements CancellableCommand
{
    use CancelConfirmations;

    protected $signature = 'qanda:add-question';
    protected $description = 'Add a new question.';

    private $questionRepository;

    public function __construct(QuestionRepositoryContract $questionRepository)
    {
        parent::__construct();
        $this->questionRepository = $questionRepository;
    }

    public function handle()
    {
        $inputSuite = new InputSuite([
            'question' => __('qanda.newquestion_enter_question'),
            'answer' => __('qanda.newquestion_enter_answer'),
        ]);

        $inputs = $inputSuite->run($this);

        if (!$inputs) {
            return;
        }

        $question = new Question([
            'title' => $inputs['question'],
        ]);

        $answer = new Answer([
            'title' => $inputs['answer'],
        ]);

        DB::transaction(static function () use ($question, $answer) {
            $question->save();
            $question->answer()
                ->save($answer);
        });

        $this->info(__('qanda.newquestion_question_saved'));
    }
}
