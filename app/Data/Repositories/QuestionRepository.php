<?php

namespace App\Data\Repositories;

use App\Data\Collections\QuestionCollection;
use App\Data\Models\Question;
use App\Data\Repositories\Contracts\QuestionRepositoryContract as Contract;
use Illuminate\Database\Eloquent\Builder;

class QuestionRepository implements Contract
{
    private $queryBuilder;

    public function __construct(Builder $queryBuilder)
    {
        $this->queryBuilder = $queryBuilder;
    }

    public function getAll(): QuestionCollection
    {
        return with(clone $this->queryBuilder)
            ->newQuery()
            ->with(['practice'])
            ->get();
    }

    public function getById(int $id): ?Question
    {
        return with(clone $this->queryBuilder)
            ->newQuery()
            ->with(['practice'])
            ->find($id);
    }
}
