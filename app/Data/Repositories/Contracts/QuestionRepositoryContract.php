<?php

namespace App\Data\Repositories\Contracts;

use App\Data\Collections\QuestionCollection;
use App\Data\Models\Question;

interface QuestionRepositoryContract
{
    public function getAll(): QuestionCollection;

    public function getById(int $id): ?Question;
}
