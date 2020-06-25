<?php

namespace App\Console\Commands\QAndA;

use App\Data\Repositories\Contracts\QuestionRepositoryContract;
use Illuminate\Console\Command;

class OverviewCommand extends Command
{
    protected $signature = 'qanda:overview';
    protected $description = 'View overview of the practices.';

    private $questionRepository;

    public function __construct(QuestionRepositoryContract $questionRepository)
    {
        parent::__construct();
        $this->questionRepository = $questionRepository;
    }

    public function handle()
    {
        $questions = $this
            ->questionRepository
            ->getAll();

        if ($questions->isEmpty()) {
            $this->warn(__('qanda.overview_no_progress'));
            return false;
        }

        $this->info(__('qanda.overview_description'));

        $bar = $this->output
            ->createProgressBar(
                $questions->count()
            );

        $bar->start();

        $bar->advance(
            $questions
                ->correctAnswered()
                ->count()
        );
    }
}
