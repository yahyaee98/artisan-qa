<?php

namespace App\Data\Collections;

use App\Data\Models\Question;
use Illuminate\Support\Collection;

class QuestionCollection extends Collection
{
    public function correctAnswered(): self
    {
        return $this
            ->filter(function (Question $question) {
                return $question->answered_correctly;
            });
    }
}
