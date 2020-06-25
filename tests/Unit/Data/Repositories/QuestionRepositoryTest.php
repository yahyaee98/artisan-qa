<?php

namespace Tests\Unit\Data\Repositories;

use App\Data\Collections\QuestionCollection;
use App\Data\Repositories\QuestionRepository;
use Illuminate\Database\Eloquent\Builder;
use Mockery\MockInterface;
use Tests\TestCase;

class QuestionRepositoryTest extends TestCase
{
    public function test_get_all_fetches_all_question_from_query_builder()
    {
        $builderMock = \Mockery::mock(Builder::class, function (MockInterface $mock) {
            $mock
                ->shouldReceive('newQuery')->once()->andReturnSelf()
                ->shouldReceive('with')->with(['practice'])->andReturnSelf()
                ->shouldReceive('get')->once()->andReturn(new QuestionCollection());

            // Workaround for solving the problem with clone.
            // See: https://github.com/laravel/framework/blob/7.x/src/Illuminate/Database/Eloquent/Builder.php#L1472
            $p = (new \ReflectionClass($mock))->getProperty('query');
            $p->setAccessible(true);
            $p->setValue($mock, new \stdClass());
        });

        $repository = new QuestionRepository($builderMock);

        $repository->getAll();
    }

    public function test_get_fetches_right_question_from_query_builder()
    {
        $builderMock = \Mockery::mock(Builder::class, function (MockInterface $mock) {
            $mock
                ->shouldReceive('newQuery')->once()->andReturnSelf()
                ->shouldReceive('with')->with(['practice'])->andReturnSelf()
                ->shouldReceive('get')->once()->andReturn(new QuestionCollection());

            // Workaround for solving the problem with clone.
            // See: https://github.com/laravel/framework/blob/7.x/src/Illuminate/Database/Eloquent/Builder.php#L1472
            $p = (new \ReflectionClass($mock))->getProperty('query');
            $p->setAccessible(true);
            $p->setValue($mock, new \stdClass());
        });

        $repository = new QuestionRepository($builderMock);

        $repository->getAll();
    }
}
